@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Add Player</h2>

	{{ Form::open(array('url' => 'player/create', 'id' => 'create_player_form')) }}

		<p>
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name', Input::old('first_name')) }}
			{{ $errors->first('first_name', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name', Input::old('last_name')) }}
			{{ $errors->first('last_name', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::email('email', Input::old('email')) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('password_confirmation', 'Confirm Password') }}
			{{ Form::password('password_confirmation') }}
			{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('mobile', 'Mobile') }}
			{{ Form::text('mobile', Input::old('mobile')) }}
			{{ $errors->first('mobile', '<span class="error">:message</span>') }}
		</p>

		<p>
			{{ Form::submit('Add Player') }}
		</p>
	{{ Form::close() }}
@stop