<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Tag;

class TagController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('backend.tag.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
                'name'=>'required'
            ));
        $tag = new Tag;

        $tag->name = $request->name;

        $tag->save();

        $request->session()->flash('success_msg', "The Tag added successfully! ");

        return redirect()->route('tags.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = tag::all();

        $tag = Tag::find($id);

        return view('backend.tag.edit')->withTags($tags)->withT($tag);
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
        $this->validate($request, array(
                'name' => 'required',
            ));

        $tag = Tag::find($id);

        $tag->name = $request->name;

        $tag->save();

        $request->session()->flash('success_msg','The Tag updated successfully!');

        return redirect()->route('tags.edit',$tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tag = Tag::find($id);

        $tag->posts()->detach();

        $tag->delete();

        $request->session()->flash('success_msg' , 'The Tag deleted successfully');

        return redirect()->route('tags.index');
    }
}
