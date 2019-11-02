<?php 

  require_once 'models/orderModel.php';
  class orderController {

    public function do() {
      
      require_once 'views/order/do.php';
    }

    public function add() {
      
      if (isset($_SESSION['user'])) {
        
        $location = isset($_POST['location']) ? $_POST['location'] : false;
        $address = isset($_POST['address']) ? $_POST['address'] : false;
        $userId = isset($_SESSION['user']->id) ? $_SESSION['user']->id : false;
        $stats = Utils::cartStats();

        //save data

        if ($location and $address and $userId) {

          $order = new Order();
  
          $order->setLocation($location);
          $order->setAddress($address);
          $order->setUserId($userId);
          $order->setCost($stats['total']);

          $orderIsSaved = $order->save();

          //Save order line
          $lineIsSaved = $order->setLine();



          if ($orderIsSaved and $lineIsSaved) {
            $_SESSION['order'] = 'success';
          } else {
            $_SESSION['order-error'] = 'No se pudo guardar el pedido';
          }
          


        } else {

          $_SESSION['order-error'] = 'Ingrese todos los datos';
          header("Location:" . BASE_URL . 'order/do');
          return;

        }

      } else {
        $_SESSION['order-error'] = 'Logeate para realizar los pedidos.';
        header("Location:" . BASE_URL .'order/do');
        return;
      }

      header("Location:" . BASE_URL . 'order/confirm');
    }

    public function confirm() {

      if ($_SESSION['user']) {

        $userId = $_SESSION['user']->id;

        //get order data
        $order = new Order();

        $order->setUserId($userId);

        $orderByUser = $order->getOneByUser();
        
        //get data of products by order
        $products = new Order();

        $productsByOrder = $products->getProductsByOrder($orderByUser->id);

      }


      require_once 'views/order/confirm.php';
    }

  }
?>