<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Thread;

class PagesController extends Controller
{
    //
    public function index(){
        $title = 'Welcome to Laravel?';
        #return view('pages.index', compact('title'));      # alternative method
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        #return view('pages.index')->with('title', $title);
        
        return view('pages.index', compact('title', 'posts'));
    }

    public function about(){
        $title = 'About us';
        return view('pages.about')->with('title', $title);
    }

}
