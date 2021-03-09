<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\Category;
use Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['categories','user'])->get();
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('dashboard.posts.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $filename = sprintf('post_%s.jpg',random_int(1, 999));
        if($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('posts',$filename,'public');
        else
            $filename = 'posts/dummy.jpg';
        
        $post = [
            'title'     =>  $request->title,
            'content'   =>  $request->content,
            'user_id'   =>  1,
            'slug'      =>  $request->title,
            'thumbnail' => $filename,
        ];
        
        $post = Post::create($post);        
        
        $post->categories()->attach($request->categories);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $posts)
    {
        //$posts = Post::with(['categories','user'])->where('id',$id)->orWhere('slug',$id)->first();
        $categories = Category::all();
        return view('dashboard.posts.edit',compact('categories','posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $filename = sprintf('post_%s.jpg',random_int(1, 999));
        if($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('posts',$filename,'public');
        else
            $filename = $post->thumbnail;
        //dd($post);
        $post->title  =  $request->title;
        $post->content =  $request->content;
        $post->thumbnail = $filename;
        
        if( $post->save() )
        {
            $post->categories()->sync($request->categories);
            return redirect()->route('posts.index');
        }
             
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //$post = Post::find($id);
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('posts.index');
    }
}
