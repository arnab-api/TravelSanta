@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">


	<div class="search_result">

		@for($i=0; $i<sizeof($titleArr); $i++)

		<div class="SR_title">
			<a href="{{asset('displayHotel')}}/{{$hotelidArr[$i]}}">{{$titleArr[$i]}}</a>
		</div>

		<div class="SR_address">
			{{$addressArr[$i]}}
		</div>


		<div class="SR_description">
			{{$descriptionArr[$i]}}
		</div>


		<div class="SR_img_cont">

			@foreach($mainImgArr[$i] as $path)

			<img  class="SR_images" src="{{asset('').$path}}">

			@endforeach
		</div>

		@endfor

	</div>

	<div class="clearfix"> </div>
	<div class="gap"></div>
	<div class="gap"></div>
</div>

@endsection