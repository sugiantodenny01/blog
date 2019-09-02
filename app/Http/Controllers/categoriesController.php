<?php

namespace App\Http\Controllers;
use App\category;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        return view('admin.categories.index')->with('categories',category::all());
    }


    public function indexTable()
    {
        //
        $category=category::query();

        return DataTables::of($category)
            ->addColumn('action',function ($data){
                return
                    '<a  href="'. route('category.edit', ['id' => $data->id ]).'" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a  href="'. route('category.destroy', ['id' => $data->id ]) .'" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i>Delete</a>';
            })
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
            'name'=>'required',

        ]);

        $category= new category();
        $category->name=$request->name;
        $category->save();
        Session::flash('success','category create');
        return redirect()->route('category.index');
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
        //
        $categories=category::find($id);

        return view('admin.categories.edit')->with('category',$categories);
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
        //
        $categories=category::find($id);

        $categories->name=$request->name;

        $categories->save();
        Session::flash('success','category updated');
        return redirect()->route('category.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categories=category::find($id);

        foreach ($categories->posts as $post){
            $post->forceDelete();
        }

        $categories->delete();
        Session::flash('success','category deleted');
        return redirect()->route('category.index');

    }
}
