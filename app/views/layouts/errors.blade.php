@if( isset($errors) && count($errors->all()) > 0 )
<div class="alert alert-danger alert-dismissible" role="alert" id="hide">
	<button type="button" class="close" data-dismiss="alert" onclick="close_alert()">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
	<ul>
	@foreach ($errors->all('<li>:message</li>') as $message)
		{{ $message }}
	@endforeach
	</ul>
	<script type="text/javascript">auto_close();</script>
</div>
@endif