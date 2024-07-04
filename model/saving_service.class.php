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
			$st = $db->prepare( 'SELECT * FROM saving WHERE id_user=:id_user' );
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Saving( $row['id_savings'],$row['id_user'], $row['savings_name'], $row['savings_goal'], 
            $row['current_balance'], $row['deadline'], $row['surname'], $row['balance']);
		}
		return $arr;
	}
};
?>
