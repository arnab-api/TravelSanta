<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Address;
use App\Hotel;
use App\Service;
use App\Photo;

use App\Http\Requests;

class SearchHotelController extends Controller
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
        //echo $request->postId;
        $allAddress = Address::all();
        $area = "NA";

        foreach($allAddress as $add){
            if($add->post_id == $request->postId){
                $area = $add->District;
                break;
            }
        }

        $allHotel = Hotel::all();
        $size = 0;
        foreach($allHotel as $hotel) if($hotel->area == $area) $size++;

        $hotelidArr = array_fill(0 , $size , null);
        $titleArr = array_fill(0 , $size , null);
        $addressArr = array_fill(0 , $size , null);
        $descriptionArr = array_fill(0 , $size , null);
        $contactArr = array_fill(0 , $size , null);
        $mainImgArr = array_fill(0 , $size , null);


        $allService = Service::all();
        $allPhoto = Photo::all();

        $serviceImgArr = array_fill(0 , $size , null);
        $serviceDescArr = array_fill(0 , $size , null);
        $servicePriceArr = array_fill(0 , $size , null);

        $cnt = 0;
        foreach($allHotel as $hotel) {
            if($hotel->area == $area) {
                $hotelidArr[$cnt] = $hotel->id;
                $titleArr[$cnt] = $hotel->title;
                $addressArr[$cnt] = $hotel->address;
                $descriptionArr[$cnt] = $hotel->description;
                $contactArr[$cnt] = $hotel->contactInfo;

                $sz = 0;
                foreach($allPhoto as $photo) if($photo->hotel_id == $hotel->id && $photo->service_id == 0) $sz++;
                $mainImgArr[$cnt] = array_fill(0 , $sz , null);
                $c = 0;
                foreach($allPhoto as $photo) {
                    if($photo->hotel_id == $hotel->id && $photo->service_id == 0){
                        $mainImgArr[$cnt][$c] = $photo->path;
                        $c++;
                    }
                }

                $sz = 0;
                foreach($allService as $service) if($service->hotel_id == $hotel->id) $sz++;
                $serviceImgArr[$cnt] = array_fill(0 , $sz , null);
                $serviceDescArr[$cnt] = array_fill(0 , $sz , null);
                $servicePriceArr[$cnt] = array_fill(0 , $sz , null);

                $i = 0;
                foreach($allService as $service) {
                    if($service->hotel_id == $hotel->id){
                        $serviceDescArr[$cnt][$i] = $service->description;
                        $servicePriceArr[$cnt][$i] = $service->priceInfo;

                        $j = 0;
                        foreach($allPhoto as $photo) if($photo->hotel_id == $hotel->id && $photo->service_id == $service->id) $j++;
                        $serviceImgArr[$cnt][$i] = array_fill(0 , $j , null);

                        $k = 0;
                        foreach($allPhoto as $photo) {
                            if($photo->hotel_id == $hotel->id && $photo->service_id == $service->id) {
                                $serviceImgArr[$cnt][$i][$k] = $photo->path;
                                $k++;
                            }
                        }

                        $i++;
                    }
                }

                $cnt++;
            }
        }

//        for($i = 0 ; $i<$size ; $i++){
//            echo $hotelidArr[$i]."<br>";
//            echo $titleArr[$i]."<br>";
//            echo $descriptionArr[$i]."<br>";
//            echo $addressArr[$i]."<br>";
//            echo $contactArr[$i]."<br>";
//
//            foreach($mainImgArr[$i] as $photo) echo "  --> ".$photo."<br>";
//
//            for($j = 0 ; $j<sizeof($serviceDescArr[$i]) ; $j++){
//                echo "   => ".$serviceDescArr[$i][$j]." ".$servicePriceArr[$i][$j]."<br>";
//                foreach($serviceImgArr[$i][$j] as $photo){
//                    echo "     --> ".$photo."<br>";
//                }
//            }
//        }
        
        return view('showHotelresults' , compact('hotelidArr' , 'titleArr' , 'descriptionArr' , 'addressArr' , 'contactArr' , 'mainImgArr'));
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
