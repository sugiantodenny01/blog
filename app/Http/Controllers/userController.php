<?php

namespace App\Http\Controllers;

use App\User;
use App\profile;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class userController extends Controller
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
        $users=User::all();
        $profiles=profile::all();
        return view('admin.users.index',compact('users','profiles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
        //
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required'
        ]);

        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt('123456'),
        ]);

        $image       = $request->file('avatar');
        $filename    = time().$image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('uploads/avatars/' .$filename));
        $file='uploads/avatars/'.$filename;

        $profile=profile::create([
            'user_id'=> $user->id,
            'avatar'=>$file,
        ]);

        Session::flash('success', 'New user created successfully');
        return redirect()->route('user.index');
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
    public function update(Request $request, $id)
    {
        //
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
        $user=User::find($id);

        $user->profile->delete();

        $user->delete();

        Session::flash('success','User has been deleted');
        return redirect()->back();
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function indexTable()
    {
        //
        $users=User::with('profile')->select('users.*')->get();

        $dt= DataTables::of($users)


            ->addColumn('action',function ($data){

                return
                    '<a  href="'. route('user.change', ['id' => $data->id ]).'" class="btn btn-bitbucket btn-xs" ><i class="glyphicon glyphicon-check"></i>Change</a> ';

            })

            ->addColumn('delete',function ($data){
                if (Auth::id() !== $data->id){
                    return
                        '<a  href="'. route('user.delete', ['id' => $data->id ]) .'" class="btn btn-danger btn-xs" ><i class="glyphicon glyphicon-trash"></i>Delete</a>';
                }else{
                    return
                        '';
                }

            })
            ->rawColumns(['delete', 'action'])
            ->make(true);


        //var_dump($dt);
        return $dt;
    }

    public function change($id){
        $user=User::find($id);

        if ($user->admin==1){
            $user->admin=0;
        }else{
            $user->admin=1;
        }

        $user->save();

        Session::flash('success', 'User permissions has been changed');
        return redirect()->route('home');
    }
}
