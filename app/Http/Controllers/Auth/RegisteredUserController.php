<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stream;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $streams = Stream::all();
        return view('teacher.register', compact('streams'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // VALIDATE REQUEST
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'stream_id' => ['required', 'integer', 'exists:streams,id'],
            'subject_id' => ['required', 'array'],
            'subject_id.*' => ['integer', 'exists:subjects,id'], 
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request->all());
        // CREATE USER
        $username = Str::slug($request->name);
        $uniqueId = uniqid();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'stream_id' => $request->stream_id,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);

        // HANDLE IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $username . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('images/teacher/' . $imageName);
            $image->move(public_path('images/teacher'), $imageName);
            $user->image = 'images/teacher/' . $imageName;
        }

        // HANDLE CV UPLOAD
        if ($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $cvName = $username . '_' . $uniqueId . '.' . $cv->getClientOriginalExtension();
            $cvPath = public_path('cv/teacher/' . $cvName);
            $cv->move(public_path('cv/teacher'), $cvName);
            $user->cv = 'cv/teacher/' . $cvName;
        }

        $user->save();

        // ASSIGN SUBJECTS
        $user->subjects()->attach($request->subject_id);

        // ASSIGN ROLE
        $user->assignRole('teacher');

        // FIRE REGISTERED EVENT
        event(new Registered($user));

        // LOGIN USER
        // Auth::login($user);

        // REDIRECT
        return redirect('/teacher/index')->with('success', 'Teacher registered successfully');
    }

}
