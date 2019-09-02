<?php

namespace App\Http\Controllers;

use App\category;
use App\post;
use App\setting;
use App\tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::count();
        $category=category::count();
        $post=post::count();
        $tag=tag::count();
        $setting=setting::first();
        return view('admin.home.index',compact('user','post','category','tag','setting'));
    }
}
