<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class DB
{
	private static $r = null;

	private function __construct() { }
	private function __clone() { }

	public static function getConnection() 
	{
		if( DB::$r === null )
	    {
            DB::$r = new Redis();
            DB::$r->connect('redis-14447.c135.eu-central-1-1.ec2.cloud.redislabs.com', 14447);
            DB::$r->auth('y7Lm2WBcfWwfIZHhDuSXlWRjlNvACVAa');
        }
		return DB::$r;
	}
}

?>