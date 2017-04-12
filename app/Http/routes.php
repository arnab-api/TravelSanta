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

use App\Post;
use App\User;

//Route::get('/', function () {
//    return view('welcome');
//    //return "hello there";
//});
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

Route::get('/contact', 'PostsController@ShowContact');
Route::get('/posts/test', 'PostsController@Test');

Route::get('/post/{id}/{name}/{reg}', 'PostsController@showPost');

Route::get('/insert', function () {
    DB::insert('insert into demo(title,review,stars) values(?,?,?)', ['Sunderban', 'Is a great place', 5]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)', ['moulvibazar', 'Is a great place', 4]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)', ['Sylhet', 'Is a great place', 4]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)', ['Cox\'s bazar', 'Is a great place', 5]);
    DB::insert('insert into demo(title,review,stars) values(?,?,?)', ['SUST', 'Is a great place', 3]);
});

Route::get('/read', function () {
    $res = DB::select('select * from demo where stars >= 4');
    //return $res;
    foreach($res as $r){
        return $r->title;
    }
});

Route::get('/update', function () {
    $updated = DB::update('update demo set title = "Sunderbans" where id = ?', [1]);
    //return $updated;
    $updated = DB::update('update demo set title = "Cox\'s bazar" where id = ?', [2]);
    return $updated;
});


Route::get('/delete', function () {
    $deleted = DB::delete('delete from demo where id = 3');
});

//Route::group(['middleware' => 'web'], function () {
//
//    Route::resource('/posts', 'PostsController');
//
//});

Route::resource('/posts' , 'PostsController');
Route::resource('/image' , 'ImageUploadController');
Route::get('/search' , 'SearchController@store');

/// Elequent

Route::get('/read2' , function(){

    $posts = Post::all();
    $len = sizeof($posts);
    $people = new SplFixedArray($len);

    $i = 0;
    foreach($posts as $pst){

        //return $pst->title;
        $people[$i] = $pst->title;
        $i = $i+1;
    }

    return view('contact' , compact('people'));

});

Route::get('/insert2' , function(){

    $post = new Post();
    $post->title = "lala land";
    $post->review = "is a great movie";

    $post->save();

});

Route::get('/create2' , function(){
    Post::create(['title'=>'Justice League' , 'review'=>'is awesome']);
});

Route::get('/update2' , function(){

    $allpost = Post::all();
    $id = -1;
    for($i = 0 ; $i<sizeof($allpost) ; $i++){
        if($allpost[$i]->title == "Nazim"){
            $id = $allpost[$i]->id;
            break;
        }
    }
    $post = Post::find($id);
    $post->title = "MNU++";
    $post->save();

    return $id;

});

Route::get('/delete' , function(){

    Post::destroy([12,16]);

});

Route::get('/user/{id}/post' , function($id){
    $post = User::find($id)->post->review;
    return $post;
});

Route::get('/user/{id}/posts' , function($id){
    $user = User::find($id);
    foreach($user->posts as $post){
        echo $post->title."<br>";
    }
});

Route::get('/search_by_tag/{tag}' , 'SearchController@searchByTag');
Route::get('/search_by_area/{tag}' , 'SearchController@searchByArea');

Route::auth();

//Route::get('/check' , function(){
//    return view('posts.create');
//});

Route::get('/check' , 'PostsController@create');

Route::get('/home', 'HomeController@index');

Route::get('/', function (){
    return view('TS_Home');
});

Route::get('/tshome', function (){
    return view('TS_Home');
});

Route::get('/tsregistration', function (){
    return view('TS_registration');
});

Route::get('/master', function (){
    return view('MasterBlade');
});

//Route::get('/post', function (){
//    return view('post');
//});

Route::get('/post' , 'PostsController@create');

Route::get('/tslogin', function (){
    return view('TS_login');
});

Route::post('/search' , 'SearchController@store');

Route::get('/imgpost' , function(){
    return view('imgUpload');
});