<?php

namespace App\Http\Controllers;

use App\category;
use App\post;
use App\setting;
use App\tag;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    //
    public function index(){
//        $try=category::where('name','=','programming')->get();
//        dd($try->all());
       return view('frontend_page.welcome_blog')
       ->with('title',setting::first()->site_name)
       ->with('category',category::all())
       ->with('first_post',post::orderBy('created_at','desc')->first())
       ->with('second_post',post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
       ->with('third_post',post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
       ->with('programming',category::where('name','=','programming')->first())//dengan where
       ->with('framework',category::find(3))//dengan id
       ->with('setting',setting::first())
       ->with('post',post::all())

       ;
//       dd(category::)
    }

    public function singlePost($slug){
        $post=post::where('slug',$slug)->first();
        $category=category::all();
        $setting=setting::first();

        $next=post::where('id','>',$post->id)->min('id');
//        dd($next);
        $previous=post::where('id','<',$post->id)->max('id');

        return view('frontend_page.single',compact('post','category','setting')

            )->with('next', post::find($next))
             ->with('previous',post::find($previous))
            ;


    }

    public function category($id){
        $categories=category::find($id);

        return view('frontend_page.category')->with('categories',$categories)
                                     ->with('setting',setting::first())
                                     ->with('category',category::all())
            ;
    }


    public function tag($id){
        $tag=tag::find($id);

        return view('frontend_page.tag')->with('tag',$tag)
                                              ->with('title',$tag->tag)
                                              ->with('setting',setting::first())
                                              ->with('category',category::all());

    }


}
