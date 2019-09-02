<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Auth::User();
//        dd($user);
        return view('admin.users.profile',compact('user'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'facebook'=>'required',
            'youtube'=>'required',
        ]);

        $user=Auth::user();

        if($request->hasFile('avatar')) {
        $image = $request->file('avatar');
        $filename = time() . $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('uploads/avatars/' . $filename));
        $user->profile->avatar='uploads/avatars/'.$filename;
        $user->profile->save();
    }
        //dd($request->all());
        if ($request->filled('password')){
            $user->password=bcrypt($request->password);
            $user->save();
        }


        $user->name =$request->name;
        $user->email=$request->email;
        $user->profile->facebook=$request->facebook;
        $user->profile->youtube=$request->youtube;
        $user->profile->about=$request->about;

        $user->save();
        $user->profile->save();



        Session::flash('success','Profile has been updated');
        return redirect()->route('home');




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
