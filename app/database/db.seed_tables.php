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

        $st->execute( array(
            'username' => 'kristicivana',
            'password' => password_hash( 'ivana#12', PASSWORD_DEFAULT ),
            'email' =>'ivana.kristic@student.math.hr',
            'is_admin' =>'1',
            'name'=>'Ivana',
            'surname' => 'Kristic',
            'balance' => '500'
        ));

        $st->execute( array(
            'username' => 'anahodzic',
            'password' => password_hash( 'anah#14', PASSWORD_DEFAULT ),
            'email' =>'ana.hodzic@student.math.hr',
            'is_admin' =>'1',
            'name'=>'Ana',
            'surname' => 'Hodzic',
            'balance' => '500'
        ));
        
        $st->execute( array(
            'username' => 'stefaniduvnjak',
            'password' => password_hash( 'stefi#123', PASSWORD_DEFAULT ),
            'email' =>'stefani.duvnjak@student.math.hr',
            'is_admin' =>'1',
            'name'=>'Stefani',
            'surname' => 'Duvnjak',
            'balance' => '500'
        ));
        
        $st->execute( array(
            'username' => 'ivanakrizanec',
            'password' => password_hash( 'krizaiva#1', PASSWORD_DEFAULT ),
            'email' =>'ivana.krizanec@student.math.hr',
            'is_admin' =>'1',
            'name'=>'Ivana',
            'surname' => 'Krizanec',
            'balance' => '500'
        ));

        $st->execute( array(
            'username' => 'marijajuric',
            'password' => password_hash('marija123#', PASSWORD_DEFAULT),
            'email' => 'marija.juric@student.math.hr',
            'is_admin' => '0',
            'name' => 'Marija',
            'surname' => 'Juric',
            'balance' => '100.50'
        ));
        
        $st->execute( array(
            'username' => 'petarmaric',
            'password' => password_hash('petar123#', PASSWORD_DEFAULT),
            'email' => 'petar.maric@student.math.hr',
            'is_admin' => '0',
            'name' => 'Petar',
            'surname' => 'Maric',
            'balance' => '250.75'
        ));
        
        $st->execute( array(
            'username' => 'ivanaperic',
            'password' => password_hash('ivana456#', PASSWORD_DEFAULT),
            'email' => 'ivana.peric@student.math.hr',
            'is_admin' => '0',
            'name' => 'Ivana',
            'surname' => 'Peric',
            'balance' => '320.00'
        ));
        
        $st->execute( array(
            'username' => 'anamaricic',
            'password' => password_hash('ana789#', PASSWORD_DEFAULT),
            'email' => 'ana.maricic@student.math.hr',
            'is_admin' => '0',
            'name' => 'Ana',
            'surname' => 'Maricic',
            'balance' => '50.25'
        ));
        
        $st->execute( array(
            'username' => 'josipmarkovic',
            'password' => password_hash('josip123#', PASSWORD_DEFAULT),
            'email' => 'josip.markovic@student.math.hr',
            'is_admin' => '0',
            'name' => 'Josip',
            'surname' => 'Markovic',
            'balance' => '470.80'
        ));
        
    }
    catch( PDOException $e ) { exit( "PDO error [insert users]: " . $e->getMessage() ); }

    echo "Insert into table users.<br />";
}

?>
