<h1>Forgotten Password</h1>   

<h1> {{ $email }}</h1>
<p>Secret code: {{ $reset }}</p>
<p><a href="{{ URL::to('new_password' ) }}">reset password</a></p>
<!--<p><a href="{{ URL::to('new_password', $reset) }}">reset password</a></p>-->

<p>{{date('Y-m-d H:i:s')}}</p>