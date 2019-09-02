<?php

namespace App\Http\Controllers;


use App\category;
use App\post;
use App\tag;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;

class postController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('post',post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories= category::all();
        $tag=tag::all();

        if ($categories->count() == 0 || $tag->count() == 0){

            Session::flash('info', ' You Must Have Some Categories and Tags');
            return redirect()->back();
        }

//        return view('admin.posts.create')->with('categories',category::all());

        return view('admin.posts.create',compact('categories','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'konten'=>'required',
            'featured'=>'required|image',
            'category_id'=>'required',
            'tags'=>'required'
        ]);

        $image       = $request->file('featured');
        $filename    = time().$image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('uploads/posts/' .$filename));


        $post = new post();
        $post->title=$request->title;
        $post->content=$request->konten;
        $post->category_id=$request->category_id;
        $post->featured='uploads/posts/'.$filename;
        $post->slug=str_slug($request->title);
        $post->user_id=Auth::id();
        $post->save();

        $post->tags()->attach($request->tags);

        Session::flash('success','post created');

        return redirect()->route('post.index');
       // dd($request->all());

    }


    public function indexTable()
    {
        //
        $post=post::query();
//        var_dump($post);
        return DataTables::of($post)
            ->addColumn('action', function ($data) {
                return
                    '<a  href="' . route('post.edit', ['id' => $data->id]) . '" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a  href="' . route('post.delete', ['id' => $data->id]) . '" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i>Delete</a>';
            })
////            ->addColumn('image',function($img){
//                 $url=asset("uploads/posts/$img->featured");
////                return
////                '<img src= "'.$url.'" >';
////                "<img src= $url >";
//            })
            ->make(true);
    }


    public function trash()
    {
        $post = post::onlyTrashed()->get();
        return view('admin.posts.trashed',compact('post'));

    }


    public function trashTable(){
        $post = post::onlyTrashed()->get();

        return DataTables::of($post)
            ->addColumn('action', function ($data) {
                return
                    '<a  href="' . route('post.restore', ['id' => $data->id]) . '" class="btn btn-success btn-xs" ><i class="glyphicon glyphicon-hand-up"></i> Restore</a>'.
                    '<a  href="' . route('post.kill', ['id' => $data->id]) . '" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i> Destroy</a>';
            }) ->make(true);
    }

    public function restore($id){
        $post=post::withTrashed()->where('id',$id)->first();

        $post->restore();

        Session::flash('success','Post success restore');
        return redirect()->route('post.index');
    }

    public function kill($id){
        $post=post::withTrashed()->where('id',$id)->first();

        $post->forceDelete();
        Session::flash('success','Post permananently deleted');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post=post::find($id);
      $categories=category::all();
      $tag=tag::all();

      return view('admin.posts.edit',compact('post','categories','tag'));
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
        $this->validate($request,[
           'title'=>'required',
           'konten'=>'required',
           'category_id'=>'required'
        ]);

        $post=post::find($id);

        if($request->hasFile('featured')) {
            $image = $request->file('featured');
            $filename = time() . $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('uploads/posts/' . $filename));
            $post->featured='uploads/posts/'.$filename;
        }

        $post->title=$request->title;
        $post->content=$request->konten;
        $post->category_id=$request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success','Post has been updated');
        return view('admin.posts.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

          $post= post::find($id);

          $post->delete();

          Session::flash('success', 'The post was just trashed ');

          return redirect()->back();
    }
}
