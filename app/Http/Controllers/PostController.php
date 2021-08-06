<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'DESC')->get();
        return view('backend.posts.manage', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required|min:5|max:10|unique:posts',
            'description' => 'required|min:15',
            'image' => 'required|image',
            'status' => 'required'
        ]);

        try {
            $post_img = $request->file('image');
            $file_name = date('Y_mdhis_').rand(123, 789).'.'.$post_img->getClientOriginalExtension();

            $post = Post::create([
                'user_id' => Auth::id(),
                'category_id' => $request->category,
                'title' => $request->title,
                'description' => $request->description,
                'slug' => slugify($request->title),
                'image' => $file_name,
                'status' => $request->status,
            ]);

            if ($post) $post_img->storeAs('posts', $file_name);

            Session()->flash('success', 'Post Created!');

        } catch (Exception $e){
            Session()->flash('error', 'Post Not Create!');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required|min:10|unique:posts,title,' . $post->id,
            'description' => 'required|min:15',
            'status' => 'required'
        ]);

        try {
            $post->user_id = Auth::id();
            $post->category_id = $request->category;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->slug = slugify($request->slug);
            $post->status = $request->status;

            if($request->file('image')){
                $path = public_path('uploads/posts/' . $post->image);
                if(file_exists($path)){
                    unlink($path);
                }

                $post_img = $request->file('image');
                $file_name = date('Y_mdhis_').rand(123, 789).'.'.$post_img->getClientOriginalExtension();
                $post->image = $file_name;
                if($post) $post_img->storeAs('posts', $file_name);
            }

            $post->update();

            Session()->flash('success', 'Post Updated!');

        } catch (Exception $e){
            Session()->flash('error', 'Post Not Update!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $path = public_path('uploads/posts/' . $post->image);
        if(file_exists($path)){
            if($post->image !== 'demo.jpg'){
                unlink($path);
            }
        }
        $post->delete();

        Session()->flash('success', 'Post Deleted Successfully!');
        Session()->flash('error', 'Fails');

        return redirect()->back();
    }
}
