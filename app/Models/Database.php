<?php
namespace App\Models;
use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
	function __construct(){
        
        $connection = include 'config.php';
        //var_dump($test);
    	$capsule = new Capsule;
    	
    	$capsule->addConnection($connection);

    	// Setup the Eloquent ORM... 
    	$capsule->bootEloquent();
	}
}

/*
"autoload": {
        "classmap": [
            "app/Controllers/", "app/Models/"
        ],
         "psr-4": {
                   "Controllers\\": "app/Controllers/",
"Models\\": "app/Models/"
}     
    }
*/