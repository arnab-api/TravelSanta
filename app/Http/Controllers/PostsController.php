<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Address;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //return redirect('/check');
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

        /*$flag=0;
        $txt = $request->title;

        //return strlen($txt);

        for($i = 0 ; $i<strlen($txt) ; $i++){
            if($txt[$i]>='a' && $txt[$i]<='z' || $txt[$i]>='A' && $txt[$i]<='Z'){
                $flag = 1;
                break;
            }
        }

        //return $flag;

        if($flag == 1) {
            DB::insert('insert into posts(title, review) values(?, ?)', [$request->title, "is the best"]);
            return redirect('/posts');
        }
        return redirect('/posts/create');*/

        /*$this->validate($request , [
            'title' => 'required'
        ]);
        DB::insert('insert into posts(title, review) values(?, ?)', [$request->title, "is the best"]);
        return redirect('/posts');*/

        /*$file = $request->file('file');
        echo $file->getClientOriginalName();
        echo "<br>";
        echo $file->getClientSize();*/

//        $input = $request->all();
//        if($file = $request->file('file')){
//            $name = $file->getClientOriginalName();
//            $file->move('images' , $name);
//            $input['path'] = $name;
//        }
//        DB::insert('insert into posts(title, review , path) values(?,?,?)', [$request->title , "image saved" , $name]);
//        return redirect('/posts');

//        echo Auth::user()->id."<br>";
//        echo Auth::user()->name."<br>";
//        echo Auth::user()->email."<br>";
//        echo Auth::user()->getAuthPassword()."<br>";
//        echo Auth::user()->isAdmin."<br>";

        //// Main kapzap starts here


        $rate =  $request->rating[0] - '0';
        $userId = Auth::user()->id;

        DB::insert('insert into posts(title, review, rating, user_id) values(?,?,?,?)' ,[$request->placeTitle,$request->placeDes,$rate,$userId]);

        $allpost = Post::all();
        $len = sizeof($allpost);
        $postId = $allpost[$len-1];

        $tag = new Tag();
        $tags = $request->tags;
        for($i = 0 ; $i<sizeof($tags) ; $i++){
            if($tags[$i] == "hills") $tag->hills = 1;
            if($tags[$i] == "sea") $tag->sea = 1;
            if($tags[$i] == "heritage") $tag->heritage = 1;
            if($tags[$i] == "architecture") $tag->architecture = 1;
            if($tags[$i] == "river") $tag->river = 1;
            if($tags[$i] == "riverside") $tag->riverside = 1;
            if($tags[$i] == "lake") $tag->lake = 1;
            if($tags[$i] == "forest") $tag->forest = 1;
            if($tags[$i] == "green") $tag->green = 1;

            echo $tags[$i]."<br>";
        }
        $tag->post_id = $postId->id;
        $tag->save();

        echo $request->distList;

        $add = new Address();
        $add->post_id = $postId->id;
        $add->District = $request->dist;
        $add->Address = $request->address;
        $add->save();

        echo $add->District;
        echo $request->address;


        //return $post->id;
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
        $it = Post::findorfail($id);
        return view('posts.edit' , compact('it'));
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
        //$pst = Post::findorfail($id);
        //$pst->update($request->all());
        DB::update('update Posts set title = ? where id = ?' , [$request->title , $id]);
        return redirect('/posts');
    }

    public function test()
    {
        return view('posts.Test');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Post::findorfail($id);
        //$del->delete();
        DB::delete('delete from Posts where id = ?' , [$id]);
        return redirect('/posts');
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

//    public function searchByTag($tag){
//        //return $tag;
//        $alltags = Tag::all();
//        for($i = 0 ; $i<sizeof($alltags) ; $i++){
//            if($alltags[$i]->$tag == 1) echo $alltags[$i]->post_id."<br>";
//        }
//    }

    public function searchByTag($tagarr){
        $searchtags = explode("+" , $tagarr);
        foreach($searchtags as $tag) echo $tag."<br>";

        $tags = Tag::all();

        foreach($tags as $post){
            $flag = 1;
            foreach($searchtags as $tag){
                if($flag == 0) break;
                if($post->$tag == 0) $flag = 0;
            }
            if($flag){
                echo $post->post_id."<br>";
            }
        }
    }

    public function searchByArea($dist){
        $found = 0;
        $address = Address::all();
        foreach($address as $add){
            if($add->District == $dist){
                $found++;
                echo $add->post_id."<br>";
            }
        }

        if($found == 0) echo "No posts found in ".$dist;
    }
}
