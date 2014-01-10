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
		<table class="table">
			<thead>
				<tr>
					<th>Date</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($upcoming_matches as $match)
				<tr>
					<td>{{{ $match->match_date }}}</td>
					<td><a class="btn btn-info btn-sm" href="{{ url('match/edit/'.$match->id) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></td>
					<td><a class="btn btn-warning btn-sm" href="{{ url('match/delete/'.$match->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	<h2>Old Meetups</h2>
	@if ($previous_matches->isEmpty())
		<p>No past meetups exist.</p>
	@else
		<table class="table">
			<thead>
				<tr>
					<th>Date</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($previous_matches as $match)
				<tr>
					<td>{{{ \Carbon\Carbon::parse($match->match_date)->formatLocalized('%A %d %B %Y') }}}</td>
					<td><a class="btn btn-info btn-sm" href="{{ url('match/edit/'.$match->id) }}"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</a></td>
					<td><a class="btn btn-warning btn-sm" href="{{ url('match/delete/'.$match->id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@stop