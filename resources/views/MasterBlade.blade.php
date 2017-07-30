<!DOCTYPE HTML>
<html>
<head>
  <title>Travel Santa</title>


  <link rel="stylesheet" href="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')}}" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="{{URL::asset('https://fonts.googleapis.com/css?family=Lato:100,300,400,700')}}">
  <link rel="stylesheet" href="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css')}}" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}">
  <link href="{{URL::asset('css/select2.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/select2-bootstrap.min.css')}}" rel="stylesheet">
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <link href="{{URL::asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
  <link href="{{URL::asset('//fonts.googleapis.com/css?family=Open+Sans:700,700italic,800,300,300italic,400italic,400,600,600italic')}}" rel='stylesheet' type='text/css'>
  <link href="{{URL::asset('css/style.css')}}" rel='stylesheet' type='text/css' />
  

  <script src="{{URL::asset('js/jquery.min.js')}}"> </script>
  <script type="text/javascript" src="{{URL::asset('js/move-top.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/easing.js')}}"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
      });
    });
  </script>
  <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js')}}" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
  <script src="{{URL::asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js')}}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}


</head>
<body>


  <div class="top_nav_color">

    <div class="login_post">
     @if (Auth::guest())
     <a href="{{ url('/tslogin') }}" data-hover="Login">Login</a>
     <a href="{{ url('/tsregistration') }}" data-hover="Register">Register</a>
     @else
     <div class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }} <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
      <li><a href="/showProfile">Profile</a></li>
        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
      </ul>
    </div>
    @endif
    <a href="/post" data-hover="Post">Post</a>
  </div>

  <div class="top_search_box">

    {!! Form::open(
    array(
    'action'=>'SearchController@store',
    'class' => 'top_search-box',
    ))!!}
    <input type="submit" class="search_icon" value="">

    <div class="sTags">
      <select class="select2-selection--multiple" multiple="multiple" name="searchTags[]">
        <option value="architecture">Architecture</option>
        <option value="forest">Forest</option>
        <option value="green">Green</option>
        <option value="heritage">Heritage</option>
        <option value="hills">Hills</option>
        <option value="lake">Lake</option>
        <option value="river">River</option>
        <option value="riverside">Riverside</option>
        <option value="sea">Sea</option>
      </select>
    </div>

    <select name="searchArea"  class="sArea">
      <option class="blur">Select Area</option>
      <option>Bagerhat</option>
      <option>Bandarban</option>
      <option>Barguna</option>
      <option>Barisal</option>
      <option>Bhola</option>
      <option>Bogra</option>
      <option>Brahmanbaria</option>
      <option>Chandpur</option>
      <option>Chapainababganj</option>
      <option>Chittagong</option>
      <option>Chuadanga</option>
      <option>Comilla</option>
      <option>Cox's Bazar</option>
      <option>Dhaka</option>
      <option>Dinajpur</option>
      <option>Faridpur</option>
      <option>Feni</option>
      <option>Gaibandha</option>
      <option>Gazipur</option>
      <option>Gopalganj</option>
      <option>Habiganj</option>
      <option>Jamalpur</option>
      <option>Jessore</option>
      <option>Jhalakathi</option>
      <option>Jhenaidah</option>
      <option>Joypurhat</option>
      <option>Khagrachhari</option>
      <option>Khulna</option>
      <option>Kishoreganj</option>
      <option>Kurigram</option>
      <option>Kushtia</option>
      <option>Lakshmipur</option>
      <option>Lalmonirhat</option>
      <option>Madaripur</option>
      <option>Magura</option>
      <option>Manikganj</option>
      <option>Meherpur</option>
      <option>Moulvibazar</option>
      <option>Munshiganj</option>
      <option>Mymensingh</option>
      <option>Naogaon</option>
      <option>Narail</option>
      <option>Narayanganj</option>
      <option>Narsingdi</option>
      <option>Natore</option>
      <option>Netrokona</option>
      <option>Nilphamari</option>
      <option>Noakhali</option>
      <option>Pabna</option>
      <option>Panchagarh</option>
      <option>Patuakhali</option>
      <option>Pirojpur</option>
      <option>Rajbari</option>
      <option>Rajshahi</option>
      <option>Rangamati</option>
      <option>Rangpur</option>
      <option>Satkhira</option>
      <option>Shariatpur</option>
      <option>Sherpur</option>
      <option>Sirajganj</option>
      <option>Sunamganj</option>
      <option>Sylhet</option>
      <option>Tangail</option>
      <option>Thakurgaon</option>
    </select>

    {!! Form::close() !!}

  </div>

</div>


<div class="left_nav_color">
  <div class="left_nav">
    <div class="TS_logo">
      <a href="/tshome" data-hover="Travel Santa"><h1>Travel Santa</h1></a>
    </div>
    <div class="gap"></div>


    <div class="left_nav_opts"><a class="active" href="/tshome" data-hover="HOME">Home</a></div>
    <div class="left_nav_opts"><a id="about" data-hover="About">About</a></div>
    <div class="left_nav_opts"><a id="cont" data-hover="CONTACT">Contact</a></div>
  </div>
</div>

</div>


<div>@yield('content')</div>


<div id="contactModal" class="popup_modal">
      <div class="popup_modal-content">
        <span class="popup_close">&times;</span>

        <br>
        <div class="contact_title">Name</div>
        <input type="text" name="contact_name" class="contact_box"><br>

         <div class="contact_title">E-mail</div>
        <input type="E-mail" name="contact_mail" class="contact_box"><br>

         <div class="contact_title">Message</div>
        <textarea name="contact_message" class="contact_message_field"></textarea>

        <button id="contact_submit" class="contact_submit">Send</button>

      </div>
</div>


<div id="aboutModal" class="popup2_modal">
     
        <span class="popup2_close">&times;</span>

        <br>
        <div>
          <p  class="about_content">We are providing you the opportunity to share your travelling experiences through this website. Simply, you can post about any beautiful place you've visited and obviously you can share your captured photos. So, what are you waiting for ?? Just register and share your memories with the world ... !!</p>

          <p  class="about_content">And...Bussinessmen, if you have something to provide the tourists with (if you have hotels/restaurents or something like this), we're going to help you. Through this website you can share what kind of service you can provide. So, you've got an extra platform to promote your business and help people. Just register and promote yourself...!!</p>
        </div>
</div>
 

<footer class="footer_div">
  <p class="footer_CR">&copy; Osprishyo. All Rights Reserved</p>
  <a class="footer_MU"><i class="glyphicon glyphicon-earphone"></i>Call : 01XXXXXXXXX&nbsp &nbsp &nbsp &nbsp<i class="glyphicon glyphicon-envelope"></i> Mail : abc@gmail.com</a>
</footer>


<script type="text/javascript" src="{{asset('/bootstrap-select-1.12.2/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript">
  $(".select2-selection--multiple").select2();
</script>
<script>
  $(document).ready(function () {
    $('.selectpicker').selectpicker();
  });
</script>



<script>
  var modal = document.getElementById('contactModal');
  var span = document.getElementsByClassName("popup_close")[0];
  var sub =  document.getElementById("contact_submit");
  var cont = document.getElementById("cont");

  cont.onclick = function() {
    modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }


  sub.onclick = function(){
    modal.style.display = "none";
  }


  var modal2 = document.getElementById('aboutModal');
  var span2 = document.getElementsByClassName("popup2_close")[0];
  var abt = document.getElementById("about");

  abt.onclick = function() {
    modal2.style.display = "block";
  }

  span2.onclick = function() {
    modal2.style.display = "none";
  }
</script>


</body>
</html>