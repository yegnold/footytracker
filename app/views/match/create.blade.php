@extends('layouts.master')

@section('main_content')
	<h1>Meetups</h1>
	<h2>Add Meetup</h2>

	@if ($errors->any())
	<p class="alert alert-danger">
		There were some problems saving the meetup.
	</p>
	@endif

	{{ Form::open(array('url' => 'match/create', 'id' => 'create_match_form')) }}

		<div class="form-group {{ $errors->first('match_date', 'has-error')}}">
			{{ Form::label('match_date', 'Date') }}
			{{ Form::text('match_date', Input::old('match_date'), array('class' => 'form-control')) }}
			{{ $errors->first('match_date', '<span class="help-block">:message</span>') }}
		</div>
		
		<div class="form-group {{ $errors->first('notes', 'has-error')}}">
			{{ Form::label('notes', 'Notes') }}
			{{ Form::textarea('notes', Input::old('notes'), array('class' => 'form-control')) }}
			{{ $errors->first('notes', '<span class="help-block">:message</span>') }}
		</div>
		
		<p>
			{{ Form::submit('Add Match', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop