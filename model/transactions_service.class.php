<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/transactions.class.php';

class TransactionsService
{
    function getTransactionsByType( $type )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM transactions WHERE type=:type' );
			$st->execute( array( 'type' => $type ) );
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
};
?>
