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



Route::group(['middleware'=>['web']], function () {
        
    Route::get('/', [
        'uses'=>'PostController@getWelcome',
        'as'=> 'home',
    ]);

    Route::post('/login', [
        'uses'=>'UserController@postSignIn',
        'as'=> 'login'
    ]);
    
   /* Route::get('/login', function () {
        redirect()->route('home');
    });*/
    
    Route::get('/login', function () {
        return view('login');
    });
    
    Route::get('/dashboard', [
        'uses'=>'PostController@getDashboard',
        'as'=> 'dashboard',
        'middleware' => 'auth'
    ]);
    
    Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware'=> 'auth'
    ]);
    
    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware'=> 'auth'
    ]);
    
    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
    
    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit',
        'middleware' => 'auth'
    ]                
        /*function(\Illuminate\Http\Request $request) {
        //echo $request['postId'];
        $valll= $request->hasFile('edit_readmes');//->hashName();
        return response()->json(['message' => $valll]);*/
    );
    
    Route::get('/account', [
        'uses'=> 'UserController@getAccount',
        'as' => 'account',
        'middleware' => 'auth'
    ]);
    
    Route::post('accountupdate', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save',
        'middleware' => 'auth'
    ]);
    
});
