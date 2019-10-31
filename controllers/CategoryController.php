<?php 

require_once 'models/categoryModel.php';

  class categoryController {
   
    public function index() {
      Utils::isAdmin();

      $category = new Category();

      $categories = $category->getAll();

      require_once "views/category/index.php";
    }

    public function create() {
      Utils::isAdmin();
      
      require_once 'views/category/create.php';

    }

    public function save() {
      Utils::isAdmin();

      if ($_POST['name']) {

        //verify data
        $name =  isset($_POST['name']) ? $_POST['name'] : false;

        if ($name) {
          $category = new Category();
          $category->setName($name);

          $categoryIsSaved = $category->save();

          if ($categoryIsSaved) {
            $_SESSION['category-creation'] = true;
            require_once 'views/category/create.php';
          } else {
            $_SESSION['category-error '] = false;
          }
          
          header("Refresh: 2, URL= ". BASE_URL . 'category/index');

        }
      }


    }
  }

?>