@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>


	@if (Session::has('message'))
		<p class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('message') }}
		</p>
	@endif

	<p>
		<a class="btn btn-primary" href="{{ url('player/create') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Player</a>
	</p>
	@if ($players->isEmpty())
		<p>No players have been added yet.</p>
	@else
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th class="hidden-xs hidden-sm">Email</th>
					<th>Mobile</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
				<tr>
					<td>{{{ $player->first_name }}} {{{ $player->last_name }}}</td>
					<td class="hidden-xs hidden-sm">{{{ $player->email }}}</td>
					<td>{{{ $player->mobile }}}</td>
					<td><a class="btn btn-info btn-sm" href="{{ url('player/edit/'.$player->id) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></td>
					<td><a class="btn btn-warning btn-sm" href="{{ url('player/delete/'.$player->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@stop