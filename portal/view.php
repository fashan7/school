<?php
class View
{
	public static function my_view($file, $data = [])
	{
		if(file_exists("views/{$file}.view.php"))
		{
			extract($data);
			require "views/{$file}.view.php";
		}
	}
}