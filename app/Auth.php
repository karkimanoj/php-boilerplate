<?php

namespace App;
use App\Models\User;
use \App\Session;
/**
 * 
 */
class Auth 
{
	


	public static function attempt(array $credientials, array $additionalCredientials = [])
	{	
/*
		$credientials = array_map(function ($crediential, $key) {
			return [$key, $crediential];
		}, $credientials);

		*/
		$credientials += $additionalCredientials;
		$password = $credientials['password'];
		unset($credientials['password']);

		$conditions = [];
		foreach ($credientials as $key => $value) {
			array_push($conditions, [$key,'=' ,$value]);
		}
	
		$user = User::where($conditions)->first();
		
		
		if(isset($user) && password_verify($password, $user->password))
		{
			return Self::login($user);
		}
		
	}

	public static function login($user)
	{	
		
		if(Session::set('userId', $user->id)) return $user;
		
	}

	public static function logout()
	{
		Session::forget('userId');
		Session::kill();		
	}

	public static function user()
	{
		$userId = Session::get('userId');
		/*Session::set('userId1' , 'YESSSSSSSSSSSSSSSSS');
		
		var_dump(Session::get('userId1'));
		exit();*/
		return User::find($userId);
	}
}