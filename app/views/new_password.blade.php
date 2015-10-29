@extends('layouts/template')

@section('title')
	New Password @ TO-DO List
@stop

@section('content')
	<h1>New Password</h1>
	{{ Form::open(array('action' => 'AuthController@post_new_password')) }}
		<p>
			@include('layouts/errors')
		</p>
		<br>
		{{ Form::label('password', 'New password') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-exclamation-sign input-group-addon"></span>
			{{ Form::password('password', array('placeholder' => 'Type in new password', 'class' => 'form-control', 'autocomplete' => 'off')) }}
		</div>

		{{ Form::label('password_confirmation', 'Confirm password') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-exclamation-sign input-group-addon"></span>
			{{ Form::password('password_confirmation', array('placeholder' => 'Re-type new password', 'class' => 'form-control', 'autocomplete' => 'off')) }}
		</div>

		{{ Form::hidden('secret', $code ) }}

		<p>{{ Form::submit('Submit', array('class' => 'btn btn-info') ) }}
		{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop