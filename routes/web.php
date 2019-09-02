<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Newsletter\NewsletterFacade as Newsletter;

Route::get('/test',function (){
    return App\User::find(1)->profile;
});
Route::get('/test3',function (){
    return \Illuminate\Support\Facades\Auth::User();
});

Route::get('/test2',[
    'uses'=>'userController@indexTable',
    'as'=>'test.indexTable'
]);
Route::get('/test4',[
    'uses'=>'profileController@update',
    'as'=>'test.indexTable'
]);






//Route::get('/', function () {
//    return view('welcome_blog');
//});

//Frontend
Route::get('/', [
    'uses'=>'frontendController@index',
    'as' =>'index'
]);

Route::get('/post/{slug}',[
    'uses'=>'frontendController@singlePost',
    'as'=>'post.single'
]);

Route::get('/category/{id}',[
    'uses'=>'frontendController@category',
    'as'=>'category.single'
]);

Route::get('/tag/{id}',[
    'uses'=>'frontendController@tag',
    'as'=>'tag.single'
]);

Route::get('/results',function (){
    $posts=\App\post::where('title','like','%'. request('query') . '%')->get();
//    dd($posts->all());
//   return $posts;

   return view('frontend_page.results')->with('posts',$posts)
//                               ->with('title','Search results: '. request('query')) menggunakan dot krn data dr request(concatenate), hrus menggunakan ''
                               ->with('setting',\App\setting::first())
                               ->with('category',\App\category::all())
                               ->with('search',''. request('query'))
       ;
});

Route::post('/subscribe',function (){
   $email=request('email');

   Newsletter::subscribe($email);

   \Illuminate\Support\Facades\Session::flash('subscribed','Successfully subscribe');
   return redirect()->back();
});



//Backend
Route::group(['prefix'=>'admin', 'middleware'=>['auth']],function() {


            Route::get('/home', 'HomeController@index')->name('home');

            Route::get('/post',[
                  'uses'=>'postController@index',
                  'as'=>'post.index'
            ]);

            Route::get('/post/table',[
                'uses'=>'postController@indexTable',
                'as'=>'post.indexTable'
            ]);

            Route::get('/post/trash',[
                'uses'=>'postController@trash',
                'as'=>'post.trash'
            ]);

            Route::get('/post/kill/{id}',[
                'uses'=>'postController@kill',
                'as'=>'post.kill'
            ]);

            Route::get('/post/trashed',[
                'uses'=>'postController@trashTable',
                'as'=>'post.trashTable'
            ]);
            Route::get('/post/restore/{id}',[
                'uses'=>'postController@restore',
                'as'=>'post.restore'
            ]);

            Route::get('/post/create',[
                'uses'=>'postController@create',
                'as'=>'post.create'
            ]);

            Route::post('/post/store',[
                'uses'=>'postController@store',
                'as'=>'post.store'
            ]);

            Route::get('/post/edit/{id}',[
                'uses'=>'postController@edit',
                'as'=>'post.edit'
            ]);

            Route::post('/post/update/{id}',[
                'uses'=>'postController@update',
                'as'=>'post.update'
            ]);

            Route::get('/post/delete/{id}',[
                'uses'=>'postController@destroy',
                'as'=>'post.delete'
            ]);

            Route::get('/category/create',[
                'uses'=>'categoriesController@create',
                'as'=>'category.create'
            ]);

            Route::post('/category/store',[
                'uses'=>'categoriesController@store',
                'as'=>'category.store'
            ]);
            Route::get('/category',[
                'uses'=>'categoriesController@index',
                'as'=>'category.index'
            ]);

            Route::get('/category/table',[
                'uses'=>'categoriesController@indexTable',
                'as'=>'category.indexTable'
            ]);
            Route::get('/category/edit/{id}',[
                'uses'=>'categoriesController@edit',
                'as'=>'category.edit'
            ]);
            Route::get('/category/delete/{id}',[
                'uses'=>'categoriesController@destroy',
                'as'=>'category.destroy'
            ]);
            Route::post('/category/update/{id}',[
                'uses'=>'categoriesController@update',
                'as'=>'category.update'
            ]);
            Route::get('/tags',[
                'uses'=>'tagController@index',
                'as'=>'tag.index'
            ]);
            Route::get('/tags/table',[
                'uses'=>'tagController@indexTable',
                'as'=>'tag.indexTable'
            ]);
            Route::get('/tags/edit/{id}',[
                'uses'=>'tagController@edit',
                'as'=>'tag.edit'
            ]);
            Route::get('/tags/delete/{id}',[
                'uses'=>'tagControllerr@destroy',
                'as'=>'tag.destroy'
            ]);

            Route::get('/tag/create',[
                'uses'=>'tagController@create',
                'as'=>'tag.create'
            ]);
            Route::post('/tag/store',[
                'uses'=>'tagController@store',
                'as'=>'tag.store'
            ]);
            Route::post('/tag/update/{id}',[
                'uses'=>'tagController@update',
                'as'=>'tag.update'
            ]);
            Route::get('/tags/delete/{id}',[
                'uses'=>'tagController@destroy',
                'as'=>'tag.destroy'
            ]);

            Route::get('/users',[
                'uses'=>'userController@index',
                 'as'=>'user.index'

            ]);
            Route::get('/users/table',[
                'uses'=>'userController@indexTable',
                'as'=>'users.indexTable'
            ]);
            Route::get('/users/create',[
                'uses'=>'userController@create',
                'as'=>'user.create'
            ]);
            Route::post('/user/store',[
                'uses'=>'userController@store',
                'as'=>'user.store'
            ]);
            Route::get('/user/change/{id}',[
                'uses'=>'userController@change',
                'as'=>'user.change'
            ]);
            Route::get('/user/profile',[
                'uses'=>'profileController@index',
                'as'=>'user.profile'
            ]);
            Route::post('/user/profile/update',[
                'uses'=>'profileController@update',
                'as'=>'user.profile.update'
            ]);
            Route::get('/user/delete/{id}',[
                'uses'=>'userController@destroy',
                'as'=>'user.delete'
            ]);
            Route::get('/setting',[
                'uses'=>'settingController@index',
                'as'=>'setting.index'
            ]);
            Route::post('/setting/update',[
                'uses'=>'settingController@update',
                'as'=>'setting.update'
            ]);



});


Auth::routes();


