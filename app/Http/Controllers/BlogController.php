<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use Exception;

use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class BlogController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('frontend.home', compact('categories'));
    }
    public function signup(){
        $categories = Category::all();
        return view('auth.sign-up', compact('categories'));
    }
    public function login_form(){
        $categories = Category::all();
        return view('auth.sign-in', compact('categories'));
    }

    public function category_post($slug){
        $categories = Category::all();
        #$category = Category::where('cat_slug', $slug)->pluck('id')->first();

        $category = Category::where('cat_slug', $slug)->first();
        $posts = Post::where('category_id',$category->id)->get();
        return view('frontend.category-posts', compact('categories', 'posts'));

        #return redirect()->back();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/admin');
        }else{
            dd('Wrong');
        }
    }
    public function logout(){

        auth()->logout();
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        try {
            User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Session()->flash('success', 'Registered Successfully!');

        } catch (Exception $e){
            dd($e->getMessage());
        }

        return redirect()->back();

        /*$validator = Validator::make($request->all(), [
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }*/


    }





}
