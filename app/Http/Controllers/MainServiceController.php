<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\Post;
use App\Photo;
use App\User;
use App\Hotel;
use App\Service;
use App\Tag;
use App\Address;
use App\Http\Requests;
use App\Comment;
use App\Reply;

class MainServiceController extends Controller
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
        //

        $userId = Auth::user()->id;

        $service = new Hotel();
        $service->manager_id = $userId;
        $service->title = $request->title;
        $service->area = $request->area;
        $service->address = $request->address;
        $service->description = $request->description;
        $service->contactInfo = $request->contactInfo;
        $service->save();

        $input = $request->file('img');
//        echo "<br>"."Called =======>".sizeof($input);
//
//        foreach($input as $image){
//            echo "<br>"."=======>".$image->getClientOriginalName();
//        }

        $postId = $service->id;

        //echo "<br>"."=======>";

        $cnt = 1;
        if($request->hasFile('img')) {
            foreach ($input as $img) {
                $ext = $img->getClientOriginalExtension();

                //echo "<br>"."=======>";
                //echo $ext."<br>";

                if ($ext == 'jpg' || $ext == 'png') {
                    $name = $cnt . "." . $img->getClientOriginalExtension();
                    $cnt++;
                    $img->move('images/services/' . $postId, $name);

                    $photo = new Photo();
                    $photo->description = "No description";
                    $photo->hotel_id = $postId;
                    $photo->path = "images/services/" . $postId . "/" . $name;
                    $photo->save();

                    //echo "successfully uploaded" . "<br>";
                }
            }
        }

        //echo "Process terminated";

        $allService = Service::all();
        $allPhoto = Photo::all();
        $size = 0;
        foreach($allService as $service){
            if($service->hotel_id == $postId) $size++;
        }

        $description = array_fill(0 , $size , null);
        $priceInfo = array_fill(0 , $size , null);
        $imgArr = array_fill(0 , $size , null);
        $idArr = array_fill(0 , $size , null);
        $cnt = 0;

        foreach($allService as $service){
            if($service->hotel_id == $postId) {
                $description[$cnt] = $service->description;
                $priceInfo[$cnt] = $service->priceInfo;
                $idArr[$cnt] = $service->id;
                //echo ">>>> " . $service->description . " " . $service->priceInfo . "<br>";
                //echo $cnt . "==> " . $description[$cnt] . " " . $priceInfo[$cnt] . "<br>";

                $sz = 0;
                foreach ($allPhoto as $photo) {
                    if ($photo->hotel_id == $postId && $photo->service_id == $service->id) $sz++;
                }
                $i = 0;
                $sz = min($sz, 4);
                $imgArr[$cnt] = array_fill(0, $sz, null);

                foreach ($allPhoto as $photo) {
                    if ($photo->hotel_id == $postId && $photo->service_id == $service->id) {
                        $imgArr[$cnt][$i] = $photo->path;
                        $i++;
                    }
                }
                $cnt++;
            }
        }

