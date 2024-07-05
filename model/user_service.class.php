<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/user.class.php';

class UserService{

    public function __construct() {}

    function getUserByUsername( $username )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users WHERE username=:username' );
			$st->execute( array( 'username' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id_user'],$row['username'], $row['password_hash'], $row['email'], 
             $row['is_admin'], $row['name'], $row['surname'], $row['balance']);
	}

    function getUserById( $id_user )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id_user'],$row['username'], $row['password_hash'], $row['email'], 
            $row['is_admin'], $row['name'], $row['surname'], $row['balance']);
	}


    function updateName( $username, $name )
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET name = :name WHERE username = :username');
            $st->execute( array( 'username' => $username , 'name' => $name ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function updateSurname( $username, $surname )
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET surname = :surname WHERE username = :username');
            $st->execute( array( 'username' => $username , 'surname' => $surname ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function updateEmail( $username, $email )
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET email = :email WHERE username = :username');
            $st->execute( array( 'username' => $username , 'email' => $email ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }

    function isAdmin( $id_user )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT is_admin FROM users WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
		if( $row === false )
			return false;
        else
            return true;
    }

    function updateBalance( $username, $balance )
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE users SET balance = :balance WHERE username = :username');
            $st->execute( array( 'username' => $username , 'balance' => $balance ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
};
?>
