<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/saving.class.php';

class SavingService
{
    function getSavingsByUserID( $id_user )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM savings WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Saving( $row['id_savings'], $row['id_user'], $row['savings_name'], $row['savings_goal'], 
                    $row['current_balance'], $row['deadline'] );
		}
		return $arr;
	}
	

	function getSavingById( $id_savings )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM savings WHERE id_savings=:id_savings' );
			$st->execute( array( 'id_savings' => $id_savings ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Saving( $row['id_savings'],$row['id_user'], $row['savings_name'], $row['savings_goal'], 
            $row['current_balance'], $row['deadline']);
	}
	
	function updateSavingsBalance( $id_savings, $payment )
	{
		try
        {
            $db = DB::getConnection();
            $st = $db->prepare('UPDATE savings SET payment_amount = payment_amount + :payment WHERE id_savings = :id_savings');
            $st->execute( array( 'id_savings' => $id_savings , 'payment' => $payment ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}

	function addSaving( $id_user, $savings_name, $savings_goal, $current_balance, $deadline )
	{
		try
        {
            $db = DB::getConnection();
            $st = $db->prepare('INSERT INTO savings( id_user, savings_name, savings_goal, current_balance, deadline ) VALUES
					  (:id_user, :savings_name, :savings_goal, :current_balance, :deadline )');
            $st->execute( array( 'id_user' => $id_user , 'savings_name' => $savings_name, 'savings_goal' => $savings_goal, 'current_balance' => $current_balance,
            'deadline' => $deadline ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}
};
?>
