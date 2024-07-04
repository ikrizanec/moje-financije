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
};

?>
