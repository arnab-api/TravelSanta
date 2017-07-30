@extends('MasterBlade')
@section('content')
<div class="col-md-9 main">
    <div class="gap"></div>
    <div>

        {!! Form::open(
        array(
        'method'=>'POST',
        'action'=>'PostsController@saveEdited',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

        <h5 class="placeFont">Place Title :</h5>
        <input type="text"  name = "placeTitle" class="placeName" value = "<?=$title?>">
        <h5 class="placeFont">Description :</h5>
        <textarea name="placeDes" class="placeDescription">{{$review}}</textarea>

        <h5 class="placeFont">Images :</h5>
        <div class="ChooseImage">
            <h5>Add New Images :</h5> {!! Form::file('img[]', array('multiple'=>true)) !!}
        </div>
        <div class="delPrevImages"><input type="checkbox" name="deletePrevImages"> <font weight="800">Remove all previous images</font><br></div>
        <br>

        <h5 class="placeFont">Area :</h5>
        <select id = "distList" name = "dist" class="tags">
            <option>{{$district}}</option>
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

        <h5 class="placeFont">Detailed Address :</h5>
        <textarea name="address" class="placeAddr">{{$detailAdd}}</textarea>
        <h5 class="placeFont">Tags (ctrl+click to select multiple) :</h5>

        <div class="checkTags">
            @if($tag->hills == 1) <input type="checkbox" name="hills" checked> <font weight="800">hills</font>
            @else  <input type="checkbox" name="hills"> <font weight="800">hills</font>
            @endif
            
            @if($tag->sea == 1) <input type="checkbox" name="sea" checked> <font weight="800">sea</font>
                @else  <input type="checkbox" name="sea"> <font weight="800">sea</font>
                @endif
                
                @if($tag->heritage == 1) <input type="checkbox" name="heritage" checked> <font weight="800">heritage</font>
                @else  <input type="checkbox" name="heritage"> <font weight="800">heritage</font>
                @endif

                @if($tag->architecture == 1) <input type="checkbox" name="architecture" checked> <font weight="800">architecture</font>
                @else  <input type="checkbox" name="architecture"> <font weight="800">architecture</font>
                @endif
                
                @if($tag->river == 1) <input type="checkbox" name="river" checked> <font weight="800">river</font>
                @else  <input type="checkbox" name="river"> <font weight="800">river</font>
                @endif
                
                @if($tag->riverside == 1) <input type="checkbox" name="riverside" checked> <font weight="800">riverside</font>
                @else  <input type="checkbox" name="riverside"> <font weight="800">riverside</font>
                @endif
                
                @if($tag->lake == 1) <input type="checkbox" name="lake" checked> <font weight="800">lake</font>
                @else  <input type="checkbox" name="lake"> <font weight="800">lake</font>
                @endif

                @if($tag->forest == 1) <input type="checkbox" name="forest" checked> <font weight="800">forest</font>
                @else  <input type="checkbox" name="forest"> <font weight="800">forest</font>
                @endif
                
                @if($tag->green == 1) <input type="checkbox" name="green" checked> <font weight="800">green</font>
                @else  <input type="checkbox" name="green"> <font weight="800">green</font>
                @endif
        </div>

        <input type="text" name="post_id" style="display: none" value = {{$post_id}}>

        <div class="gap"></div>
        <input type="submit" value="Submit" class="postSubmit">
        {!! Form::close() !!}
    </div>
    <div class="gap"></div>
</div>
@endsection