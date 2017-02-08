<?php

namespace App\Http\Controllers;

use DB;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "it's working ===> ";
        $posts = Post::all();
        return view('posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return 'I am the method that creates :p';
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->title;
        //Post::create($request->title);
        DB::insert('insert into posts(title, review) values(?, ?)' , [$request->title , "is the best"]);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::findorfail($id);
        return view('posts.show' , compact('posts'));
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
        return "item " . $id . " has been edited successfully"; 
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
        return "you have been destroyed";
    }
    
    public function ShowContact(){
        //return "contact page";
        $people = ['Arnab' , 'Mridul' , 'Nazim' , 'Moudud' , 'Talat'];
        //$people = [];
        return view('contact' , compact('people'));
        //return view('Pages.demo');
    }
    
    public function showPost($id , $name , $reg){
        //return view('post') -> with('id' , $id);
        return view('post' , compact('id' , 'name' , 'reg')); 
    }
}
