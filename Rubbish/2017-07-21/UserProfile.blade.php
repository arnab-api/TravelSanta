@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">



  <div class="container-fluid profile-header-section">
    <div class="container">

      <div class="profile-header">
        <div class="profile-pic-container">
          <img src="{{ url('/images/male.png') }}">
        </div>

        <div class="profile-info-container">
          <h2>{{$userName}}</h2>
          <h5><span class="name-icon"></span>{{$fullName}}</h5>
          <h5><span class="admin-icon"></span>{{$isAdmin}}</h5>
          <h4><span class="email-icon"></span>{{$email}}</h4>

        </div>
      </div>

      <form method="get" action="/editProfile">
        <button type="submit" class="edit_profile">Edit Profile</button>
      </form>

      <div class="profile-menu-bar">
        <h2>Posts</h2>
      </div>

      <div class="container course-container">
        <div class="row taken-courses">
          {{--<div class="col-md-offset-1 col-md-3 course-box text-center"><a href="">Object Oriented Programming</a></div>--}}
          @for($i=0; $i<count($postIdArr); $i++)
          <div class="col-md-offset-1 col-md-3 course-box text-center">
            <a class="text-center" href="{{url('/display/'.$postIdArr[$i])}}">{{$postTitles[$i]}}</a>
          </div>
          @endfor
        </div>
      </div>

    </div>
  </div>





  <div class="clearfix"> </div>
</div>

@endsection