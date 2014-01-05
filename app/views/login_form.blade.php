@extends('layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Log in</strong> to manage your football meetup.</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(array('url' => 'login', 'id' => 'login_form')) }}

					<div class="form-group {{ $errors->first('email', 'has-error')}}">
						{{ Form::label('email', 'E-Mail Address') }}
						{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>
					<div class="form-group {{ $errors->first('password', 'has-error')}}">
						{{ Form::label('password', 'Password') }}
						{{ Form::password('password', array('class' => 'form-control')) }}
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
						<p>
							<a class="pull-right" href="#">Forgotten your password?</a>
						</p>
					</div>

					<p>
						{{ Form::submit('Log In', array('class' => 'btn btn-default')) }}
					</p>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="jumbotron">
			<h1>FootyTracker</h1>
			<p class="lead">
				Helping with the management of a casual football meetup.
			</p>
			<p>
				Store contact details for players.  Allow players to specify whether they're attending the next meet. Track attendance, payments and results for each meet. Push SMS notifications to
				players with meetup news. 
			</p>
			<p>
				<strong>FootyTracker takes the headache out of managing a football group.</strong>
			</p>
			<p>
				<a class="btn btn-block btn-success btn-lg" role="button" href="{{ url('/about') }}">
				Find out More
				</a>
			</p>
		</div>
	</div>
</div>
@stop		