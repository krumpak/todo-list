<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	{{ HTML::style('css/bootstrap.min.css'); }}
	{{ HTML::style('css/style.css'); }}
    {{ HTML::script('js/scripts.js'); }}
    {{ HTML::script('js/vanilla.js'); }}
	
</head>
<body>
    <div class="container">
    	<div class="row">
    		<nav class="col-sm-6 col-sm-offset-3 col-xs-12 nav">
                @include('layouts/nav')
    		</nav>
    	</div>
    	<div class="row">
    		<section class="col-sm-6 col-sm-offset-3 col-xs-12 section">
                @yield('content')
    		</section>
    	</div>
    	<div class="row">
    		<footer class="col-sm-6 col-sm-offset-3 col-xs-12 footer">
    			<p class="text-center v-center">2014 .::. Gorazd Krumpak</p>
    		</footer>
    	</div>
    </div>
</body>
</html>
       

