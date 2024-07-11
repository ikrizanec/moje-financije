<?php

class SavingsContributions implements jsonSerializable
{
    protected $id_savings_contributions, $id_savings, $payment_amount, $contribution_date;

    function __construct( $id_savings_contributions, $id_savings, $payment_amount, $contribution_date )
	{
		$this->id_savings_contributions = $id_savings_contributions;
		$this->id_savings = $id_savings;
        $this->payment_amount = $payment_amount;
        $this->contribution_date = $contribution_date;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }

	public function jsonSerialize(): {
        return [
            'id_savings_contributions' => $this->id_savings_contributions,
            'id_savings' => $this->id_savings,
            'payment_amount' => $this->payment_amount,
            'contribution_date' => $this->contribution_date,
        ];
    }
};
?>
