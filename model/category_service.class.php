<?php

require_once __SITE_PATH .  '/app/database/db.class.php';
require_once __SITE_PATH .  '/model/category.class.php';

class CategoryService 
{
    function getAllCategories()
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM category ORDER BY id_category');
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Category ($row['id_category'], $row['category_name'],$row['description'] );
		}
		return $arr;
    }

    function getCategoryByName( $category_name )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT * FROM category WHERE category_name=:category_name');
			$st->execute( array( 'category_name' => $category_name ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Category( $row['id_category'], $row['category_name'], $row['description'] );
    }
};

?>
