@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Edit Player - {{{ $player->first_name }}} {{{ $player->last_name }}}</h2>

	{{ Form::open(array('url' => 'player/edit/'.$player->id, 'id' => 'edit_player_form')) }}

		<p>
			{{ Form::label('first_name', 'First Name') }}
			{{ Form::text('first_name', $prefill_data['first_name']) }}
			{{ $errors->first('first_name', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('last_name', 'Last Name') }}
			{{ Form::text('last_name', $prefill_data['last_name']) }}
			{{ $errors->first('last_name', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('email', 'E-Mail Address') }}
			{{ Form::email('email', $prefill_data['email']) }}
			{{ $errors->first('email', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('password', 'Password (leave blank to keep current)') }}
			{{ Form::password('password', array('autocomplete' => 'off')) }}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('password_confirmation', 'Confirm Password') }}
			{{ Form::password('password_confirmation', array('autocomplete' => 'off')) }}
			{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
		</p>
		<p>
			{{ Form::label('mobile', 'Mobile') }}
			{{ Form::text('mobile', $prefill_data['mobile']) }}
			{{ $errors->first('mobile', '<span class="error">:message</span>') }}
		</p>

		<p>
			{{ Form::submit('Update Player') }}
		</p>
	{{ Form::close() }}
@stop