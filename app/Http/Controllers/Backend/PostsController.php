<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Post;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;
use App\Models\Comment;
use Purifier;
use Image;
use Storage;

class PostsController extends Controller
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
        $posts = Post::orderBy('id','desc')->paginate(20);
        return view('backend.posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $tags ='';
        $raw = Category::select( 'id','name')->get();
        if ( isset($raw) ) {
            foreach ($raw as $key => $value) 
                $categories[$value['id']]=$value['name'];
        }
        $r = Tag::select( 'id','name')->get();
        if ( isset($r) ) {
            foreach ($r as $key => $value) 
                $tags[$value['id']]=$value['name'];
        }
        return view('backend.posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
                'title' => 'required|max:190',
                'slug' => 'required|unique:posts,slug|alpha_dash|min:5|max:190',
                'body' => 'required',
                'featured_image' => 'image|dimensions:min_width=350,min_height=350',
            ));

        $posts = new Post;
        
        $posts->title = $request->title;
        $posts->slug = $request->slug;
        $posts->category_id = $request->category_id;
        $posts->body = Purifier::clean($request->body);

        if (  $request->hasFile('featured_image') ) {

            $image = $request->file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $img_path = 'uploads/posts/'.$filename;
            $thumb_path = 'uploads/posts/thumb/'.$filename;

            $img = Image::make($image);
            $img->save( public_path($img_path) );

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save( public_path($thumb_path) );
            
            $posts->thumb_image = $thumb_path;
            $posts->image = $img_path;
        }
        $posts->save();

        if (isset($request->tags)) 
            $posts->tags()->sync($request->tags,false);
        else
            $posts->tags()->detach();

        $request->session()->flash('success_msg','The blog post added successfully!');

        return redirect()->route('posts.show',$posts->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('backend.posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = $tags= '';
        $raw = Category::select( 'id','name')->get();
        if ( isset($raw) ) {
            foreach ($raw as $key => $value) 
                $categories[$value['id']]=$value['name'];
        }
        $r = Tag::select( 'id','name')->get();
        if ( isset($r) ) {
            foreach ($r as $key => $value) 
                $all_tags[$value['id']]=$value['name'];
        }
        if ( $post->getTags()!=null ) {
            foreach ($post->getTags() as $key => $value) {
                $tags[$key]=$value->id;
            }
        }
        return view('backend.posts.edit')->withPost($post)->withCategories($categories)->withAll_tags($all_tags)->withTags($tags);
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
                'title' => 'required|max:190',
                'slug' => 'required|unique:posts,slug,'.$id.'|alpha_dash|min:5|max:190',
                'body' => 'required',
                'featured_image' => 'image|dimensions:min_width=350,min_height=350',
            ));

        $posts = Post::find($id);
        $posts->title = $request->title;
        $posts->slug = $request->slug;
        $posts->category_id = $request->category_id;
        $posts->body = $request->body;

        if (  $request->hasFile('featured_image') ) {
            $old_thumb = $posts->thumb_image;
            $old_img = $posts->image;
            $image = $request->file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $img_path = 'uploads/posts/'.$filename;
            $thumb_path = 'uploads/posts/thumb/'.$filename;
            //$path = Storage::putFileAs('uploads/posts', $image, $filename);

            // finally we save the image as a new file
            $img = Image::make($image);
            $img->save( public_path($img_path) );
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save( public_path($thumb_path) );

            Storage::delete( $old_thumb );
            Storage::delete( $old_img );

            $posts->thumb_image = $thumb_path;
            $posts->image = $img_path;
        }

        $posts->save();

        if (isset($request->tags)) 
            $posts->tags()->sync($request->tags);
        else
            $posts->tags()->detach();

        $request->session()->flash('success_msg','The blog post updated successfully!');

        return redirect()->route('posts.show',$posts->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post = Post::find($id);

        $old_thumb = $post->thumb_image;

        $old_img = $post->image;
        
        $post->tags()->detach();

        $post->delete();

        $post->comments()->delete();

        Storage::delete( $old_thumb );
        
        Storage::delete( $old_img );

        $request->session()->flash('success_msg' , 'The blog post deleted successfully');

        return redirect()->route('posts.index');
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateComment(Request $request,$id)
    {

        $comment = Comment::find($id);
        
        if ($comment->approved==true) {
            $comment->approved = false;
        }
        else{
            $comment->approved = true;
        }

        $comment->save();

        $request->session()->flash('success_msg' , 'The Comment Updated successfully');

        return redirect()->route('posts.show',$comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyComment(Request $request,$id)
    {
        $comment = Comment::find($id);

        $comment->delete();

        $request->session()->flash('success_msg' , 'The Comment deleted successfully');

        return redirect()->route('posts.show',$comment->post_id);
    }
}
