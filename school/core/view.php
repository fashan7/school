<?php
class View
{
	public static function my_view($file, $data = [])
	{
		if(file_exists("view/{$file}.view.php"))
		{
			extract($data);
			require "view/{$file}.view.php";
		}
	}
}