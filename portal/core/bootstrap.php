<?php
	session_start();
	
	require 'core/App.php';
	require 'core/view.php';

	require 'vendor/autoload.php';
	App::bind('config', $config = require ('config.php'));
	$data = new QueryBuilder(Connection::make($config));
	
	App::bind('database', $data);
	
	function view($file, $data = [])
	{
		 if(file_exists("views/{$file}.view.php"))
		 {
		 	extract($data);
		 	require "views/{$file}.view.php";
		 }
		 else
		 {
		 	echo "404";
		 }
	}

	function errorlog($file)
	{
		 if(file_exists("views/{$file}.view.php"))
		 {
		 	require "views/{$file}.view.php";
		 }
		 else
		 {
		 	echo "<h1>Not Found : 404</h1> ";
		 }
	}

	function get_header($id)
	{
		$title = $id;
		include 'views/header.php';
	}

	function get_footer()
	{
		include 'views/footer.php';
	}

	function get_link($link)
	{
		if($link == 'css')
		{
			require 'views/_link_css.html';
		}
		else if ($link == 'js')
		{
			require 'views/_link_js.html';
		}
	}