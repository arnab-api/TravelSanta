@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">
  <div class="banner-section">
   <h3 class="display_post_title">{{$title}}</h3>

      @if(count($mainImgArr))
   <img id="big_img" src="{{asset('').$mainImgArr[0]}}" class="big_img">
   @endif
   <div id="scroll_pane" class="hor_scroll">

    @if(count($mainImgArr))
    @foreach($mainImgArr as $img)   
    <img id="small_img" src="{{asset('').$img}}" onclick="showImg('{{asset('').$img}}');">
    @endforeach
    @endif

  </div>



  <div class="disp_address">
    {{$address}}
  </div>
  <div class="disp_description">
    {{$description}}
  </div>

  <div class="our_services">
    Our Services
  </div>


  @for($i=0; $i<sizeof($serviceDescArr); $i++)

  <div class="service_container">

   <div class="service_desc">
     {{$serviceDescArr[$i]}}
   </div>

   <div class="service_PI">
    Price Info : 
  </div>

  <div class="service_desc">
   {{$servicePriceArr[$i]}}
 </div>

 <div class="hor_scroll">
  @foreach($serviceImgArr[$i] as $img)   
  <a href="{{asset('').$img}}"><img src="{{asset('').$img}}"></a>
  @endforeach
</div>

</div>

@endfor

<div class="hotel_contact">
  Contact with Us  
</div>
<div class="hotel_contact_info">
  {{$contactInfo}}
</div>

    @if($showEdit == 1)
  <div class="editPostDiv"> <a href="/editMainService/{{$postId}}" class="editPostBtn">&nbsp Update</a></div>
      @endif
          <input type="text" value={{$postId}} style="display : none">

  <div class="disp_author_cont">
      <a href="/users/{{$manager->id}}" class="disp_author">
          {{$manager->name}}
      </a>
  </div>

</div>

<div class="banner-right-text">
 <h3 class="tittle">Comments...</h3>

 <div class="comment_section">

   @for($i=0; $i<count($commentAuthor); $i++)
   <div class="one_comment">
     <div class="commenter">{{$commentAuthor[$i]}} &nbsp </div>
     <div class="full_comment">{{$commentContent[$i]}}</div>
   </div>
   @endfor
 </div>

 <br><br>

 <div class="post_comment">
  <h3>Leave a comment</h3>
  <br>
  {!! Form::open(
  array(
  'method'=>'POST',
  'action'=>'CommentController@store',
  'class' => 'form',
  'novalidate' => 'novalidate',
  'files' => true)) !!}

<input type="text" value={{$postId}} name="hotel_id" style="display: none">

  <textarea name="con" class="comment_box"></textarea>
  <input type="submit" name="comment_submit" class="comment_submit" value="Comment"><br>
  {!! Form::close() !!}
</div>


<div class="clearfix"> </div>
</div>


<script>
  function showImg(name)
  {
    var big = document.getElementById('big_img');

    big.src=name;
  }
</script>

@endsection