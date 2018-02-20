<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;
use DB;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        // $search = \Request::get('search');
        // $thread = Thread::where('name', 'like', '%' .$search. '%')->get();
        // return view('threads.index', compact('thread'));
        $thread = Thread::paginate(10);
        return view('threads.index', compact('thread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        // image upload
        if($request->hasFile('cover_image')){
            // get filename with ext
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get filename only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get ext only
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }   
        else{
            $fileNameToStore = 'noimage.jpg';
        } 

        // create thread
        $thread = new Thread;
        $thread->name = $request->input('title');
        $thread->description = $request->input('description');
        $thread->miscellaneous = $request->input('miscellaneous');
        $thread->cover_image = $fileNameToStore;
        $thread->save();

        return redirect('/threads')->with('success', 'Thread Created');
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
        $thread = Thread::find($id);
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
