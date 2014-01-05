@extends('layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Reset</strong> your password.</h3>
			</div>
			<div class="panel-body">

				@if (Session::has('message'))
					<p class="alert alert-{{ Session::get('message_type', 'danger')}} alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ Session::get('message') }}
					</p>
				@endif

				{{ Form::open(array('id' => 'reset_form')) }}

					<p>
						<span class="help-block">Enter your e-mail address and the new password you would like to use for your account below.</span>
					</p>

					<div class="form-group {{ $errors->first('email', 'has-error')}}">
						{{ Form::label('email', 'E-Mail Address') }}
						{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>
					<div class="form-group {{ $errors->first('password', 'has-error')}}">
						{{ Form::label('password', 'Password') }}
						{{ Form::password('password', array('class' => 'form-control')) }}
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
					</div>
					<div class="form-group {{ $errors->first('password_confirmation', 'has-error')}}">
						{{ Form::label('password_confirmation', 'Confirm Password') }}
						{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
						{{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
					</div>

					<p>
						{{ Form::hidden('token', $token) }}
						{{ Form::submit('Set New Password', array('class' => 'btn btn-default')) }}
					</p>
				{{ Form::close() }}
			</div>
		</div>
	</div>

</div>
@stop		