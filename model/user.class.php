<?php

class User
{
	protected $id_user, $username, $password_hash, $email, $is_admin, $name, $surname, $balance;

	function __construct( $id_user, $username, $password_hash, $email, $is_admin, $name, $surname, $balance )
	{
		$this->id_user = $id_user;
		$this->password_hash = $password_hash;
        $this->email = $email;
        $this->is_admin = $is_admin;
        $this->name = $name;
		$this->surname = $surname;
        $this->balance = $balance;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
