<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Post;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        if (Auth::check()) {
            $this->validate($request,array(
                'comment'=>'required|min:10|max:2000'
            ));
            $name = Auth::user()->name;
            $email = Auth::user()->email;
        }
        else{
            $this->validate($request,array(
                    'name'=>'required|min:3|max:255',
                    'email'=>'required|email|max:255',
                    'comment'=>'required|min:10|max:2000'
                ));
            $name = $request->name;
            $email = $request->email;
        }
        
        $post = Post::find($post_id);

        $comment = new Comment;

        $comment->name = $name;
        $comment->email = $email;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);

        $comment->save();

        $request->session()->flash('success_msg', "The Comment added successfully! ");

        return redirect()->route('blog.single',$post->slug);
    }

}
