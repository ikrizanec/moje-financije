<?php

require_once 'db.class.php';

$db = DB::getConnection();

$has_tables = false;

try
{
	$st = $db->prepare(
		'SHOW TABLES LIKE :tblname'
	);

	$st->execute( array( 'tblname' => 'users' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

	$st->execute( array( 'tblname' => 'expenses' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;
    
    $st->execute( array( 'tblname' => 'category' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;

	$st->execute( array( 'tblname' => 'report' ) );
	if( $st->rowCount() > 0 )
		$has_tables = true;

    $st->execute( array( 'tblname' => 'expenses_report' ) );
    if( $st->rowCount() > 0 )
    	$has_tables = true;
    
    $st->execute( array( 'tblname' => 'savings' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;

    $st->execute( array( 'tblname' => 'savings_contributions' ) );
    if( $st->rowCount() > 0 )
        $has_tables = true;
    

}
catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }


if( $has_tables )
{
	exit( 'Tables users / expenses / category / report / ' . 
			'expenses_report / savings / savings_contributions already exist. ' .
            'Delete them and try again.' );
}


try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS users (' .
		'id_user int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'username varchar(50) UNIQUE NOT NULL,' .
        'password_hash varchar(255) NOT NULL,' .
        'email varchar(255) NOT NULL,'. 
        'registration_sequence varchar(50) NOT NULL,' . 
        'has_registered int NOT NULL,' . 
        'is_admin int NOT NULL,' .
		'ime varchar(50) NOT NULL,' .
		'prezime varchar(50) NOT NULL,' .
		'date_of_birth date NOT NULL,' . 
        'stanje DOUBLE NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create users]: " . $e->getMessage() ); }

echo "Created the users table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS expenses (' .
		'id_expenses int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_user int NOT NULL,' .
		'id_category int NOT NULL,' .
        'amount DOUBLE NOT NULL,' .
        'expense_date date NOT NULL,' .
        'description varchar(500) NOT NULL )' 
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create expenses]: " . $e->getMessage() ); }

echo "Created the expenses table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS category (' .
		'id_category int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'category_name varchar(50) NOT NULL,' .
		'description varchar(500), ' .
		'type varchar(50) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create category]: " . $e->getMessage() ); }

echo "Created the category table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS report (' .
		'id_report int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_user int NOT NULL,' .
		'amount DOUBLE NOT NULL,' .
        'start_date date NOT NULL,' .
		'end_date date NOT NULL,' .
        'description varchar(500) NOT NULL ) '
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create report]: " . $e->getMessage() ); }

echo "Created the report table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS expenses_report (' .
		'id_expenses_report int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_izvjestaj int NOT NULL,' .
		'id_exspense int NOT NULL,' .
		'id_savings_contributions int NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create expenses_report]: " . $e->getMessage() ); }

echo "Created the expenses_report table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS savings (' .
		'id_savings int NOT NULL,' .
		'id_user int NOT NULL,' .
		'savings_name varchar(50) NOT NULL,' .
		'savings_goal DOUBLE NOT NULL,' .
		'current_balance DOUBLE NOT NULL,' .
		'deadline date NOT NULL,' .
		'PRIMARY KEY (id_savings, id_user) )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create savings]: " . $e->getMessage() ); }

echo "Created the savings table.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS savings_contributions (' .
		'id_savings_contributions int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'id_savings int NOT NULL,' .
		'payment_amount DOUBLE NOT NULL,' .
		'contribution_date date NOT NULL )' 
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error [create savings_contributions]: " . $e->getMessage() ); }

echo "Created the savings_contributions table.<br />";

?>