<?php

namespace App\Controllers\Auth;
use App\Request;
use App\Auth;
use App\Session;
use App\View;
/**
 * 
 */
class LoginController
{	
	protected $redirectTo = '/home';
	
	public function showloginForm()
	{
		return View::make('auth.login');
	}

	public function login()
	{	
		
		$request = new Request;

/*
		$rules = [
			'required' => ['email,password'],
			'string' => 'email',

		];	*/
		//var_dump($request->all());
		

		$rules = [
		    'email' => ['required', 'email'],
		    'password'=>['required', ['lengthMin', 6]]
		];

		$v = new \Valitron\Validator($request->only(['email' ,'password']));

		$v->mapFieldsRules($rules);
		
		if(!$v->validate())
		{
			Session::flash('errors', $v->errors);
			header('Locattion: '.$_SERVER['http_referer']);
			exit(1);
		}
			
		if($user = Auth::attempt($request->only(['email' ,'password'])))
		{	
			/*
			highlight_string("<?php\n" . var_export(Session::get('userId') +42 , true) . ";\n?>");
			exit();*/
			
			header('Location: '.$this->redirectTo);
			exit(1);
		}
		else
		{
			Session::flash('invalid credientils');
			header('Location: '.$this->redirectTo);
			exit(1);
		}



	}

	public function logout()
	{
		Auth::logout();
		header('Location: login');
		exit(1);
	}

}