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

				{{ Form::open(array('url' => 'password/remind', 'id' => 'remind_form')) }}

					<div class="form-group {{ $errors->first('email', 'has-error')}}">
						{{ Form::label('email', 'E-Mail Address') }}
						{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>

					<div class="form-group">
						<span class="help-block">We will e-mail you a link to a form through which you can reset your password.</span>
					</div>

					<p>
						{{ Form::submit('Reset Password', array('class' => 'btn btn-default')) }}
					</p>
				{{ Form::close() }}
			</div>
		</div>
	</div>

</div>
@stop		