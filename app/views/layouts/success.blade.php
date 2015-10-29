@if( Session::has('success') )
<div class="alert alert-success alert-dismissible" role="alert" id="hide">
	<button type="button" class="close" data-dismiss="alert" onclick="close_alert()">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
	<ul>
		<li>{{ Session::get('success'); }}</li>
	</ul>
	<script type="text/javascript">auto_close();</script>
</div>
@endif