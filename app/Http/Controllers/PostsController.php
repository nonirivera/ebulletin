<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Thread;
use App\Comment;
use DB;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        # $posts = Post::all();     <- default
       # $posts = Post::orderBy('title', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);      # with pagination
        $comments = Comment::orderBy('created_at', 'desc')->take(10)->get();
        #$posts = DB::select('SELECT * FROM posts');        <- using sql query
        return view('posts.index', compact('posts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        return view('posts.create', compact('id'));
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
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->thread_id = $request->input('thread_id');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get post id
        $post = Post::find($id);
        // get thread id according to post id
        $tname = Thread::find($post->thread_id);
        // get thread name according to id
        $thread_name = $tname;
        $comment = Comment::find($id);
        
        return view('posts.show', compact('post', 'thread_name', 'comment'));
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
        $post = Post::find($id);
        // check for correct user
        if(auth()->user()->id !== $post->user_id){
            $errMessage = 'You are not authorized to access this page.';
            return redirect('/posts')->with('error', $errMessage);
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
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
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post removed');
    }


}
