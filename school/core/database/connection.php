<?php
class Connection
{
	public static function make($config)
	{
		try
		{
			return new PDO(
                $config['database']['connection'].';dbname='.$config['database']['name'],
                $config['database']['username'],
                $config['database']['password'],
                $config['database']['options']
            ); 
		}
		catch(Exception $e)
		{
			die('Could Not Connect '.$e);
		}
	}
}