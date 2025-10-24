<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('home', compact('posts'));
    }
    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('post', compact('post'));
    }
}
