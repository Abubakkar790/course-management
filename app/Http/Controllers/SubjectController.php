<?php

namespace App\Http\Controllers;
use App\Models\Stream;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('stream')->get();
        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streams = Stream::all();
        return view('subject.create', compact('streams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE REQUEST
        $request->validate([
            'stream' => 'required|exists:streams,id',
            'name.*' => 'required|string|max:255',
        ]);
    
        // GET STREAM ID
        $streamId = $request->input('stream');
    
        // ITERATE OVER EACH SUBJECT NAME
        foreach ($request->name as $subjectName) {
            // SAVE SUBJECT TO DATABASE
            $subject = new Subject();
            $subject->name = $subjectName;
            $subject->stream_id = $streamId;
            $subject->save();
        }
    
        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('subject.index')->with('success', 'Subjects created successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // FIND SUBJECT BY ID
        $subject = Subject::findOrFail($id);
    
        // RETRIEVE ALL STREAMS
        $streams = Stream::all();
    
        // RETURN EDIT VIEW WITH SUBJECT AND STREAMS
        return view('subject.edit', compact('subject', 'streams'));
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
            'name' => 'required|string|max:255',
            'stream' => 'required|exists:streams,id',
        ]);
    
        // FIND SUBJECT BY ID
        $subject = Subject::findOrFail($id);
    
        // UPDATE SUBJECT
        $subject->name = $request->input('name');
        $subject->stream_id = $request->input('stream');
        $subject->save();
    
        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('subject.index')->with('success', 'Subject updated successfully!');
    }
    

    public function getSubjectsByStream($streamId)
    {
        $subjects = Subject::where('stream_id', $streamId)->get();
        return response()->json($subjects);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // FIND SUBJECT BY ID
        $subject = Subject::findOrFail($id);
    
        // DELETE SUBJECT
        $subject->delete();
    
        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully!');
    }
    
}
