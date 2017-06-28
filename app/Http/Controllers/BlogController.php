<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Post;
use Session;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('frontend.blog.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function single($slug)
    {
        $post = Post::where("slug" ,$slug)->first();
        return view('frontend.blog.single')->withPost($post);
    }
    
}
