<?php
class Router
{
	public $routes = [
		'GET' => [],
		'POST' => []
	];

	public static function load($file)
	{
		$router = new static;
		require $file;
		return $router;
	}

	public function get($uri, $controller)
	{
		$this->routes['GET'][$uri] = $controller;
	}
	public function post($uri, $controller)
	{
		$this->routes['POST'][$uri] = $controller;
	}
	
	public function direct($uri, $requestType)
	{
		// var_dump(...explode('@',$this->routes[$requestType][$uri]));
		if(array_key_exists($uri, $this->routes[$requestType]))
		{
			return $this->callAction(
				...explode("@", $this->routes[$requestType][$uri])
			);
		}
		else
		{
			return $this->callAction('PagesController','errlog');
		}
	}
	
	public function callAction($controller, $action)
	{	
		$controller = new $controller();
		if(!method_exists($controller, $action))
		{
			throw new exception("No {$action} in {$controller}");
		}
		return $controller->$action();
	}
}
