<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::paginate(5);
        return view('dashboard.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('dashboard.categories.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Category();
        $data->parent_id = $request->parent;
        $data->title = $request->title;
        $data->content = $request->content;
        $filename = sprintf('thumbnail_%s.jpg',random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        {
            $filename = $request->file('thumbnail')->storeAs('category',$filename,'public');
        }
        $data->thumbnail = $filename;
        $save = $data->save();
        if($save)
        {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        $data = Category::find($id);
        return view('dashboard.categories.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data = Category::where('id',$category->id)->get();
        return view('dashboard.categories.edit',compact('category', 'data'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->parent_id = $request->parent;
        $category->title = $request->title;
        $category->content = $request->content;
        $filename = sprintf('thumbnail_%s.jpg',random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        {
            $filename = $request->file('thumbnail')->storeAs('category',$filename,'public');
        }else{
            $filename = 'category/dummy.jpg';
        }

        $category->thumbnail = $filename;
        $save = $category->save();
        if($save)
        {
            return redirect()->route('categories.index');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
