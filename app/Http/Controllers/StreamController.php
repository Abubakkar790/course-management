<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // GET ALL STREAMS
        $streams = Stream::all();
        return view('stream.index', compact('streams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stream.create');
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
            'name.*' => 'required|string|max:255|unique:streams,name',
            'image.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ITERATE OVER EACH NAME AND IMAGE PAIR
        foreach ($request->name as $index => $name) {
            // HANDLE IMAGE UPLOAD
            if ($request->hasFile("image.$index")) {
                $image = $request->file("image.$index");
                $uniqueId = uniqid(); // Generate a unique ID for the file
                $imageExtension = $image->getClientOriginalExtension(); // Get the file extension
                $imageName = $name . $uniqueId . '.' . $imageExtension; // Combine stream name, unique ID, and extension
                $imagePath = 'images/stream/' . $name; // Directory path

                // CREATE DIRECTORY IF IT DOESN'T EXIST
                if (!file_exists(public_path($imagePath))) {
                    mkdir(public_path($imagePath), 0755, true);
                }

                // MOVE THE FILE TO THE SPECIFIED DIRECTORY
                $image->move(public_path($imagePath), $imageName);

                // FULL IMAGE PATH FOR DATABASE
                $imagePath = $imagePath . '/' . $imageName;
            }

            // SAVE STREAM TO DATABASE
            $stream = new Stream();
            $stream->name = $name;
            $stream->image = $imagePath ?? null; // Save the full image path or null if no image
            $stream->save();
        }

        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('stream.index')->with('success', 'Streams created successfully!');
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
        $stream = Stream::find($id);
        return view('stream.edit', compact('stream'));
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
            'name' => 'required|string|max:255|unique:streams,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // FIND THE STREAM BY ID
        $stream = Stream::findOrFail($id);

        // UPDATE STREAM NAME
        $stream->name = $request->input('name');

        // HANDLE IMAGE UPLOAD IF PROVIDED
        if ($request->hasFile('image')) {
            // DELETE THE OLD IMAGE IF IT EXISTS
            if ($stream->image && file_exists(public_path($stream->image))) {
                unlink(public_path($stream->image));
            }

            // UPLOAD NEW IMAGE
            $image = $request->file('image');
            $imageName = 'images/stream/' . $stream->name . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/stream'), $imageName);

            // UPDATE IMAGE PATH IN DATABASE
            $stream->image = $imageName;
        }

        // SAVE THE UPDATED STREAM TO THE DATABASE
        $stream->save();

        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('stream.index')->with('success', 'Stream updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // FIND THE STREAM BY ID
        $stream = Stream::findOrFail($id);

        // DELETE THE ASSOCIATED IMAGE IF IT EXISTS
        // if ($stream->image && file_exists(public_path($stream->image))) {
        //     unlink(public_path($stream->image));
        // }

        // DELETE THE STREAM FROM THE DATABASE
        $stream->delete();

        // REDIRECT WITH SUCCESS MESSAGE
        return redirect()->route('stream.index')->with('success', 'Stream deleted successfully!');
    }

}
