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

/*    public function __construct()
    {
        $this->middleware('auth');
    }*/

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
        try {
            $isManager = Auth::user()->is_admin;

            //echo "Hiii".$isManager;

            if ($isManager == 0) return view('posts.create');
            else {
                //echo "HI";
                return view('mainService');
            }
        }catch(\Exception $e){
            return redirect('\tslogin');
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

        try {
            $this->addPost($request);
            return redirect('/');
        }catch(\Exception $e){
            return redirect('/tslogin');
        }
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

            //echo $tags[$i]."<br>";
        }
        $tag->post_id = $postId->id;
        $tag->save();

        //echo $request->distList;

        $add = new Address();
        $add->post_id = $postId->id;
        $add->District = $request->dist;
        $add->Address = $request->address;
        $add->save();

        //echo $add->District;


        //$input = $request->file('img');
        //echo "<br>"."Called =======>".sizeof($input);
        if($request->hasFile('img')) $this->imageUpload($request , $postId->id);
        //return $post->id  ;
    }

    public function imageUpload(Request $request , $postId){

        $input = $request->file('img');
        //echo "<br>"."Called =======>".sizeof($input);

//        foreach($input as $image){
//            //echo "<br>"."=======>".$image->getClientOriginalName();
//        }

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

                //echo "successfully uploaded" . "<br>";
            }
        }

        //echo "Process terminated";
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
            return view('display' , compact('userId', 'postId' , 'imgArr' , 'title' , 'author' , 'addr' , 'descr'));

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
        //try {
            $allPost = Post::all();
            $post = new Post();
            foreach ($allPost as $pst) {
                if ($pst->id == $id) {
                    $post = $pst;
                    break;
                }
            }

            $title = $post->title;
            $review = $post->review;
            $user_id = $post->user_id;
            if (Auth::user()->id != $user_id) return redirect()->back();

            $allAddress = Address::all();
            $address = new Address();
            foreach($allAddress as $ad){
                if($ad->post_id == $id){
                    $address = $ad;
                    break;
                }
            }

            $allTag = Tag::all();
            $tag = new Tag();
            $post_id = $id;
            foreach($allTag as $tg){
                if($tg->post_id == $post_id){
                    $tag = $tg;
                    break;
                }
            }

            $district = $address->District;
            $detailAdd = $address->Address;
            return view('editPost', compact('post_id' , 'title', 'review','district','detailAdd' , 'tag'));
//        }catch(\Exception $e){
//            return redirect('\tslogin');
//        }
    }

    public function saveEdited(Request $request){
        echo $request->post_id;
        $post = Post::find($request->post_id);
        $post->title = $request->placeTitle;
        $post->review = $request->placeDes;
        $post->save();
        $post_id = $post->id;

        $allAddress = Address::all();
        foreach($allAddress as $ad){
            if($ad->post_id == $post_id){
                $adId = $ad->id;
                break;
            }
        }
        $address = Address::find($adId);
        $address->District = $request->dist;
        $address->Address = $request->address;
        $address->save();

        $allTag = Tag::all();
        $tag = new Tag();
        foreach($allTag as $tg){
            if($tg->post_id == $post_id){
                $tag = $tg;
                break;
            }
        }
        if($request->hills == "on") $tag->hills = 1;
        else $tag->hills = 0;
        if($request->sea == "on") $tag->sea = 1;
        else $tag->sea = 0;
        if($request->heritage == "on") $tag->heritage = 1;
        else $tag->heritage = 0;
        if($request->architecture == "on") $tag->architecture = 1;
        else $tag->architecture = 0;
        if($request->river == "on") $tag->river = 1;
        else $tag->river = 0;
        if($request->riverside == "on") $tag->riverside = 1;
        else $tag->riverside = 0;
        if($request->lake == "on") $tag->lake = 1;
        else $tag->lake = 0;
        if($request->forest == "on") $tag->forest = 1;
        else $tag->forest = 0;
        if($request->green == "on") $tag->green = 1;
        else $tag->green = 0;

        $tag->save();

        $allImg = Photo::all();
        if($request->deletePrevImages == "on"){
            foreach($allImg as $img) if($img->post_id == $post->id) $img->delete();
        }
        $cnt = 0;
        foreach($allImg as $img) if($img->post_id == $post->id) {
            $val = 0;
            $name = $img->path;
            $id = 0;
            for($i = 0 ; $i<strlen($name) ; $i++){
                if($name[$i] == '.') {
                    $id = $i;
                    break;
                }
            }
            //echo ">>>>>> ".$id.'<br>';
            $power = 0;
            for($j = $id-1 ; $j>=0 && $name[$j] != '/' ; $j--) {
                $val = $val + $name[$j]*pow(10 , $power);
                $power++;
                //echo "--> ".$name[$j];
            }
            //echo "=====> ".$val.'<br>';
            $cnt = max($cnt , $val);
        }

        $cnt++;

        //echo $cnt.'<br>';
        $input = $request->file('img');
        if($request->hasFile('img')){
            foreach ($input as $img) {
                $ext = $img->getClientOriginalExtension();
                if ($ext == 'jpg' || $ext == 'png') {
                    $name = $cnt . "." . $img->getClientOriginalExtension();
                    $cnt++;
                    $img->move('images/posts/' . $post_id, $name);

                    $photo = new Photo();
                    $photo->description = "No description";
                    $photo->post_id = $post_id;
                    $photo->path = "images/posts/" . $post_id . "/" . $name;
                    $photo->save();

                    //echo $img." successfully uploaded".'<br>';
                }
            }
        }
        return redirect('/display/'.$request->post_id);
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
                    $commentAuthor[$cnt] = $comment->author." : ";

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

            $showEdit = 0;
            try{
                if(Auth::user()->id == $userId) $showEdit = 1;
            }catch(\Exception $e){

            }

            return view('display' , compact('userId' , 'showEdit' , 'postId', 'imgArr' , 'title' , 'author' , 'addr' , 'descr' , 'commentAuthor' , 'commentContent'));

        }
        else{
            echo "No such posts found lalalalal"."<br>";
        }
    }
}
