<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/savingscontributions.class.php';

class SavingsContributionsService
{
    function getSavingsContributionsBySavingsID( $id_savings )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM savings_contributions WHERE id_savings=:id_savings' );
			$st->execute( array( 'id_savings' => $id_savings ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new SavingsContributions( $row['id_savings_contributions'], $row['id_savings'], $row['payment_amount'], $row['contribution_date'] );
		}
		return $arr;
	}

    function addSavingsContributions( $id_savings, $payment_amount, $contribution_date )
	{
		try
		{
			$db = DB::getConnection();
            $st = $db->prepare('INSERT INTO savings_contributions( id_savings, payment_amount, contribution_date ) VALUES
					  (:id_savings, :payment_amount, :contribution_date)');
            $st->execute( array( 'id_savings' => $id_savings , 'payment_amount' => $payment_amount, 'contribution_date' => $contribution_date ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}
};
?>
