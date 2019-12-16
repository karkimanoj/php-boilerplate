<?php

namespace App;


class Request 
{	
	protected $request = [], $query = [], $server = [], $files = [], $cookie = [];
	
	public function __construct()
	{
		$this->server = $_SERVER;
		$this->query = $this->normalizeInput($_GET);
		$this->request = $this->normalizeInput($_GET + $_POST); 

		$this->files = $_FILES;
		$this->cookie = $_COOKIE;
	}

	private function normalizeInput($inputs)
	{
		if(!is_array($inputs))
			$inputs[] = $inputs;

		foreach ($inputs as $key => $input) 
		{
			$inputs[$key] = htmlentities(trim($input));
		}
		return $inputs;
	}

	public function get($fieldName, $default = null)
	{
		 
		 if(isset($this->request[$fieldName]))
		 	return $this->request[$fieldName];
		 return $default;

		 /*
		switch (func_num_args()) {
			case '1':
				$input_name = func_get_args()[0];

				break;
			case '2':
				$input_name = func_get_args()[0];

				break;
			case '0':
				throw new Exception("Not Enough Arguments", 1);
				break;
				
		}*/
	}

	public function query($fieldName, $default = null)
	{
		 
		 if(isset($this->query[$fieldName]))
		 	return $this->query[$fieldName];
		 return $default;
	}

	public function server($key)
	{
		 
		 if(isset($this->server[$key]))
		 	return $this->server[$key];
		 return null;
	}

	public function file($name)
	{
		if(isset($this->files[$name]))
		 	return $this->files[$name];
		 return null;
	}

	public function cookie($key)
	{
		 
		 if(isset($this->cookie[$key]))
		 	return $this->cookie[$key];
		 return null;
	}

	public function setcookie()
	{
		setcookie(...func_get_args());
		
	}

	public function all()
	{
		return $this->request;
	}

	public function only($field)
	{	

		if(!is_array($field))
			$fields = [$field];
		else
			$fields = $field;
		
		$filteredInputs =  [];
		foreach ($fields as  $field1) 
		{
			if(isset($this->request[$field1]))
				$filteredInputs[$field1] = $this->request[$field1];
		}

		return $filteredInputs;
			
	}

}