@extends('layouts/template')

@if( Auth::check() )
	@section('title')
		Tasks @ TO-DO List
	@stop

	@section('content')
		<h1>Tasks</h1>
		<div id="task-container">
			<ul class="task-list" id="tasks">
			@foreach ($tasks as $item)
				<li id="task{{ $item->id }}">
				@if ( $item->status == 1 ) 
					<a class="check-task" href="#" onclick="uncheck_task({{ $item->id }});" title="Uncheck task"><span class="glyphicon glyphicon-check"></span> {{ $item->task_name }} </a> <a class="remove-task" href="#" onclick="remove_task({{ $item->id }});" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>
				@else
					<a class="check-task" href="#" onclick="check_task({{ $item->id }});" title="Check task"><span class="glyphicon glyphicon-unchecked"></span> {{ $item->task_name }} </a> <a class="remove-task" href="#" onclick="remove_task({{ $item->id }});" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>
				@endif 
				</li>
			@endforeach
			</ul>
		</div>
		<br>
		<div id="message"></div>
		<div class="input-group">
	    	<input id="add-new-task-input" type="text" class="form-control" placeholder="Task name is required ...">
	    	<span class="input-group-btn"><button class="btn btn-default" type="button" onclick="add_new_task();">Add new task</button></span>
	    </div>
    	{{ HTML::script('js/submit_enter.js'); }}
	@stop
@else
	@section('title')
		Wellcome @ TO-DO List
	@stop

	@section('content')
		<h1>Login</h1>
		{{ Form::open(array('url' => 'login')) }}
			<div>
				@include('layouts/errors')
				@include('layouts/success')
			</div>
			{{ Form::label('username', 'Username') }}
			<div class="input-group">
				<span class="glyphicon glyphicon-user input-group-addon"></span>
				{{ Form::text('username', Input::old('username'), array('placeholder' => 'Type in your username', 'class' => 'form-control', 'value' => 'demo')) }}
			</div>
			<br>
			{{ Form::label('password', 'Password') }}
			<div class="input-group">
				<span class="glyphicon glyphicon-exclamation-sign input-group-addon"></span>
				{{ Form::password('password', array('placeholder' => 'Type in your password', 'class' => 'form-control')) }}
			</div>
			<div class="checkbox">
				<label>
				{{ Form::checkbox('rememberme', 'true', array('class' => 'form-control')) }}
				Remeber me
				</label>
			</div>
			<br>
			<p>{{ Form::submit('Login', array('class' => 'btn btn-info') ) }}
			{{ HTML::link('/register', 'Register', array('class' => 'btn btn-default')) }}
			{{ HTML::link('/forgotten_password', 'Forgotten password', array('class' => 'btn btn-default')) }}
			</p>
		{{ Form::close() }}
	@stop
@endif 