<?php

namespace App\Http\Controllers;

use App\tag;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.tags.index')->with('tags', tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');


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
            'tag'=>'required'
        ]);

        tag::create([
            'tag'=>$request->tag
        ]);

        Session::flash('success', 'Tag create successfully');
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
        //
        $tag=tag::find($id);

        return view('admin.tags.edit',compact('tag'));

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
        $this->validate($request,[
           'tag'=>'required'
        ]);

        $tag=tag::find($id);

        $tag->tag=$request->tag;

        $tag->save();

        Session::flash('success','Tag updated');

        return redirect()->route('tag.index');

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
        tag::destroy($id);

        Session::flash('success','Tag deleted');

        return redirect()->back();
    }

    public function indexTable()
    {
        //
        $tag=tag::query();

        return DataTables::of($tag)
            ->addColumn('action',function ($data){
                return
                    '<a  href="'. route('tag.edit', ['id' => $data->id ]).'" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a  href="'. route('tag.destroy', ['id' => $data->id ]) .'" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i>Delete</a>';
            })
            ->make(true);


    }

}
