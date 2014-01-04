@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Add Player</h2>

	@if ($errors->any())
	<p class="alert alert-danger">
		There were some problems saving the player.
	</p>
	@endif

	{{ Form::open(array('url' => 'player/create', 'id' => 'create_player_form')) }}

		<div class="form-group {{ $errors->first('first_name', 'has-error')}}">
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
			{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('last_name', 'has-error')}}">
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
			{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('email', 'has-error')}}">
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
			<span class="help-block">Players will log in to the system with their e-mail address and password.</span>
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('password', 'has-error')}}">
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', array('class' => 'form-control')) }}
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('password_confirmation', 'has-error')}}">
			{{ Form::label('password_confirmation', 'Confirm Password') }}
			{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
			{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('mobile', 'has-error')}}">
			{{ Form::label('mobile', 'Mobile') }}
			{{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
			{{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
		</div>

		<p>
			{{ Form::submit('Add Player', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop