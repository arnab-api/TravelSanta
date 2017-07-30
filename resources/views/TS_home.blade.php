@extends('MasterBlade')
@section('content')
<div class="col-md-9 main">
  <div class="banner-section">
    <h3 class="tittle">Welcome...</h3>
    <div class="banner">
      <div  class="callbacks_container">
        <ul class="rslides" id="slider4">
          <li>
            <img src="images/1.jpg" class="img-responsive" alt="" />
          </li>
          <li>
            <img src="images/2.jpg" class="img-responsive" alt="" />
          </li>
          <li>
            <img src="images/3.jpg" class="img-responsive" alt="" />
            
          </li>
          <li>
            <img src="images/4.jpg" class="img-responsive" alt="" />
          </li>
        </ul>
      </div>
      <script src="js/responsiveslides.min.js"></script>
      <script>
      $(function () {
      $("#slider4").responsiveSlides({
      auto: true,
      pager:true,
      nav:true,
      speed: 300,
      namespace: "callbacks",
      before: function () {
      $('.events').append("<li>before event fired.</li>");
      },
      after: function () {
      $('.events').append("<li>after event fired.</li>");
      }
      });
      });
      </script>
      <div class="b-bottom">
        <h5 class="top"><a href="/single">Explore the world...</a></h5>
      </div>
    </div>
  </div>
  <div class="banner-right-text">
    <h3 class="tittle">Advertisement..</h3>
    <div class="general-Snews">
      <div class="general-inner">
      </div>
    </div>
  </div>
  <div class="clearfix"> </div>
  </div>
  @endsection