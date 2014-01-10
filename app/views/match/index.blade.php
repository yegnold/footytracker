@extends('layouts.master')

@section('main_content')
	<h1>Meetups</h1>

	<p class="lead">
		Use this section to manage meetup dates. Creating future meetups will allow your participants to indicate whether or not they are able to attend.
	</p>

	@if (Session::has('message'))
		<p class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('message') }}
		</p>
	@endif

	<p>
		<a class="btn btn-primary" href="{{ url('match/create') }}"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Meetup</a>
	</p>

	<h2>Future Meetups</h2>
	@if ($upcoming_matches->isEmpty())
		<p>No future meetups have been planned yet.</p>
	@else
		@include('match._table', array('matches' => $upcoming_matches))
	@endif

	<h2>Old Meetups</h2>
	@if ($previous_matches->isEmpty())
		<p>No past meetups exist.</p>
	@else
		@include('match._table', array('matches' => $previous_matches))
	@endif

@stop