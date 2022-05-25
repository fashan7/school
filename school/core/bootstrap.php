<?php  
require 'core/App.php';
require 'core/view.php';
require 'vendor/autoload.php';

App::bind('config', $config = require ('config.php'));
//App::bind('database', new QueryBuilder(Connection::make($config)));
$data = new QueryBuilder(Connection::make($config));
App::bind('database', $data);

function view($file, $data = [])
{
	if(file_exists("view/{$file}.view.php"))
	{
		extract($data);
		require "view/{$file}.view.php";
	}
	else
		echo "404";
}

