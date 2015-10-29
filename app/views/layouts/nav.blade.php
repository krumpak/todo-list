<div class="col-sm-6 col-xs-6 text-left v-center">  
    @if( Auth::check() )
    	<a class="logo" href="/tasks">Hello <strong>{{ Auth::user()->name }}</strong></a>
    @else
		<a class="logo" href="/">Wellcome @ "TO-DO List"</a>
    @endif 
    
</div>
<div class="col-sm-6 col-xs-6 text-right v-center">
    @if( Auth::check() )
    	{{ HTML::link('/logout', 'Logout', array('class' => 'btn btn-default') )}}
    @endif
</div>