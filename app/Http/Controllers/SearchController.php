<?php

namespace App\Http\Controllers;

use App\Photo;
use Auth;
use DB;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Address;
use App\User;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        echo "yoyoyo";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "called";


        $tags = $request->searchTags;
        $area = $request->searchArea;

        //if($area != "Select Area") echo $request->searchArea."<br>"."<br>";
//        if(sizeof($tags) > 0){
//            foreach($tags as $tag) echo $tag."<br>";
//        }

        if($area != "Select Area" && sizeof($tags) > 0){
            $postsArr = $this->searchPosts($tags , $area);
        }
        else if($area == "Select Area" && sizeof($tags) > 0){
            $postsArr = $this->searchByTag($tags);
        }
        else if($area != "Select Area" && sizeof($tags) == 0){
            $postsArr = $this->searchByArea($area);
        }
        else return view('TS_home');

        $size = sizeof($postsArr);
        $authorArr = array_fill(0 , $size , null);
        $titleArr = array_fill(0 , $size , null);
        $reviewArr = array_fill(0 , $size , null);
        $addressArr = array_fill(0 , $size , null);
        $imgArr = array_fill(0 , $size , null);

        $allPost = Post::all();
        $allUser = User::all();
        $allAdd = Address::all();
        $allImg = Photo::all();

        $cnt = 0;
        foreach($postsArr as $postId){
            $userId = 0;
            foreach($allPost as $post){
                if($post->id == $postId){
                    $titleArr[$cnt] = $post->title;
                    $reviewArr[$cnt] = substr($post->review,0 , 400);

                    //echo $post->id." => ".

                    $userId = $post->user_id;
                    break;
                }
            }
            foreach($allAdd as $add){
                if($add->post_id == $postId){
                    $addressArr[$cnt] = $add->Address;
                    break;
                }
            }
            foreach ($allUser as $user) {
                if ($user->id == $userId) {
                    $authorArr[$cnt] = $user->name;
                }
            }

            $sz = 0;
            foreach($allImg as $img){
                if($img->post_id == $postId) $sz++;
            }

            $sz=min($sz, 6);

            $imgArr[$cnt] = array_fill(0 , $sz, null);
            $c = 0;

            //echo $postId." ".$sz."<br>";

            foreach($allImg as $img){
                if($img->post_id == $postId){
                    $imgArr[$cnt][$c] = $img->path;
                    $c++;
                    if($c == 6) break;
                }
            }
            $cnt++;
        }

//        for($i = 0 ; $i<$size ; $i++){
//            echo $i." ===> ".$postsArr[$i]."<br>";
//
//            echo $titleArr[$i]." ".$authorArr[$i]."<br>";
//            echo $reviewArr[$i]."<br> --------------====> ".strlen($reviewArr[$i])."<br>";
//            echo $addressArr[$i]."<br>";
//            foreach($imgArr[$i] as $img) echo $img."<br>";
//
//            echo "<br>";
//        }

        return view('showSearchRes' , compact('postsArr' , 'titleArr' , 'authorArr' , 'reviewArr' , 'addressArr' , 'imgArr'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postsArr , $size)
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
    }

    public function searchPosts($tags , $area){
        $address = Address::all();
        $tagTable = Tag::all();
        $allPost = Post::all();

        $saveId = array_fill(0 , 100 , null);
        $cnt = 0;


        foreach($address as $add){
            if($add->District == $area){
                foreach($tagTable as $table) {
                    if ($add->post_id == $table->post_id) {
                        $flag = 1;
                        foreach ($tags as $tag) {
                            //echo $add->post_id . "<br>";
                            //echo $tag->post_id . "<br>";
                            //echo $add->post_id . "<br>";
                            if ($table->$tag == 0) {
                                $flag = 0;
                                break;
                            }
                        }
                        if($flag == 1){
                            //echo $add->post_id."<br>";
                            $saveId[$cnt] = $add->post_id;
                            $cnt++;
                        }
                    }
                }
            }
        }

        $postId = array_fill(0 , $cnt , null);
        for($i = 0 ; $i < $cnt ; $i++) $postId[$i] = $saveId[$i];
        return $postId;

        //echo "Hiii"."<br>";
        //$this->show($saveId , $cnt);
        //echo "Hiii"."<br>";
    }


    public function searchByTag($tagarr){
        //$searchtags = explode("+" , $tagarr);
        //echo "HI"."<br>";
        $searchtags = $tagarr;
        //foreach($searchtags as $tag) echo $tag."<br>";

        $tags = Tag::all();

        $cnt = 0;
        $saveId = array_fill(0 , 100 , null);
        foreach($tags as $post){
            $flag = 1;
            foreach($searchtags as $tag){
                if($flag == 0) break;
                if($post->$tag == 0) $flag = 0;
            }
            if($flag){
                //echo $post->post_id."<br>";
                $saveId[$cnt] = $post->post_id;
                $cnt++;
            }
        }

        $postId = array_fill(0 , $cnt , null);
        for($i = 0 ; $i < $cnt ; $i++) $postId[$i] = $saveId[$i];
        return $postId;

        //$this->show($saveId , $cnt);
    }

    public function searchByArea($dist){
        //echo $dist;
        $found = 0;
        $address = Address::all();

        $cnt = 0;
        $saveId = array_fill(0 , 100 , null);
        foreach($address as $add){
            if($add->District == $dist){
                $found++;
                //echo $add->post_id."<br>";
                $saveId[$cnt] = $add->post_id;
                $cnt++;
            }
        }

        $postId = array_fill(0 , $cnt , null);
        for($i = 0 ; $i < $cnt ; $i++) $postId[$i] = $saveId[$i];
        return $postId;

        //$this->show($saveId , $cnt);
        //if($found == 0) echo "No posts found in ".$dist;
    }
}
