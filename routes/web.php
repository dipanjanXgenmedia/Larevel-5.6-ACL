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

Route::get('/',function ()
{
    return redirect('/login');
});

// Auth
Auth::routes();
// Overwride Auth Register URL
Route::get('/register', function () {
    return redirect('/login');
})->name('register');
Route::post('/register', function () {
    return redirect('/login');
})->name('register');


Route::group(['middleware' => ['auth', 'acl']],
    function () {
        // Home
        Route::get('/home', 'HomeController@index')->name('home');
        
        Route::group(['prefix' => 'user'],function(){  // User
            Route::get('/',['uses'=>"UserController@index",'can'=>'index.user']); 
            Route::get('/create/',['uses'=>"UserController@create",'can'=>'create.user']);
            Route::post('/store/',['uses'=>"UserController@store",'can'=>'store.user']);
            #Route::get('/show/{$id}',"UserController@show");
            Route::get('/edit/{id}',['uses'=>"UserController@edit",'can'=>'edit.user']); // 
            Route::post('/update/{id}',['uses'=>"UserController@update",'can'=>'update.user']); // 
            Route::get('/delete/{id}',['uses'=>"UserController@destroy",'can'=>'delete.user']); // 
            Route::get('/permission/{id}',['uses'=>"UserController@permission",'can'=>'permission.user']); // 
            Route::post('/permissionupdate/{id}',['uses'=>"UserController@permissionUpdate",'can'=>'index.user']);
        }); 
        Route::group(['prefix' => 'role'],function(){  // Role
            Route::get('/',['uses'=>"RoleController@index",'can'=>'index.role']);
            Route::get('/create',['uses'=>"RoleController@create",'can'=>'create.role']);
            Route::post('/store',['uses'=>"RoleController@store",'can'=>'store.role']);
            #Route::get('/edit/{id}',['uses'=>"RoleController@show"]);
            Route::get('/edit/{id}',['uses'=>"RoleController@edit",'can'=>'edit.role']);
            Route::post('/update/{id}',['uses'=>"RoleController@update",'can'=>'update.role']);
            Route::get('/delete/{id}',['uses'=>"RoleController@destroy",'can'=>'delete.role']);
            Route::get('/permission/{id}',['uses'=>"RoleController@permission",'can'=>'permission.role']);
            Route::post('/permissionupdate/{id}',['uses'=>"RoleController@permissionUpdate",'can'=>'permissionupdate.role']); 
        });

        Route::group(['prefix' => 'permission'],function(){  // Permission
            Route::get('/',['uses'=>"PermissionController@index",'can'=>'index.permission']);
            Route::get('/create',['uses'=>"PermissionController@create",'can'=>'create.permission']);
            Route::post('/store',['uses'=>"PermissionController@store",'can'=>'store.permission']);
            #Route::get('/edit/{id}',"PermissionController@show");
            Route::get('/edit/{id}',['uses'=>"PermissionController@edit",'can'=>'edit.permission']);
            Route::post('/update/{id}',['uses'=>"PermissionController@update",'can'=>'update.permission']);
            Route::get('/delete/{id}',['uses'=>"PermissionController@destroy",'can'=>'delete.permission']);
        });
});

// Testing 
Route::get('/test',"UserController@test");




