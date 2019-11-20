<?php

if(!function_exists('csrf_token'))
{
	function csrf_token(){
		$csrftoken = new App\Csrftoken;
		return $csrftoken->generateToken();
	}
}