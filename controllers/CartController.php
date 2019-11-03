<?php 

require_once 'models/productModel.php';

  class cartController {
    
    public function index() {
      
      if (isset($_SESSION['cart'])) {
        $cart = ($_SESSION['cart']);
      } else {
        $cart = array();
      }
      
      require_once 'views/cart/index.php';
    }
    
    public function add() {

      // get product id
      if (isset($_GET['id'])) {
        $productId = $_GET['id'];

      } else {
        // redirect if not exists product id
        header("Location: ".BASE_URL);
      }

      // add units to cart
      if (isset($_SESSION['cart'])){

        $counter = 0;

        foreach($_SESSION['cart'] as $index => $element) {
          if ($element['id_product'] == $productId) {
            $_SESSION['cart'][$index]['units']++;
            $counter++;
          }
        }

      } 
      
      // if cart not exists
      if (!isset($counter) or $counter == 0) {

        $product = new Product();

        $product->setId($productId);
        $product = $product->getOne();

        if (is_object($product)) {
          $_SESSION['cart'][] = array(
            "id_product" => $product->id,
            "price" => $product->price,
            "units" => 1,
            "product" => $product
          );

      }
        
      }


      header("Location:". BASE_URL . 'cart/index');
    }

    public function remove() {

      if (isset($_GET['index'])) {

        $index = $_GET['index'];

        unset($_SESSION['cart'][$index]);

        header("Location:". BASE_URL . 'cart/index');

      }

    }

    public function delete_all() {
      unset($_SESSION['cart']);
      header("Location:". BASE_URL . 'cart/index');
    }

    public function up() {

      if (isset($_GET['index'])) {

        $index = $_GET['index'];

        $_SESSION['cart'][$index]['units']++;

        header("Location:". BASE_URL . 'cart/index');

      }

    }
    public function down() {

      if (isset($_GET['index'])) {

        $index = $_GET['index'];

        $_SESSION['cart'][$index]['units']--;

        if ($_SESSION['cart'][$index]['units'] == 0) {
          unset($_SESSION['cart'][$index]);
        }

        header("Location:". BASE_URL . 'cart/index');

      }

    }
    


  }