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

class AdditionalServiceController extends Controller
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

        //echo "Add service store called"."<br>";

        $allHotel = Hotel::all();
        $sz = sizeof($allHotel);
        $hotelId = $allHotel[$sz-1]->id;

        $service = new Service();
        $service->hotel_id = $hotelId;
        $service->description = $request->description;
        $service->priceInfo = $request->priceInfo;
        $service->save();

        $input = $request->file('img');
        //echo "<br>"."Called =======>".sizeof($input);
//
//        foreach($input as $image){
//            echo "<br>"."=======>".$image->getClientOriginalName();
//        }

        $postId = $hotelId;

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
                    $img->move('images/services/' . $postId . "/" . $service->id, $name);

                    $photo = new Photo();
                    $photo->description = "No description";
                    $photo->hotel_id = $postId;
                    $photo->service_id = $service->id;
                    $photo->path = "images/services/" . $postId . "/" . $service->id . "/" . $name;
                    $photo->save();

                    // echo "successfully uploaded  ====>: " . $postId . "<br>";

                }
            }
        }

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
    public function destroy(Request $request)
    {
        //
        //echo "destroy called ".$request->service_id."<br>";
        $id = $request->service_id;
        $service = Service::find($id);
        $hotel_id = $service->hotel_id;
        $service->delete();

        //echo $hotel_id;

        $allPhoto = Photo::all();
        foreach ($allPhoto as $photo) {
            if ($photo->hotel_id == $hotel_id && $photo->service_id == $id) $photo->delete();
        }

        $postId = $service->hotel_id;
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
}
