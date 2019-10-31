<?php 
  require_once 'models/productModel.php';
  class productController {

    public function index() {
      /* render view */
      require_once 'views/product/featured.php';
    }


    public function management() {

      Utils::isAdmin();

      $product = new Product();

      $products = $product->getAll();

      require_once 'views/product/management.php';
    }

    public function create() {

      Utils::isAdmin();

      require_once 'views/product/create.php';

    }

    public function save() {
      Utils::isAdmin();

      if (isset($_POST)) {
        $_SESSION['product-error'] = '';
        
        $category = isset($_POST['category']) ? $_POST['category'] : false;
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $description = isset($_POST['description']) ? $_POST['description'] : false;
        $price = isset($_POST['price']) ? $_POST['price'] : false;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : false;

        // $image = isset($_POST['image']) ? $_POST['image'] : false;

        if ($name and $description and $price and $stock and $category) {

          $product = new Product();

          
          $product->setCategoryId($category);
          $product->setName($name);
          $product->setDescription($description);
          $product->setPrice($price);
          $product->setStock($stock);
          //$product->setImage($image);

          $productIsSaved = $product->save();

          if ($productIsSaved) {
            $_SESSION['product'] = true;
            require_once 'views/product/create.php';
          } else {
            $_SESSION['product-error'] = 'Inserción fallida. No se pudo ingresar este producto.';
          }

        }

      } else {
        $_SESSION['product-error'] = 'Inserción fallida. Ingrese todos los datos.';
      }

      header("Refresh: 2, URL=". BASE_URL . 'product/management' );

    }
  }

?>