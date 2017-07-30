@extends('MasterBlade')
@section('content')
<div class="col-md-9 main">
    <div class="gap"></div>
    <div>

        {!! Form::open(
        array(
        'method'=>'POST',
        'action'=>'PostsController@store',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

        <h5 class="placeFont">Place Title :</h5>
        <input type="text"  name = "placeTitle" class="placeName">
        <h5 class="placeFont">Description :</h5>
        <textarea name="placeDes" class="placeDescription"></textarea>

        <h5 class="placeFont">Images :</h5>
        <div class="ChooseImage">
            {!! Form::file('img[]', array('multiple'=>true)) !!}
        </div>

        <h5 class="placeFont">Area :</h5>
        <select id = "distList" name = "dist" class="tags">
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
        <textarea name="address" class="placeAddr"></textarea>
        <h5 class="placeFont">Tags (ctrl+click to select multiple) :</h5>
        <select multiple="yes" name="tags[]" class="tags">
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
        <div class="gap"></div>
        <input type="submit" value="Submit" class="postSubmit">
        {!! Form::close() !!}
    </div>
    <div class="gap"></div>
</div>
@endsection