<?php
require_once __SITE_PATH . '/model/category_service.class.php';
require_once __SITE_PATH . '/model/category.class.php';

class CategoriesController 
{
    public function index() 
    {
        if (isset($_GET['action']) && $_GET['action'] === 'list') 
        {
            $cs = new CategoryService();
            $categories = $cs->getAllCategories();
            $message['categories'] = $categories;
            $this->sendJSONandExit($message);
        } 
        else 
        {
            include __SITE_PATH . '/view/category_list.php';
        }
    }

    public function add() 
    {
        if (isset($_POST['action']) && $_POST['action'] === 'add')
        {
            $cs = new CategoryService();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $cs->addCategory($name, $description);
            
            $message['message'] = 'Category added successfully!';
            $this->sendJSONandExit($message);
        } 
        else 
        {
            include __SITE_PATH . '/view/category_add.php';
        }
    }

    public function sendJSONandExit($message) 
    {
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($message);
        flush();
        exit(0);
    }
}
?>
