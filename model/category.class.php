<?php

class Category implements jsonSerializable
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

	public function jsonSerialize(): mixed {
        return [
            'id_category' => $this->id_category,
            'category_name' => $this->category_name,
            'description' => $this->description,
        ];
    }
};
?>
