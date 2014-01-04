@extends('layouts.master')

@section('main_content')
	<h1>FootyTracker</h1>

	<p>
		Tracking attendance and payments for people partaking in casual football games.
	</p>

	<h2>Your Football:</h2>
	<ul>
		<li>
			<a href="{{ url('player') }}">Players</a>
		</li>
	</ul>
@stop