<?php
namespace App;

class View 
{
	
	protected $folder;

	function __construct($folder = 'views')
	{
		$this->folder = $folder;
	}

	public static function make($filepath, $vars = [] )
	{	
		$output = '';
		$instance = new Self;
		//var_dump('expression');
		if($actualFilepath = $instance->findTemplate($filepath)){
			//echo $actualFilepath;
			$output = $instance->renderTemplate($actualFilepath, $vars);

		}
		//echo $actualFilepath;
		//var_dump($output);
		print $output;
	}	

	protected function findTemplate($filepath){
		$filepath = str_replace('.', '/', $filepath);
		$full_filepath = $this->folder.'/'.$filepath.'.php';
		
		
		if(file_exists($full_filepath))
			return $full_filepath;
		else
			return false;

	}

	private  function renderTemplate(/*$templatePath, $vars*/)
	{
		$templatePath = func_get_args()[0];
		$vars = func_get_args()[1];
	
		ob_start();
		foreach ($vars as $key => $value) {
			${$key} = $value;
		}
		include($templatePath);

		return ob_get_clean();
	}
}

function view($filepath, $vars = [])
{
	return View::make($filepath, $vars);
}