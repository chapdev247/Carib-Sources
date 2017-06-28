<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Category;

class CategoryController extends Controller
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
    public function index(Request $request)
    {
        $data['title'] = 'Admin: Categories';
        $data['categories'] = Category::all();
        return view('backend.category.index')->withData($data);
    }

    public function create()
    {
        $data['title'] = 'Admin: Add Category';
        $data['categories'] = Category::all();
        $data['root_categories'] = Category::where('parent',0)->get();
        $data['cat_select'] = array();
        if (!empty($data['root_categories'])) {
            foreach ($data['root_categories'] as $cat)
                $data['cat_select'][$cat->id] = $cat->name;
        }

        return view('backend.category.add')->withData($data);
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
            'name'=>"required|unique:categories,name",
            'slug'=>"required|unique:categories,slug",
            'parent'=>"required_with:is_root"
        ),
        array(
            'name.required'=>'Category name is required',
            'name.unique'=>'Category name must be unique',
            'slug.required'=>'Category slug is required',
            'slug.unique'=>'Category slug must be unique',
            'parent.required_with'=>'Parent Category is required',
        ));
        $category = new Category;

        $category->name = $request->name;
        $category->slug = $request->slug;
        if ($request->is_root) 
            $category->parent = $request->parent;
        else
            $category->parent = 0;
        $category->save();

        $request->session()->flash('success_msg', "The Category added successfully! ");

        return redirect()->route('categories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Admin: Edit Category';
        $data['category'] = Category::find($id);
        $data['categories'] = Category::where('parent',0)->where('id', '!=' ,$id)->get();
        $data['cat_select'] = array();
        if (count($data['categories'])>0) {
            foreach ($data['categories'] as $cat)
                $data['cat_select'][$cat->id] = $cat->name;
        }
        return view('backend.category.edit')->withData($data);
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
        $this->validate($request,array(
            'name'=>"required|unique:categories,name,$id,id",
            'slug'=>"required|unique:categories,slug,$id,id",
            'parent'=>"required_with:is_root"
        ),
        array(
            'name.required'=>'Category name is required',
            'name.unique'=>'Category name must be unique',
            'slug.required'=>'Category slug is required',
            'slug.unique'=>'Category slug must be unique',
            'parent.required_with'=>'Parent Category is required',
        ));

        $category = Category::find($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        if ($request->is_root) 
            $category->parent = $request->parent;
        else
            $category->parent = 0;

        $category->save();

        $request->session()->flash('success_msg','The category updated successfully!');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $category = Category::find($id);

        $category->delete();

        $request->session()->flash('success_msg' , 'The Category deleted successfully');

        return redirect()->route('categories.index');
    }
    public function status(Request $request,$id)
    {
        $category = Category::find($id);

        if ($category->status) 
            $category->status = 0;
        else
            $category->status = 1;

        $category->save();

        $request->session()->flash('success_msg' , 'The Category status updated successfully');

        return redirect()->route('categories.index');
    }
}
