@extends('MasterBlade')
@section('content')
<div class="col-md-9 main">
	<div class="login">
		<div class="login-grids">
			<div class="col-md-6 log">
				<h3 class="tittle">Login <i class="glyphicon glyphicon-lock"></i></h3>
				
				<form  role="form" method="POST" action="{{ url('/login') }}">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						
						<h5>E-mail:</h5>
						
						<input id="email" type="text"  name="email" value="{{ old('email') }}">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<h5>Password:</h5>
						
						<input id="password" type="password"  name="password">
						@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
						
					</div>
					
					
					<label>
						<input type="checkbox" name="remember"> Remember Me
					</label>
					
					
					<div class="smallgap"></div>

					<button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
					<div class="smallgap"></div>
					<div class="smallgap"></div>
					<div class="smallgap"></div>
					<div class="smallgap"></div>
					<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>
					
					
				</form>
			</div>
			<div class="col-md-6 login-right">
				<h3 class="tittle">Sign Up <i class="glyphicon glyphicon-file"></i></h3>
				<p>By creating an account, you will be able to add contents ( tourist spots, hotels), rate other post and do other stuffs.</p>
				<a href="/tsregistration" class="hvr-bounce-to-bottom button">Create An Account</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
@endsection