//        for($i = 0 ; $i<$size ; $i++){
//            echo "------>".$description[$i]." ".$priceInfo[$i]."<br>";
//
//            foreach($imgArr[$i] as $path) echo "---->".$path."<br>";
//        }
//
        //echo "Hiiiiiiiiiiiiii ===> ".$postId."<br>";


        return view('additionalService' , compact('idArr' , 'description' , 'priceInfo' , 'imgArr'));
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
        $postId = $id;
        $allHotel = Hotel::all();
        $allPhoto = Photo::all();
        $allService = Service::all();

        $hotel = new Hotel();
        foreach($allHotel as $htl){
            if($htl->id == $id){
                $hotel = $htl;
                break;
            }
        }

        $title = $hotel->title;
        $address = $hotel->address;
        $description = $hotel->description;
        $contactInfo = $hotel->contactInfo;

        $sz = 0;
        foreach($allPhoto as $photo) if($photo->hotel_id == $hotel->id && $photo->service_id == 0) $sz++;
        $mainImgArr = array_fill(0 , $sz , null);

        $c = 0;
        foreach($allPhoto as $photo) {
            if($photo->hotel_id == $hotel->id && $photo->service_id == 0){
                $mainImgArr[$c] = $photo->path;
                $c++;
            }
        }

        $size = 0;
        foreach($allService as $service) if($service->hotel_id == $hotel->id) $size++;

        $serviceImgArr = array_fill(0 , $size , null);
        $serviceDescArr = array_fill(0 , $size , null);
        $servicePriceArr = array_fill(0 , $size , null);

        $i = 0;
        foreach($allService as $service) {
            if($service->hotel_id == $hotel->id){
                $serviceDescArr[$i] = $service->description;
                $servicePriceArr[$i] = $service->priceInfo;

                $j = 0;
                foreach($allPhoto as $photo) if($photo->hotel_id == $hotel->id && $photo->service_id == $service->id) $j++;
                $serviceImgArr[$i] = array_fill(0 , $j , null);

                $k = 0;
                foreach($allPhoto as $photo) {
                    if($photo->hotel_id == $hotel->id && $photo->service_id == $service->id) {
                        $serviceImgArr[$i][$k] = $photo->path;
                        $k++;
                    }
                }

                $i++;
            }
        }

        $allComment = Comment::all();
        $allReply = Reply::all();

        $size = 0;
        foreach($allComment as $comment) if($comment->hotel_id == $postId) $size++;

        $commentContent = array_fill(0 , $size , null);
        $commentAuthor = array_fill(0 , $size , null);
        $replyContent = array_fill(0 , $size , null);
        $replyAuthor = array_fill(0 , $size , null);

        $cnt = 0;
        foreach($allComment as $comment){
            if($comment->hotel_id == $hotel->id){
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
        try {
            if (Auth::user()->id == $hotel->manager_id) $showEdit = 1;
        }catch(\Exception $e){

        }

        $manager_id = $hotel->manager_id;
        $manager = User::find($manager_id);

        return view('displayHotel' , compact('showEdit' , 'postId' , 'title' , 'address' , 'description' , 'contactInfo' , 'serviceImgArr' ,
            'mainImgArr','serviceDescArr' , 'servicePriceArr', 'commentContent' , 'commentAuthor' , 'manager'));
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

    public function editFormDisplay($id){
        $hotel = Hotel::find($id);
        try {
            if (Auth::user()->id != $hotel->manager_id) return redirect()->back();
        }catch(\Exception $e){
            return redirect('/');
        }

        return view('EditMainService', compact('hotel'));
    }

    public function saveEdited(Request $request){
        $id = $request->hotel_id;
        $service = Hotel::find($id);
        $service->title = $request->title;
        $service->area = $request->area;
        $service->address = $request->address;
        $service->description = $request->description;
        $service->contactInfo = $request->contactInfo;
        $service->save();

        $allImg = Photo::all();
        if($request->deletePrevImages == "on"){
            foreach($allImg as $img) if($img->hotel_id == $service->id && $img->service_id == 0) $img->delete();
        }
        $input = $request->file('img');
        if($request->hasFile('img')){
            $cnt = 0;
            foreach($allImg as $img) if($img->hotel_id == $service->id && $img->service_id == 0){
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
            foreach ($input as $img) {
                $ext = $img->getClientOriginalExtension();

                //echo "<br>"."=======>";
                //echo $ext."<br>";

                if ($ext == 'jpg' || $ext == 'png') {
                    $name = $cnt . "." . $img->getClientOriginalExtension();
                    $cnt++;
                    $img->move('images/services/' .$service->id, $name);

                    $photo = new Photo();
                    $photo->description = "No description";
                    $photo->hotel_id = $service->id;
                    $photo->path = "images/services/" . $service->id . "/" . $name;
                    $photo->save();
                    //echo "successfully uploaded" . "<br>";
                }
            }
        }



        $postId = $service->id;
        $allService = Service::all();
        $allPhoto = Photo::all();
        $size = 0;
        foreach($allService as $service){
            if($service->hotel_id == $postId) $size++;
        }

        $description = array_fill(0 , $size , null);
        $priceInfo = array_fill(0 , $size , null);
        $imgArr = array_fill(0 , $size , null);
        $idArr = array_fill(0 , $size , null);
        $cnt = 0;

        foreach($allService as $service){
            if($service->hotel_id == $postId) {
                $description[$cnt] = $service->description;
                $priceInfo[$cnt] = $service->priceInfo;
                $idArr[$cnt] = $service->id;
                //echo ">>>> " . $service->description . " " . $service->priceInfo . "<br>";
                //echo $cnt . "==> " . $description[$cnt] . " " . $priceInfo[$cnt] . "<br>";

                $sz = 0;
                foreach ($allPhoto as $photo) {
                    if ($photo->hotel_id == $postId && $photo->service_id == $service->id) $sz++;
                }
                $i = 0;
                $sz = min($sz, 4);
                $imgArr[$cnt] = array_fill(0, $sz, null);

                foreach ($allPhoto as $photo) {
                    if ($photo->hotel_id == $postId && $photo->service_id == $service->id) {
                        $imgArr[$cnt][$i] = $photo->path;
                        $i++;
                    }
                }
                $cnt++;
            }
        }

//        for($i = 0 ; $i<$size ; $i++){
//            echo "------>".$description[$i]." ".$priceInfo[$i]."<br>";
//
//            foreach($imgArr[$i] as $path) echo "---->".$path."<br>";
//        }
//
//        echo "Hiiiiiiiiiiiiii ===> ".$size."<br>";
        return view('additionalService' , compact('idArr' , 'description' , 'priceInfo' , 'imgArr'));
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
