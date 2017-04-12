<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Address;

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
        //
        $tags = $request->searchTags;
        $area = $request->searchArea;

        if($area != "select area") echo $request->searchArea."<br>"."<br>";
        if(sizeof($tags) > 0){
            foreach($tags as $tag) echo $tag."<br>";
        }

        if($area != "select area" && sizeof($tags) > 0){
            $this->searchPosts($tags , $area);
        }
        else if($area == "select area" && sizeof($tags) > 0){
            $this->searchByTag($tags);
        }
        else if($area != "select area" && sizeof($tags) == 0){
            $this->searchByArea($area);
        }
        //else redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
                            echo $add->post_id;
                        }
                    }
                }
            }
        }
    }

    public function searchByTag($tagarr){
        //$searchtags = explode("+" , $tagarr);
        $searchtags = $tagarr;
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
        echo $dist;
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
