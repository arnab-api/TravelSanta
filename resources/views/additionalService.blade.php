@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">
    <div class="banner-section">

        <div class="search_result">

            @for($i=0; $i<sizeof($description); $i++)

            <div class="addServiceNo">
                {{$i+1}}.
            </div>         

            <div class="addServiceDescr">
                {{$description[$i]}}
            </div>

            <div class="addServicePrice">
                {{$priceInfo[$i]}}
            </div>

            <div>

                @foreach($imgArr[$i] as $path)

                <img  class="addServiceImg" src="{{asset('').$path}}">

                @endforeach
            </div>


                {!! Form::open(
            array(
            'method'=>'POST',
            'action'=>'AdditionalServiceController@destroy',
            'class' => 'form',
            'novalidate' => 'novalidate',
            )) !!}
                <input type="text"  name = "service_id" value={{$idArr[$i]}} style="display : none">
            <input type="submit" class="deleteServ" value="Delete">
                {!! Form::close() !!}
            @endfor

        </div>

    </div>


    <div class="banner-right-text">

        <div class="addServRight">
            {!! Form::open(
            array(
            'method'=>'POST',
            'action'=>'AdditionalServiceController@store',
            'class' => 'form',
            'novalidate' => 'novalidate',
            'files' => true)) !!}

            <h5 class="placeFont">Service Details :</h5>
            <textarea name="description" class="placeDescription"></textarea>

            <h5 class="placeFont">Price Info :</h5>
            <textarea name="priceInfo" class="priceInfo"></textarea>

            <h5 class="placeFont">Images :</h5>
            <div class="ChooseImage">
                {!! Form::file('img[]', array('multiple'=>true)) !!}
            </div>

            <div class="gap"></div>
            <input type="submit" value="Add" class="AddServ">
            {!! Form::close() !!}


            <div class="general-news">
              <div class="general-inner"></div>
          </div>
      </div>
  </div>


  <a href="/" class="DoneButton">Done</a>
  <div class="gap"></div>
  <div class="gap"></div>

  <div class="clearfix"> </div>
</div>


@endsection