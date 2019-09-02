<?php

namespace App\Http\Controllers;

use App\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class settingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('admin.setting.index')->with('setting',setting::first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
           'site_name'=>'required',
           'contact_number'=>'required',
           'contact_email'=>'required',
           'address'=>'required'
        ]);

        $setting=setting::first();

        $setting->site_name=$request->site_name;
        $setting->address=$request->address;
        $setting->contact_email=$request->contact_email;
        $setting->contact_number=$request->contact_number;
        $setting->save();

        Session::flash('success','setting has been updated');
        return redirect()->back();


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
    }
}
