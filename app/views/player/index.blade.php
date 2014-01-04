@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<a href="{{ url('player/create') }}">Add Player</a>

	@if (Session::has('message'))
		<p>
		{{ Session::get('message') }}
		</p>
	@endif

	@if ($players->isEmpty())
		<p>No players have been added yet.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
				<tr>
					<td>{{{ $player->first_name }}} {{{ $player->last_name }}}</td>
					<td><a href="{{ url('player/edit/'.$player->id) }}">Edit</a></td>
					<td><a href="{{ url('player/delete/'.$player->id) }}">Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@stop