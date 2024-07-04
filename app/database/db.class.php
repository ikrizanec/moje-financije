<?php

class DB
{
	private static $db = null;

	private function __construct() { }
	private function __clone() { }

	public static function getConnection() 
	{
		if( DB::$db === null )
	    {
			$database = require_once 'db.settings.php';
	    	try
	    	{
		    	DB::$db = new PDO( $database['rp2']['db_name'], $database['rp2']['db_user'], $database['rp2']['db_pass'] );
		    	DB::$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    }
		    catch( PDOException $e ) { exit( 'PDO Error: ' . $e->getMessage() ); }
	    }
		return DB::$db;
	}
}

?>
