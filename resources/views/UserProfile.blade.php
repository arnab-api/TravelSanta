@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">



  <div class="container-fluid profile-header-section">
    <div class="container">

    <div class="profile-header">
        <div class="profile-pic-container">
          <img src="{{asset('').$profilePic}}" style="width: 240px">
        </div>

        <div class="profile-info-container">
          <h2>{{$userName}}</h2>
          <h5><span class="name-icon"></span>{{$fullName}}</h5>
          <h5><span class="type-icon"></span>{{$status}}</h5>
          <h4><span class="email-icon"></span>{{$email}}</h4>
        </div>
      </div>

      @if($showEdit == 1)
        <a href="/editProfile/{{$id}}" class="edit_profile">Edit Profile</a>
      @endif

      <div class="gap"></div>

      <div class="profile-menu-bar">
        <h2>Posts</h2>
      </div>

      <div class="container course-container">
        <div class="row taken-courses">
          {{--<div class="col-md-offset-1 col-md-3 course-box text-center"><a href="">Object Oriented Programming</a></div>--}}
          @for($i=0; $i<count($postIdArr); $i++)
            <div class="col-md-offset-1 col-md-3 course-box text-center">
                @if($status == "Tourist")
                    <a class="text-center" href="{{url('/display/'.$postIdArr[$i])}}">{{$postTitles[$i]}}</a>
                    @else
                    <a class="text-center" href="{{url('/displayHotel/'.$postIdArr[$i])}}">{{$postTitles[$i]}}</a>
                    @endif
            </div>
          @endfor
        </div>
      </div>

    </div>
  </div>





  <div class="clearfix"> </div>
</div>




@endsection