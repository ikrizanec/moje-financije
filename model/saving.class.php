<?php

class Saving implements jsonSerializable
{
    protected $id_savings, $id_user, $savings_name, $savings_goal, $current_balance, $deadline;

    function __construct( $id_savings, $id_user, $savings_name, $savings_goal, $current_balance, $deadline )
	{
		$this->id_savings = $id_savings;
		$this->id_user = $id_user;
        $this->savings_name = $savings_name;
        $this->savings_goal = $savings_goal;
        $this->current_balance = $current_balance;
		$this->deadline = $deadline;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

	public function jsonSerialize(){
        return [
            'id_savings' => $this->id_savings,
            'id_user' => $this->id_user,
            'savings_name' => $this->savings_name,
            'savings_goal' => $this->savings_goal,
            'current_balance' => $this->current_balance,
            'deadline' => $this->deadline
        ];
    }
};
?>
