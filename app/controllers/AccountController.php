<?php

class AccountController extends BaseController {

	public function postCreate()
	{

		$data = Input::all();

		$rules = array(

			'email'     => 'required|max:50|email|unique:users',
			'username'  => 'required|max:30|min:3|unique:users',
			'password'  => 'required|min:6'

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{
			return Redirect::route('account.create')
			->withErrors($validator)
			->withInput($data);
		}
		else 
		{
			$username  = Input::get('username');
			$email     = Input::get('email');
			$password  = Input::get('password');

			$activationCode = str_random(32);

			$user = User::create(array(

				'email'      => $email,
				'username'   => $username,
				'password'   => Hash::make($password),
				'hash'       => $activationCode,
				'active'     => 0

			));

			if ($user->save()) 
			{
				Mail::send('emails.auth.activate', array('username' => $username, 'link' => URL::route('account.activate', $activationCode)), function($message) use ($user) {

					$message->to($user->email, $user->username)->subject('Activate your account');
				
				});

				return Redirect::route('home')->with('global', 'Your account has been created! We have sent you an email to activate your account');
			}
		}

	}

	public function postLogin()
	{

		$data = Input::all();

		$rules = array(

			'email'    => 'required|max:50|email',
			'password' => 'required|min:6'

		);

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) 
		{

			return Redirect::route('account.login')
			->withErrors($validator)
			->withInput($data);

		}
		else 
		{

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(

				'email'    => Input::get('email'),
				'password' => Input::get('password'),
				'active'   => 1

			), $remember);

			if ($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('account.login')
					->with('global', 'Email/password wrong or account not activated')
					->withInput();
			}
		}

		return Redirect::route('account.login')->with('global', 'There was a problem signing you in');

	}

	public function getCreate()
	{
		return View::make('themes.default.account.create');
	}

	public function getLogin()
	{
		return View::make('themes.default.account.login');
	}

	public function getLogOut()
	{
		Auth::logout();

		return Redirect::route('home');
	}

	public function getActivate($code)
	{
		
		$user = User::where('hash', '=', $code)->where('active', '=', 0);

		if ($user->count())
		{
			$user = $user->first();

			$user->active = 1;
			$user->hash   = '';

			if ($user->save())
			{
				return Redirect::route('home')->with('global', 'Activated! You can now sign in');
			}
		}

		return Redirect::route('home')->with('global', 'We could not activate your account now. Try again later.');

	}

}