<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use App\Post;
use Input;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if($request->hasFile('image')) {
            $input = $request->file('image');
            echo "<br>" . "=======>" . sizeof($input);

            foreach ($input as $image) {
                echo "<br>" . "=======>" . $image->getClientOriginalName();
            }

            $pstArr = Post::all();
            $len = sizeof($pstArr);

            //echo "<br>"."=======>";
            if ($len == 0) $postId = 1;
            else $postId = $pstArr[$len - 1]->id + 1;

            $cnt = 1;
            foreach ($input as $img) {
                $ext = $img->getClientOriginalExtension();

                //echo "<br>"."=======>";
                //echo $ext."<br>";

                if ($ext == 'jpg' || $ext == 'png') {
                    $name = $cnt . "." . $img->getClientOriginalExtension();
                    $cnt++;
                    $img->move('images/posts/' . $postId, $name);

                    $photo = new Photo();
                    $photo->description = "No description";
                    $photo->post_id = $postId;
                    $photo->path = "images/posts/" . $postId . "/" . $name;
                    //$photo->save();

                    echo "successfully uploaded" . "<br>";
                }
            }

            echo "Process terminated";
        }
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
}
