@extends('layouts.master')

@section('main_content')
	<h1>Players</h1>
	<a href="{{ route('player.create') }}">Add Player</a>

	@if ($players->isEmpty())
		<p>No players have been added yet.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
				<tr>
					<th>{{{ $player->first_name }}}{{{ $player->last_name }}}</th>
					<th>Bee Eff</th>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@stop