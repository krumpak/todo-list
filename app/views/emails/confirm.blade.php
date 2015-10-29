<h1>Confirm account</h1>   

<h1>Hi {{ $name }}</h1>
<p>{{ $username }}</p>
<p>{{ $email }}</p>
<p><a href="{{ URL::to( 'confirm' ) }}/{{$code}}">confirm username</a></p>

<p>{{date('Y-m-d H:i:s')}}</p>