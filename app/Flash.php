<?php
namespace App;

class Flash 
{
	/*
	private $messages;
	private static $instance = null;

	private function initFlash()
	{
		if(isset($_SESSION['flash']))
			$this->messages = $_SESSION['flash'];
		else
			$_SESSION['flash'] = [];
	}


	private staticS function instance()
	{
		if(Self::$instance === null)
		 	Self::$instance = new FlashSession;

		 return Self::$instance;
		
	}

	public static function __callStatic($function, $arguments = [])
	{
		if(Self::$instance === null)
			Self::$instance = new FlashSession;

		Self::$instance;
		$this->instance = 

	}message

*/

	//private static $messages;

/*
	private static function initFlash()
	{
		if(isset($_SESSION['flash']))
			Self::$messages = $_SESSION['flash'];
		else
			$_SESSION['flash'] = [];
	}
*/

	private static function setMessage($type, $message)
	{	
		//echo $type.'      '.$message;
		//echo $_SESSION['flash'][$type].' ffffff'; 
		//$_SESSION[$name] = $value;
		$_SESSION['flash'][$type] = $message;
		//echo $_SESSION['flash'][$type];

	}	

	private static function getMessage($type)
	{
		if(isset($_SESSION['flash'][$type]))
		{
			$message = $_SESSION['flash'][$type];
			unset($_SESSION['flash'][$type]);
			return $message ;
		}
		return null;
	}

	public static function __callStatic($function, $arguments = [])
	{	
/*
	//	Self::initFlash();
		if(count($arguments) == 1)
		{
			//$message = Self::$messages;
			
			self::setMessage($function, $arguments[0]);
			
		}
		else if (count($arguments) > 1) {
			return null;
		}*/

		
		//return self::getMessage($function);
			
		switch (count($arguments)) {
				case '0':
					return self::getMessage($function);
					break;
				case '1':
					self::setMessage($function, $arguments[0]);
					break;
				default:
					return null;
					break;
			}	


	}
}