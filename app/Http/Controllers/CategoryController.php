<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.category.create', compact('categories'));
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
            'cat_name'=>'required|unique:categories',
            'status'=>'required',
        ]);
        try {
            Category::create([
                'cat_name' => $request->cat_name,
                'cat_slug' => slugify($request->cat_name),
                'status' => $request->status,
                'user_id' => Auth::id(),
            ]);

            Session()->flash('success', 'Category Created!');

        } catch (Exception $e){
            Session()->flash('error', 'Category Not Create!');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'cat_name'=>'required|unique:categories,cat_name,' . $category->id,
            'status'=>'required',
        ]);
        try {
            $category->cat_name = $request->cat_name;
            $category->cat_slug = slugify($request->cat_slug);
            $category->status = $request->status;
            $category->user_id = Auth::id();

            $category->update();

            Session()->flash('success', 'Category Updated!');

        } catch (Exception $e){
            Session()->flash('error', 'Category Not Update!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session()->flash('success', 'Category Deleted Successfully!');
        Session()->flash('error', 'Fails');

        return redirect()->back();
    }
}
