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

    function getAllUsers()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM users' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id_user'],$row['username'], $row['password_hash'], $row['email'], 
            $row['is_admin'], $row['name'], $row['surname'], $row['balance']);
		}
		return $arr;
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
            return true;
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() );
        return false;
    }
    }

    public function deleteUserById($id_user) 
    {
        try {
            $db = DB::getConnection();
            $db->beginTransaction();
    
            // Delete from transactions table
            $st = $db->prepare('DELETE FROM transactions WHERE id_user=:id_user');
            $st->execute(array('id_user' => $id_user));
    
            // Delete from savings table
            $st = $db->prepare('DELETE FROM savings WHERE id_user=:id_user');
            $st->execute(array('id_user' => $id_user));
    
            // Delete from users table
            $st = $db->prepare('DELETE FROM users WHERE id_user=:id_user');
            $st->execute(array('id_user' => $id_user));
    
            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
            exit('PDO error ' . $e->getMessage());
        }
    }
    

    public function addUser($username, $password_hash, $email, $is_admin, $name, $surname, $balance) {
        try {
            $db = DB::getConnection();
            $st = $db->prepare('INSERT INTO users (username, password_hash, email, is_admin, name, surname, balance) VALUES (:username, :password_hash, :email, :is_admin, :name, :surname, :balance)');
            $st->execute(array(
                'username' => $username,
                'password_hash' => $password_hash,
                'email' => $email,
                'is_admin' => $is_admin,
                'name' => $name,
                'surname' => $surname,
                'balance' => $balance
            ));
        } catch (PDOException $e) {
            exit('PDO error ' . $e->getMessage());
        }
    }
};
?>
