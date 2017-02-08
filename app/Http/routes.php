<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
    //return "hello there";
});
//
//Route::get("/post/{id}/{name}" , function($id , $name){
//    return "this is post ".$id." --> ".$name;
//});
//
//Route::get('/admin/example/demo' , array( 'as' => 'ts.demo' , function(){
//    $url = route('ts.demo');
//    return "this is ".$url;
//}));

//Route::get('/post/{iddd}' , 'PostsController@index') ; 

//Route::resource('posts' , 'PostsController');

Route::get('/contact' , 'PostsController@ShowContact');

Route::get('/post/{id}/{name}/{reg}' , 'PostsController@showPost');

Route::get('/insert' , function(){
    DB::insert('insert into demo(title,review,stars) values(?,?,?)' , ['Sunderban','Is a great place',5]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)' , ['moulvibazar','Is a great place',4]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)' , ['Sylhet','Is a great place',4]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)' , ['Cox\'s bazar','Is a great place',5]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)' , ['SUST','Is a great place',3]);
});

Route::get('/read' , function(){
    $res = DB::select('select * from demo where stars >= 4');
    return $res;
    //foreach($res as $r){
    //    return $r->title;
    //}
});

Route::get('/update',function(){
    $updated = DB::update('update demo set title = "Sunderbans" where id = ?' , [1]);
    //return $updated;
    $updated = DB::update('update demo set title = "Cox\'s bazar" where id = ?' , [2]);
    return $updated;
});


Route::get('/delete' , function(){
    $deleted = DB::delete('delete from demo where id = 3');
});

Route::resource('/posts' , 'PostsController');


