@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<h2>Delete Player - {{{ $player->first_name }}} {{{ $player->last_name }}}</h2>

	{{ Form::open(array('url' => 'player/delete/'.$player->id, 'id' => 'delete_player_form')) }}
		<p>
			Are you sure you want to delete {{{ $player->first_name }}} {{{ $player->last_name }}}?
		</p>

		<p>
			{{ Form::hidden('id', $player->id )}}
			{{ Form::submit('Delete Player') }}
			
		</p>
	{{ Form::close() }}
@stop