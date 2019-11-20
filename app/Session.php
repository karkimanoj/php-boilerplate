<?php
namespace App;

class Session{
	/*
	public function ___constructor()
	{
		if(session_status() !=  'PHP_SESSION_ACTIVE')
			session_start();
	}	*/

	public static function  set($name, $value)
	{	
		//$self = new self;
		 $_SESSION[$name] = $value;
		 return $_SESSION[$name];


	}

	public static function  get($name)
	{	
/*
		if(isset($_SESSION['flash'][$name]))
		{	

			return self::getMessage($name);
		}*/
		 
		return isset($_SESSION['flash'][$name]) ? $_SESSION['flash'][$name] : $_SESSION[$name] ;  
		  

			
		

	}

	public static function forget($name)
	{
		if(isset($_SESSION[$name])) unset($_SESSION[$name]);
	}

	public static function kill()
	{
	    session_unset();
	    session_destroy();
	}

	private static function setMessage($type, $message)
	{	
		//echo $type.'      '.$message;
		//echo $_SESSION['flash'][$type].' ffffff'; 
		//$_SESSION[$name] = $value;
		return $_SESSION['flash'][$type] = $message;
		//echo $_SESSION['flash'][$type];

	}	

	private static function getMessage($type)
	{
		$message = $_SESSION['flash'][$type];
	
		unset($_SESSION['flash'][$type]);
		return $message ;
		
	}

	public static function flash($type, $message = null)
	{	
		
			if(is_null($message))
				return self:: get($type);
	
			return self::setMessage($type, $message);

		

				


	}


}