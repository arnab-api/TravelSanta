<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Post;
use App\Hotel;
use Auth;
use Mockery\CountValidator\Exception;

class UserController extends Controller
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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showProfile()
    {
        $id = Auth::user()->id;
        //echo $id;
        //$this->show($id);
        $user = new User();
        $allUser = User::all();
        foreach ($allUser as $us) {
            if ($us->id == $id) {
                $user = $us;
            }
        }
        $userName = $user->name;
        $fullName = $user->first_name . " " . $user->last_name;
        $email = $user->email;
        $isAdmin = $user->is_admin;
        $profilePic = $user->profile_pic;

        $status = "lala";
        if ($isAdmin == 0) $status = "Tourist";
        else $status = "Service Provider";

        if($status == "Tourist") {
            $allPost = Post::all();
            $size = 0;
            foreach ($allPost as $post) if ($post->user_id == $id) $size++;

            $cnt = 0;
            $postIdArr = array_fill(0, $size, null);
            $postTitles = array_fill(0, $size, null);
            foreach ($allPost as $post) if ($post->user_id == $id) {
                $postIdArr[$cnt] = $post->id;
                $postTitles[$cnt] = $post->title;
                $cnt++;
            }
        }
        else{
            $allHotel = Hotel::all();
            $size = 0;
            foreach ($allHotel as $hotel) if ($hotel->manager_id == $id) $size++;

            $cnt = 0;
            $postIdArr = array_fill(0, $size, null);
            $postTitles = array_fill(0, $size, null);
            foreach ($allHotel as $hotel) if ($hotel->manager_id == $id) {
                $postIdArr[$cnt] = $hotel->id;
                $postTitles[$cnt] = $hotel->title;
                $cnt++;
            }
        }

        $showEdit = 1;
        return view('UserProfile' , compact('id', 'showEdit' , 'status' , 'userName' , 'fullName' , 'email' , 'profilePic' , 'isAdmin' , 'postIdArr' , 'postTitles'));
    }

    public function show($id)
    {
        //echo "called";
        try{
            $showEdit = 0;
            if(Auth::user()->id == $id) $showEdit = 1;

            $user = new User();
            $allUser = User::all();
            foreach($allUser as $us){
                if($us->id == $id){
                    $user = $us;
                }
            }
            $userName = $user->name;
            $fullName = $user->first_name." ".$user->last_name;
            $email = $user->email;
            $isAdmin = $user->is_admin;
            $profilePic = $user->profile_pic;

            $status = "lala";
            if ($isAdmin == 0) $status = "Tourist";
            else $status = "Service Provider";

            if($status == "Tourist") {
                $allPost = Post::all();
                $size = 0;
                foreach ($allPost as $post) if ($post->user_id == $id) $size++;

                $cnt = 0;
                $postIdArr = array_fill(0, $size, null);
                $postTitles = array_fill(0, $size, null);
                foreach ($allPost as $post) if ($post->user_id == $id) {
                    $postIdArr[$cnt] = $post->id;
                    $postTitles[$cnt] = $post->title;
                    $cnt++;
                }
            }
            else{
                $allHotel = Hotel::all();
                $size = 0;
                foreach ($allHotel as $hotel) if ($hotel->manager_id == $id) $size++;

                $cnt = 0;
                $postIdArr = array_fill(0, $size, null);
                $postTitles = array_fill(0, $size, null);
                foreach ($allHotel as $hotel) if ($hotel->manager_id == $id) {
                    $postIdArr[$cnt] = $hotel->id;
                    $postTitles[$cnt] = $hotel->title;
                    $cnt++;
                }
            }
            return view('UserProfile' , compact('id', 'showEdit' , 'userName' , 'status' , 'fullName' , 'email' , 'profilePic' , 'isAdmin' , 'postIdArr' , 'postTitles'));
        }
        catch(\Exception $e){
            //echo "You are not logged in";
            return redirect('/tslogin');
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
        //
    }

    public function editFormDisplay($id){
        try {
            $allUser = User::all();
            $user = new User();
            foreach ($allUser as $us) {
                if ($us->id == $id) {
                    $user = $us;
                    break;
                }
            }

            $userName = $user->name;
            $firstName = $user->first_name;
            $lastName = $user->last_name;
            $email = $user->email;
            $isAdmin = $user->is_admin;
            $profilePic = $user->profile_pic;
            $status = "lala";
            if($isAdmin == 0) $status = "Tourist";
            else $status = "Service Provider";

            if (Auth::user()->id != $user->id) return redirect()->back();
            return view('EditProfile', compact('userName' , 'id' , 'status' , 'firstName' , 'lastName' , 'email' , 'isAdmin' , 'profilePic'));

        }catch(\Exception $e){
            return redirect('\tslogin');
        }
    }

    public function saveEdited(Request $request){
        $allUser = User::all();
        $user = new User();
        foreach ($allUser as $us) {
            if ($us->id == $request->id) {
                $user = $us;
                break;
            }
        }

        $user->name = $request->userName;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        $profilePic = $request->file('pic');
        if($profilePic != null) {
            $ext = $profilePic->getClientOriginalExtension();
            if($ext == 'jpg' || $ext == 'png'){
                $name = "ProfilePic".".".$ext;
                $profilePic->move('images/users/'.$user->id , $name);
                $user->profile_pic = "images/users/".$user->id."/".$name;
            }
        }

        $user->save();

        return redirect('/users/'.$request->id);
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
