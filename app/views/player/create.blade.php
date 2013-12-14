@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Add Player</h2>

	{{ Form::open(array('url' => 'player/store', 'id' => 'create_player_form')) }}

		<p>
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name') }}
		</p>
		<p>
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name') }}
		</p>
		<p>
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::email('email') }}
		</p>
		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
		</p>
		<p>
			{{ Form::label('confirm_password', 'Confirm Password') }}
			{{ Form::password('confirm_password') }}
		</p>
		<p>
			{{ Form::label('mobile', 'Mobile') }}
			{{ Form::text('mobile') }}
		</p>

		<p>
			{{ Form::submit('Add Player') }}
		</p>
	{{ Form::close() }}
@stop