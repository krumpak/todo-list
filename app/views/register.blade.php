@extends('layouts/template')


@section('title')
	Register @ TO-DO List
@stop

@section('content')
	<h1>Register</h1>
	{{ Form::open(array('action' => 'AuthController@post_register')) }}
		<p>
			@include('layouts/errors')
		</p>
		{{ Form::label('name', 'Name and surname') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-user input-group-addon"></span>
			{{ Form::text('name', Input::old('name'), array('placeholder' => 'Type in your name and surname', 'class' => 'form-control',)) }}
		</div>
		{{ Form::label('username', 'Username') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-user input-group-addon"></span>
			{{ Form::text('username', Input::old('username'), array('placeholder' => 'Type in your username', 'class' => 'form-control')) }}
		</div>
		{{ Form::label('email', 'Email') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-envelope input-group-addon"></span>
			{{ Form::email('email', Input::old('email'), array('placeholder' => 'Type in your email', 'class' => 'form-control',)) }}
		</div>
		<label for="password">Password <small>(at leat 8 charasters long)</small></label>
		<div class="input-group">
			<span class="glyphicon glyphicon-exclamation-sign input-group-addon"></span>
			{{ Form::password('password', array('placeholder' => 'Type in your password', 'class' => 'form-control', 'autocomplete' => 'off')) }}
		</div>
		{{ Form::label('password_confirmation', 'Confirm password') }}
		<div class="input-group">
			<span class="glyphicon glyphicon-exclamation-sign input-group-addon"></span>
			{{ Form::password('password_confirmation', array('placeholder' => 'Re-type your password', 'class' => 'form-control', 'autocomplete' => 'off')) }}
		</div>
		<br>
		<p>{{ Form::submit('Register', array('class' => 'btn btn-info') ) }}
		{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop