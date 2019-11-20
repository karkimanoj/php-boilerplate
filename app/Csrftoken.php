<?php
namespace App;
use App\Session;

/**
 * 
 */
class Csrftoken
{
	

	public function generateToken()
	{
		$token = bin2hex(openssl_random_pseudo_bytes(30));
		return Session::set('_csrftoken', $this->token);

	}

	public function checkCsrf()
	{	
		$request = new App\Request;
		if($request->server('REQUEST_METHOD') == 'POST') 
		{
			$token = $request->get('_csrftoken');
	
			try 
			{
				if(!$this->verifyToken($token))
				 	$this->failed();

			} 
			catch (Exception $e) 
			{
				$this->failed();
			}
			return 1;
		}


	}

	protected function verifyToken($token)
	{
		return $token === Session::get('_csrftoken');

	}

	protected function failed()
	{	
		header('Location: '.$_SERVER['http_referer']);
		throw new Exception(" Error Processing Request. Csrf token mismatched.", 1);
		exit(1);
	}


}