<?php

namespace App\Controllers;
use App\View;
use App\Session;
use App\Flash;
//use App\Models\User;
//use Models\Question;


class UserController{

		protected $user;

		public function __construct()
		{
			$this->user = new \App\Models\User;
		}

		public function getUsers(){
			/*
			highlight_string("<?php\n" . var_export($this->user->find(Session::get('userId')), true) . ";\n?>");
			exit();*/
			$users = $this->user->all();

			/**/
			//Flash::success('successful action!')
			/*
			Session::flash('success', 'successful actioddn!');
			echo Session::get('success');
			*/
			//$server = $_REQUEST;
			
			return (View::make('users.index', compact('users')));
			//echo view('users.index', compact('users'));
			//print_r($users->toArray());
		}

		public  function create_user($username, $email, $password){
			$user = User::create(['name'=>$username,'email'=>$email,'password'=>$password]);
			return View::make($user);
		}
  
}

?>