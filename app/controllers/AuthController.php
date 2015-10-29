<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function post_login()
	{
		$input = Input::all();
		if(isset($input['rememberme'])){
			$rememberme=true;
		} else {
			$rememberme=false;
		}
		
		$confirmed = User::where('username', $input['username'])->pluck('confirmed');

		$rules = array('username' => 'required', 'password' => 'required');
		$UserValidation = Validator::make($input,$rules);
		if($UserValidation->fails()){
			return Redirect::to('/')->withErrors($UserValidation);
		} else {
			$credentials = array('username' => $input['username'], 'password' => $input['password']);
			if($confirmed){
				if(Auth::attempt($credentials, $rememberme)){
					return Redirect::to('/tasks');
				} else {
					return Redirect::to('/')->withErrors(array('Wrong username or password.'));
				}
			} else {				
				return Redirect::to('/')->withErrors('Complete your activation. Please check email for activation code.');
			}
		}
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function post_forgotten_password()
	{
		$input = Input::all();
		
		$reset=$this->code();

		$send=array(
			'email' => 'info@example.com', 
			'name' => 'Site Admin', 
			'emailto' => $input['email'], 
			'subject' => 'Forgotten Password!'
		);
		
		$data=array(
			'email' => $input['email'],
			'reset' => $reset
		);

		$rules = array('email' => 'required');
		$UserValidation = Validator::make($input, $rules);
		if($UserValidation->fails()){
			return Redirect::to('/forgotten_password')->withErrors($UserValidation);
		} else {

			$UserValidationEmail = Validator::make($input, array('email' => 'unique:users,email'));
			if ($UserValidationEmail->fails()) {
				$user = User::where('email', $send['emailto'])->first();

				$user->reset_password = $reset;
				$user->updated_at = new DateTime;

				if($user->save()){
					Mail::send('emails.forgotten_password', $data, function($message) use ($send)
					{
					    $message->from($send['email'], $send['name']);
					    $message->subject($send['subject']);
					    $message->to($send['emailto']);
					});

					Session::flash('success', 'Email was successfully sent!');
					return Redirect::to('/');
				} else {
					return Redirect::to('/forgotten_password')->withErrors("Try again!");
				}
			} else {
				return Redirect::to('/forgotten_password')->withErrors("This email is not registered!");
			}
		}
	}

	public function post_new_password()
	{
		$input = Input::all();

		$password=Hash::make($input['password']);
		$secret=$input['secret'];
		
		$reset=$this->code();

		$rules = array('password' => 'required|min:8|max:100|confirmed', 'password_confirmation' => 'required|same:password', 'secret' => 'required');
		$UserValidation = Validator::make($input, $rules);

		$id = User::where('reset_password', $secret)->pluck('id');
		if(isset($id)){
			if($UserValidation->fails()){
				return Redirect::to('/new_password/'.$secret)->withErrors($UserValidation);
			} else {
				$user = User::where('reset_password', $input['secret'])
					->where('id', $id)
					->first();

				$user->password = $password;
				$user->reset_password = $reset;
				$user->updated_at = new DateTime;

				if($user->save()){
					Session::flash('success', 'Password was successfully changed!');
					return Redirect::to('/');
				} else {
					return Redirect::to('/new_password/'.$secret)->withErrors("Try again!");
				}
			}
		} else {
			return Redirect::to('/forgotten_password')->withErrors('Send new request.');
		}
	}

	public function post_register()
	{
		$input = Input::all();

		$password=Hash::make($input['password']);
		
		$code=$this->code();

		$send=array(
			'email' => 'info@example.com', 
			'name' => 'Site Admin', 
			'emailto' => $input['email'], 
			'subject' => 'Forgotten Password!'
		);
		
		$data=array(
			'name' => $input['name'],
			'username' => $input['username'],
			'email' => $input['email'],
			'code' => $input['username'].'/'.$code
		);

		$rules = array(
			'name' => 'required|max:30', 
			'username' => 'required|max:30|unique:users', 
			'email' => 'required|email|unique:users', 
			'password' => 'required|min:8|max:100|confirmed', 
			'password_confirmation' => 'required|same:password');
		$UserValidation = Validator::make($input, $rules);
		if($UserValidation->fails()){
			return Redirect::to('/register')->withErrors($UserValidation);
		} else {
			
			$user = new User;

		    $user->name = $input['name'];
		    $user->username = $input['username'];
		    $user->email = $input['email'];
		    $user->password = $password;
		    $user->remember_token = $code;
		    $user->created_at = new DateTime;

    		if($user->save()){
    			Mail::send('emails.confirm', $data, function($message) use ($send)
				{
				    $message->from($send['email'], $send['name']);
				    $message->subject($send['subject']);
				    $message->to($send['emailto']);
				});
				Session::flash('success', 'You are successfully registered! Check your mail!');
		        return Redirect::to('/');
    		} else {
				return Redirect::to('/register')->withErrors("Try again!");
    		}
		}
	}

	public function get_confirm($username, $code)
	{
		$user = User::where('username', $username)
			->where('remember_token', $code)
			->first();

		$user->confirmed = true;
		$user->remember_token = null;
		$user->updated_at = new DateTime;

		if($user->save()){
			Session::flash('success', 'Activation successful!');
			return Redirect::to('/'); 
		} else {
			return Redirect::to('/forgotten_password')->withErrors("Try again!");
    		}
	}

	public function code($len = 250){
		$code=substr(str_shuffle(md5(date('Y-m-d H:i:s')).md5(date('Y-m-d H:i:s'))), 0, $len);

		return $code;
	}

}
