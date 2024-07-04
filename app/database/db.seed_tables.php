<?php

require_once 'db.class.php';

seed_table_users();

function seed_table_users()
{
    $db = DB::getConnection();

    try
    {
	    $st = $db->prepare( 'INSERT INTO users(username, password_hash, email, is_admin, name, surname, balance ) VALUES
					  (:username, :password, :email, :is_admin, :name, :surname, :balance )' );

        $st->execute( array( 'username' => 'kristicivana', 'password' => password_hash( 'ivana#12', PASSWORD_DEFAULT ),
            'email' =>'ivana.kristic@student.math.hr', 'is_admin' =>'1', 'name'=>'Ivana', 'surname' => 'Kristic', 'balance' => '0' ) );

        $st->execute( array( 'username' => 'anahodzic', 'password' => password_hash( 'anah#14', PASSWORD_DEFAULT ),
            'email' =>'ana.hodzic@student.math.hr', 'is_admin' =>'1', 'name'=>'Ana', 'surname' => 'Hodzic', 'balance' => '0' ) );
       
    }
    catch( PDOException $e ) { exit( "PDO error [insert users]: " . $e->getMessage() ); }

    echo "Insert into table users.<br />";
}

?>
