<?php

class Transactions implements jsonSerializable
{
    protected $id_transactions, $id_user, $id_category, $amount, $transaction_date, $description, $type;

    function __construct( $id_transactions, $id_user, $id_category, $amount, $transaction_date, $description, $type )
	{
		$this->id_transactions = $id_transactions;
		$this->id_user = $id_user;
        $this->id_category = $id_category;
        $this->amount = $amount;
        $this->transaction_date = $transaction_date;
		$this->description = $description;
        $this->type = $type;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

	public function jsonSerialize():mixed { // PAZII
        return [
            'category_name' => $this->id_category,
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date,
            'description' => $this->description,
			'type' => $this->type,
        ];
    }
};
?>
