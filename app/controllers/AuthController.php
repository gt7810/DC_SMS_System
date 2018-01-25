<?php

class AuthController extends BaseController {

	public function __construct(LDAP $ldap) {
		$this->ldap = $ldap;
 	}

 	//Show login form
	public function login()
	{	
		return View::make('auth/login');
	}

	//Post login
	public function doLogin()
	{	
		$rules = array(
			'username'    => 'required', 
			'password' => 'required' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::refresh()->with('error', 'Please enter your username and password.');
		} else {
			//Do LDAP authentication
			if ( $this->ldap->authenticate( Input::get('username'), Input::get('password')) ) {
				$ldapsearch = $this->ldap->authenticate( Input::get('username'), Input::get('password'));

				// Check user is allowed access
				if($this->ldap->checkUser(Input::get('username'),$ldapsearch)){	
					//Check if user is already in Database, if not then add them as an author
					$user = User::where('username','=',Input::get('username'))->first();
					if($user){
						Auth::login($user);
					}else{
						$user = new User;
						$user->username = Input::get('username');
						$user->firstname = $ldapsearch[0]['givenname'][0];
						$user->save();
						Auth::login($user);
					}
					return Redirect::to('/');
				}else{
					return Redirect::refresh()->with('error', 'Sorry your account doesn\'t have access.');
				}
			}
			 
			return Redirect::refresh()->with('error', 'Username and/or password are incorrect.');
		}
	}

	// Log the user out
	public function logout() {
	 	Auth::logout();
		return Redirect::to('/login')->with('success', 'Thanks, you are now logged out.'); 
	}

}
