<?php 

require_once 'models/productModel.php';

  class cartController {
    
    public function index() {
      
      
      $cart = ($_SESSION['cart']);
      
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
      if (!$counter or $counter == 0) {

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

    }

    public function delete() {
      unset($_SESSION['cart']);
      header("Location:". BASE_URL . 'cart/index');
    }


  }