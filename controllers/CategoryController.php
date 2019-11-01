<?php 

require_once 'models/categoryModel.php';
require_once 'models/productModel.php';


  class categoryController {
   
    public function index() {
      Utils::isAdmin();

      $category = new Category();

      $categories = $category->getAll();

      require_once "views/category/index.php";
    }

    public function show() {
      if (isset($_GET['id'])){

        $id = $_GET['id'];

        // get category
        $category = new Category();

        $category->setId($id);

        $category = $category->getOne();

        // get product
        $product = new Product();

        $product->setCategoryId($id);

        //get all products by category
        $products = $product->getAllByCategory();

        



      }

      require_once 'views/category/show.php';
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