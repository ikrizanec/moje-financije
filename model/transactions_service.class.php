<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/transactions.class.php';

class TransactionsService
{
    function getAllTransactions( $id_user )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM transactions WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Transactions ($row['id_transactions'], $row['id_user'], $row['id_category'], $row['amount'],
                    $row['transaction_date'], $row['description'], $row['type'] );
		}
		return $arr;
    }

    function getTransactionsByType( $id_user, $type )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM transactions WHERE id_user=:id_user AND type=:type' );
			$st->execute( array( 'id_user' => $id_user, 'type' => $type ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Transactions ($row['id_transactions'], $row['id_user'], $row['id_category'], $row['amount'],
                    $row['transaction_date'], $row['description'], $row['type'] );
		}
		return $arr;
	}
	
    function getTransactionsByCategory( $id_user, $id_category )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM transactions WHERE id_user=:id_user AND id_category=:id_category' );
			$st->execute( array( 'id_user' => $id_user, 'id_category' => $id_category ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Transactions ($row['id_transactions'], $row['id_user'], $row['id_category'], $row['amount'],
                    $row['transaction_date'], $row['description'], $row['type'] );
		}
		return $arr;
	}

    function getTransactionsByDate( $id_user, $begin_date, $end_date )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM transactions WHERE id_user=:id_user AND transaction_date>=:begin_date AND transaction_date<=:end_date' );
			$st->execute( array( 'id_user' => $id_user, 'begin_date' => $begin_date, 'end_date' => $end_date ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Transactions ($row['id_transactions'], $row['id_user'], $row['id_category'], $row['amount'],
                    $row['transaction_date'], $row['description'], $row['type'] );
		}
		return $arr;
    }

    function addTransaction( $id_user, $id_category, $amount, $transaction_date, $description, $type )
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('INSERT INTO transactions( id_user, id_category, amount, transaction_date, description, type ) VALUES
					  (:id_user, :id_category, :amount, :transaction_date, :description, :type )');
            $st->execute( array( 'id_user' => $id_user , 'id_category' => $id_category, 'amount' => $amount, 'transaction_date' => $transaction_date,
            'description' => $description, 'type' => $type ) );
        }
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
};
?>
