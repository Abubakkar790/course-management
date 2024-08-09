<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stream;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::role('teacher')->with(['stream','subjects'])->get();
        // dd($teachers);
        // Return view with teachers
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streams = Stream::all();
        return view('teacher.register', compact('streams'));
    }

    // public function store(Request $request)
    // {
    //     // VALIDATE REQUEST
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //         'stream_id' => ['required', 'integer', 'exists:streams,id'],
    //         'subject_id' => ['required', 'array'],
    //         'subject_id.*' => ['integer', 'exists:subjects,id'], 
    //         'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    //         'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);
    //     // dd($request->all());
    //     // CREATE USER
    //     $username = Str::slug($request->name);
    //     $uniqueId = uniqid();

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'stream_id' => $request->stream_id,
    //         'number' => $request->number,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // HANDLE IMAGE UPLOAD
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = $username . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();
    //         $imagePath = public_path('images/teacher/' . $imageName);
    //         $image->move(public_path('images/teacher'), $imageName);
    //         $user->image = 'images/teacher/' . $imageName;
    //     }

    //     // HANDLE CV UPLOAD
    //     if ($request->hasFile('cv')) {
    //         $cv = $request->file('cv');
    //         $cvName = $username . '_' . $uniqueId . '.' . $cv->getClientOriginalExtension();
    //         $cvPath = public_path('cv/teacher/' . $cvName);
    //         $cv->move(public_path('cv/teacher'), $cvName);
    //         $user->cv = 'cv/teacher/' . $cvName;
    //     }

    //     $user->save();

    //     // ASSIGN SUBJECTS
    //     $user->subjects()->attach($request->subject_id);

    //     // ASSIGN ROLE
    //     $user->assignRole('teacher');

    //     // FIRE REGISTERED EVENT
    //     event(new Registered($user));

    //     // LOGIN USER
    //     // Auth::login($user);

    //     // REDIRECT
    //     return redirect('/teacher/index')->with('success', 'Teacher registered successfully');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $streams = Stream::all();
        $teacher = User::findOrFail($id);
        $subjects = $teacher->subjects;
        return view('teacher.edit', compact('streams','teacher','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // VALIDATE REQUEST
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' .$id],
            'stream_id' => ['required', 'integer', 'exists:streams,id'],
            'subject_id' => ['required', 'array'],
            'subject_id.*' => ['integer', 'exists:subjects,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // UPDATE USER INFORMATION
        $teacher = User::find($id);
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'stream_id' => $request->stream_id,
            'number' => $request->number,
        ]);
    
        // HANDLE IMAGE UPLOAD
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teacher->image) {
                $oldImagePath = public_path($teacher->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $image = $request->file('image');
            $imageName = Str::slug($request->name) . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('images/teacher/' . $imageName);
            $image->move(public_path('images/teacher'), $imageName);
            $teacher->image = 'images/teacher/' . $imageName;
        }
    
        // HANDLE CV UPLOAD
        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($teacher->cv) {
                $oldCvPath = public_path($teacher->cv);
                if (file_exists($oldCvPath)) {
                    unlink($oldCvPath);
                }
            }
    
            $cv = $request->file('cv');
            $cvName = Str::slug($request->name) . '_' . uniqid() . '.' . $cv->getClientOriginalExtension();
            $cvPath = public_path('cv/teacher/' . $cvName);
            $cv->move(public_path('cv/teacher'), $cvName);
            $teacher->cv = 'cv/teacher/' . $cvName;
        }
    
        // HANDLE PASSWORD UPDATE
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }
    
        $teacher->save();
    
        // ASSIGN SUBJECTS (Sync to update existing relationships)
        $teacher->subjects()->sync($request->subject_id);
    
        // ASSIGN ROLE (Make sure teacher role is assigned)
        if (!$teacher->hasRole('teacher')) {
            $teacher->assignRole('teacher');
        }
    
        // REDIRECT WITH SUCCESS MESSAGE
        return redirect('/teacher/index')->with('success', 'Teacher updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE USER
        User::find($id)->delete();

        // REDIRECT WITH SUCCESS MESSAGE
        return redirect('/teacher/index')->with('success', 'Teacher deleted successfully');
    }
}
