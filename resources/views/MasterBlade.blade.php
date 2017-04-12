<!DOCTYPE HTML>
<html>
<head>
  <title>Travel Santa</title>


  <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}">
  <!-- <link href="yourPath/bootstrap.min.css" rel="stylesheet"> -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
  <style>
    body {
      font-family: 'Lato';
    }
    .fa-btn {
      margin-right: 6px;
    }
  </style>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href='//fonts.googleapis.com/css?family=Open+Sans:700,700italic,800,300,300italic,400italic,400,600,600italic' rel='stylesheet' type='text/css'>
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <script src="js/jquery.min.js"> </script>
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
      });
    });
  </script>
</head>

<body>

<div class="h-top" id="home">
  <div class="top-header">
    <ul class="cl-effect-16 top-nag">
      @if (Auth::guest())
        <li><a href="{{ url('/tslogin') }}" data-hover="Login">Login</a></li>
        <li><a href="{{ url('/tsregistration') }}" data-hover="Register">Register</a></li>
      @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
        </li>
      @endif
      <li><a href="/post" data-hover="Post">Post</a></li>
    </ul>
    <div class="search-box">
      <div class="b-search">
        <form action="search">

          <select name="searchArea" class="selectpicker">
            <option class="blur">select area</option>
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



          <select name="searchTags[]" class="selectpicker" multiple="">
            <option>hills</option>
            <option>sea</option>
            <option>heritage</option>
            <option>architecture</option>
            <option>river</option>
            <option>riverside</option>
            <option>lake</option>
            <option>forest</option>
            <option>green</option>
          </select>
          <input type="submit" value="">
        </form>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="full">
  <div class="col-md-3 top-nav">
    <div class="logo">
      <a href="/tshome" data-hover="Travel Santa"><h1>Travel Santa</h1></a>
    </div>

    <div class="top-menu">
      <span class="menu"> </span>
      <ul class="cl-effect-10">
        <li><a class="active" href="/tshome" data-hover="HOME">Home</a></li>
        <li><a href="" data-hover="About">About</a></li>
        <li><a href="" data-hover="CONTACT">Contact</a></li>
      </ul>
    </div>
  </div>
</div>

<div>@yield('content')</div>

<footer>
  <div class="col-md-9 main">
    <div class="footer">
      <div class="footer-top">
        <div class="col-md-4 footer-grid">
          <h4>Message Us Now</h4>
          <ul class="bottom">
            <li><i class="glyphicon glyphicon-home"></i>Available 24/7 </li>
            <li><i class="glyphicon glyphicon-envelope"></i><a href="mailto:info@example.com">mridul133@gmail.com</a></li>
          </ul>
        </div>
        <div class="col-md-4 footer-grid">
          <h4>Address </h4>
          <ul class="bottom">
            <li><i class="glyphicon glyphicon-map-marker"></i>SUST, Sylhet</li>
            <li><i class="glyphicon glyphicon-earphone"></i>phone: 01XXXXXXXXX </li>
          </ul>
        </div>
        <div class="clearfix"> </div>
      </div>
    </div>
    <div class="copy">
      <p>&copy; Osprishyo. All Rights Reserved</p>
    </div>
  </div>
</footer>

<script type="text/javascript" src="/bootstrap-select-1.12.2/dist/js/bootstrap-select.js"></script><!--
<script type="text/javascript" src="yourPath/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="yourPath/bootstrap.min.js"></script> -->

<script>
  $(document).ready(function () {
    $('.selectpicker').selectpicker();
  });
</script>

</body>

</html>