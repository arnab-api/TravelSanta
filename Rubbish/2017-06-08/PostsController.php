<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Post;
use App\Photo;
use App\User;
use App\Hotel;
use App\Service;
use App\Comment;
use App\Reply;

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
        $isManager = Auth::user()->is_admin;

        //echo "Hiii".$isManager;

        if($isManager == 0) return view('posts.create');
        else {
            //echo "HI";
            return view('mainService');
        }
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


        $this->addPost($request);
    }

    public function addPost(Request $request){
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


        //$input = $request->file('img');
        //echo "<br>"."Called =======>".sizeof($input);

        $this->imageUpload($request , $postId->id);


        //return $post->id;
    }

    public function imageUpload(Request $request , $postId){

        $input = $request->file('img');
        echo "<br>"."Called =======>".sizeof($input);

        foreach($input as $image){
            echo "<br>"."=======>".$image->getClientOriginalName();
        }

        $pstArr = Post::all();
        $len = sizeof($pstArr);

        //echo "<br>"."=======>";

        $cnt = 1;
        foreach($input as $img){
            $ext = $img->getClientOriginalExtension();

            //echo "<br>"."=======>";
            //echo $ext."<br>";

            if($ext == 'jpg' || $ext == 'png') {
                $name = $cnt.".".$img->getClientOriginalExtension();
                $cnt++;
                $img->move('images/posts/'.$postId, $name);

                $photo = new Photo();
                $photo->description = "No description";
                $photo->post_id = $postId;
                $photo->path = "images/posts/".$postId."/".$name;
                $photo->save();

                echo "successfully uploaded" . "<br>";
            }
        }

        echo "Process terminated";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $allPost = Post::all();
        $found = false;
        $title = "Not available";
        $review = "Not available";
        $author = "John Doe";
        $userId = 0;
        $address = "Not available";

        foreach($allPost as $post){
            if($post->id == $postId){
                $found = true;
                $title = $post->title;
                $review = $post->review;
                $userId = $post->user_id;
                break;
            }
        }

        if($found == true) {

            $allUser = User::all();
            foreach ($allUser as $user) {
                if ($user->id == $userId) {
                    $author = $user->name;
                }
            }

            $size = 0;

            $allImg = Photo::all();
            foreach($allImg as $img){
                if($img->post_id == $postId) $size++;
            }
                
            $imgArr = array_fill(0 , $size , null);
            $cnt = 0;
            foreach($allImg as $img){
                if($img->post_id == $postId){
                    $imgArr[$cnt] = $img->path;
                    $cnt++;
                }
            }

            $allAdd = Address::all();

            foreach($allAdd as $add){
                if($add->post_id == $postId){
                    $address = $add->Address;
                    break;
                }
            }

            $addr = $address;
            $descr = $review;

//            echo $title."<br>";
//            echo $author."<br>";
//            echo $review."<br>";
//            echo $address."<br>";
//
//
//            foreach($imgArr as $path){
//                echo $path."<br>";
//            }
            return view('display' , compact('postId' , 'imgArr' , 'title' , 'author' , 'addr' , 'descr'));

        }
        else{
            echo "No such posts found    lhlkajsdhfkj "."<br>";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "Edit method called";
    }

    public function editFormDisplay($id){
        //echo "HI HI HI ===> ".$id;
        $allPost = Post::all();
        $post = new Post();
        foreach($allPost as $pst){
            if($pst->id == $id){
                $post = $pst;
                break;
            }
        }

        $title = $post->title;
        $review = $post->review;

        echo $title."<br>";
        echo $review."<br>";

        return view('editPost' ,compact( 'title' , 'review'));
    }

    public function saveEdited(Request $request){
        echo "Request Received";
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
        echo "called"."<br>";
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

    public function postDisplay($postId){
        $allPost = Post::all();
        $found = false;
        $title = "Not available";
        $review = "Not available";
        $author = "John Doe";
        $userId = 0;
        $address = "Not available";

        foreach($allPost as $post){
            if($post->id == $postId){
                $found = true;
                $title = $post->title;
                $review = $post->review;
                $userId = $post->user_id;
                break;
            }
        }

        if($found == true) {

            $allUser = User::all();
            foreach ($allUser as $user) {
                if ($user->id == $userId) {
                    $author = $user->name;
                }
            }

            $size = 0;

            $allImg = Photo::all();
            foreach($allImg as $img){
                if($img->post_id == $postId) $size++;
            }

            $imgArr = array_fill(0 , $size , null);
            $cnt = 0;
            foreach($allImg as $img){
                if($img->post_id == $postId){
                    $imgArr[$cnt] = $img->path;
                    $cnt++;
                }
            }

            $allAdd = Address::all();

            foreach($allAdd as $add){
                if($add->post_id == $postId){
                    $address = $add->Address;
                    break;
                }
            }

            $addr = $address;
            $descr = $review;

//            echo $title."<br>";
//            echo $author."<br>";
//            echo $review."<br>";
//            echo $address."<br>";
//
//
//            foreach($imgArr as $path){
//                echo $path."<br>";
//            }


            $allComment = Comment::all();
            $allReply = Reply::all();

            $size = 0;
            foreach($allComment as $comment) if($comment->post_id == $postId) $size++;

            $commentContent = array_fill(0 , $size , null);
            $commentAuthor = array_fill(0 , $size , null);
            $replyContent = array_fill(0 , $size , null);
            $replyAuthor = array_fill(0 , $size , null);

            $cnt = 0;
            foreach($allComment as $comment){
                if($comment->post_id == $postId){
                    $commentContent[$cnt] = $comment->content;
                    $commentAuthor[$cnt] = $comment->author;

                    $sz = 0;
                    foreach($allReply as $reply) if($reply->comment_id == $comment->id) $sz++;
                    $replyContent[$cnt] = array_fill(0 , $sz , null);
                    $replyAuthor[$cnt] = array_fill(0 , $sz , null);

                    $i = 0;
                    foreach($allReply as $reply) if($reply->comment_id == $comment->id){
                        $replyContent[$cnt][$i] = $reply->content;
                        $replyAuthor[$cnt][$i] = $reply->author;

                        $i++;
                    }

                    $cnt++;
                }
            }


            return view('display' , compact('postId', 'imgArr' , 'title' , 'author' , 'addr' , 'descr'));

        }
        else{
            echo "No such posts found lalalalal"."<br>";
        }
    }
}
