@extends('layouts/template')

@section('title')
	Forgotten Password @ TO-DO List
@stop

@section('content')
	<h1>Forgotten Password</h1>
	{{ Form::open(array('action' => 'AuthController@post_forgotten_password')) }}
		<p>
			@include('layouts/errors')
		</p>
		<br>
		<div class="input-group">
			<span class="glyphicon glyphicon-envelope input-group-addon"></span>
			{{ Form::email('email', '', array('placeholder' => 'Type in your email', 'class' => 'form-control', 'autocomplete' => 'off')) }}
		</div>
		<p>{{ Form::submit('Send me an email', array('class' => 'btn btn-info') ) }}
		{{ HTML::link('/', 'Cancel', array('class' => 'btn btn-default')) }}
		</p>
	{{ Form::close() }}
@stop