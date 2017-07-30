@extends('MasterBlade')
@section('content')

<div class="col-md-9 main">

	{!! Form::open(
        array(
        'method'=>'POST',
        'action'=>'UserController@saveEdited',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

	<div class="container-fluid profile-header-section">
		<div class="container">

			<div class="profile-header">
				<div class="profile-pic-container">
					<img src="{{asset('').$profilePic}}" style="width: 240px">
				</div>

				<div class="profile-info-container">
					<h2><input type="text" name="userName" value="<?=$userName?>"></h2>
					<h5><span class="name-icon"></span><input type="text" name="first_name" value="<?=$firstName?>"></h5>
					<h5><span class="name-icon"></span><input type="text" name="last_name" value="<?=$lastName?>"></h5>

          			<h5><span class="admin-icon"></span>{{$status}}</h5>
					<h4><span class="email-icon"></span>{{$email}}</h4>

					<input type="text" name="id" value={{$id}} style="display: none">

				</div>
					<input type="file" id="file" class="file-input-box pic-item" name="pic">
			</div>

				<button type="submit" class="edit_profile">Done</button>

		</div>
	</div>



	{!! Form::close() !!}

	<div class="clearfix"> </div>
</div>

@endsection