@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Edit Player - {{{ $player->first_name }}} {{{ $player->last_name }}}</h2>

	@if ($errors->any())
	<p class="alert alert-danger">
		There were some problems saving the player.
	</p>
	@endif

	{{ Form::open(array('url' => 'player/edit/'.$player->id, 'id' => 'edit_player_form')) }}

		<div class="form-group {{ $errors->first('first_name', 'has-error')}}">
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name', $prefill_data['first_name'], array('class' => 'form-control')) }}
			{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('last_name', 'has-error')}}">
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name', $prefill_data['last_name'], array('class' => 'form-control')) }}
			{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('email', 'has-error')}}">
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::email('email', $prefill_data['email'], array('class' => 'form-control')) }}
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('password', 'has-error')}}">
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', array('autocomplete' => 'off', 'class' => 'form-control')) }}
			<span class="help-block">Leave blank to retain current password</span>
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('password_confirmaton', 'has-error')}}">
			{{ Form::label('password_confirmation', 'Confirm Password') }}
			{{ Form::password('password_confirmation', array('autocomplete' => 'off', 'class' => 'form-control')) }}
			{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->first('mobile', 'has-error')}}">
			{{ Form::label('mobile', 'Mobile') }}
			{{ Form::text('mobile', $prefill_data['mobile'], array('class' => 'form-control')) }}
			{{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
		</div>

		<p>
			{{ Form::submit('Update Player', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop