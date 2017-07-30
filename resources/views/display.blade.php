@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">
  <div class="banner-section">
   <h3 class="display_post_title">{{$title}}</h3>

   <form action="/findHotel" class="find_nearby_hotels_pos">
    <input type="hidden" name="postId" value={{$postId}}><br>
    <input type="submit" value="Find nearby Hotels" class="find_nearby_hotels"><br>
  </form>

      @if(count($imgArr) > 0)
        <img id="big_img" src="{{asset('').$imgArr[0]}}" class="big_img">
          @else <img id="big_img" src="" class="big_img">
      @endif
  <div id="scroll_pane" class="hor_scroll">

    @if(count($imgArr))
    @foreach($imgArr as $img)   
    <img id="small_img" src="{{asset('').$img}}" onclick="showImg('{{asset('').$img}}');">
    @endforeach
    @endif

  </div>



  <div class="disp_address">
    {{$addr}}
  </div>
  <div class="disp_description">
    {{$descr}}
  </div>

      @if($showEdit == 1)
      <div class="editPostDiv"> <a href="/editPost/{{$postId}}" class="editPostBtn">Edit Post</a></div>
  @endif
<div class="disp_author_cont">
  <a href="/users/{{$userId}}" class="disp_author">
    {{$author}}
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

<input type="text" value={{$postId}} name="post_id" style="display: none">

  <textarea name="con" class="comment_box"></textarea>
  <input type="submit" name="comment_submit" class="comment_submit" value="Comment"><br>
  {!! Form::close() !!}
</div>

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