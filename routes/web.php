<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route){

/*
	Register routes here
*/	

	$route->get('/loginform', 'Auth\LoginController@showLoginForm');
	$route->post('/login', 'Auth\LoginController@login');
	$route->get('/home', 'UserController@getUsers');


/*
	Register routes here
*/	
});


/*
	start dispatchching routes
*/
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$route_info = $dispatcher->dispatch($httpMethod, $uri);
//echo json_encode($route_info[0]);
switch ($route_info[0]) 
{
	case FastRoute\Dispatcher::NOT_FOUND:
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		echo 'Sorry the page your are looking for cannot be found!';
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $route_info[1];

		//

		//
		$vars =$route_info[2];
		list($class, $method) = explode('@', $handler, 2);
		$class = "App\Controllers\\".$class;
		call_user_func_array([new $class, $method], $vars);
		break;

}

/*
	end dispatchching routes
*/