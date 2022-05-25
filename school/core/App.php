<?php
class App
{
	protected static $myvalues = [];

	public static function bind($key, $value)
	{
		return static::$myvalues[$key] = $value;
	}

	public static function get($key)
	{
		if(array_key_exists($key, static::$myvalues))
        {
            return static::$myvalues[$key];
        }
		else
        {
            throw new exception("Not Found");	
        }
	}
}