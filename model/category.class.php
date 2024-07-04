<?php

class Category
{
    protected $id_category, $category_name, $description;

    function __construct( $id_category, $category_name, $description )
	{
		$this->id_category = $id_category;
		$this->category_name = $category_name;
        $this->description = $description;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
};
?>
