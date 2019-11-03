<?php 


  class Utils {
    public static function deleteSession($name) {

      if (isset($_SESSION[$name])){
        $_SESSION[$name] = null;
      }
      
      return null;
    }

    public static function isAdmin() {
      if (isset($_SESSION['admin'])) {
        return true;
      } else {
        header("Location: ".BASE_URL);
      }
    }

    public static function isLogged() {
      if (isset($_SESSION['user'])) {
        return true;
      } else {
        header("Location: ".BASE_URL);
      }
    }

    public static function showCategories() {
      require_once 'models/categoryModel.php';
      
      $category = new Category();
      
      return $category->getAll();

    }

    public static function cartStats() {
      $stats = array(
        'count' => 0,
        'total' => 0
      );
      
      if (isset($_SESSION['cart'])) {
        $stats['count'] = count($_SESSION['cart']);

        foreach($_SESSION['cart'] as $index => $product) {
          $stats['total'] += $product['price'] * $product['units'];
        }
      }

      return $stats;
    }

    public static function showStatus($status) {

      $newStatus = '';

      switch($status) {
        case 'confirm':
          $newStatus = 'Pendiente';
          break;
        case 'preparation':
          $newStatus = 'En preparacion';
          break;
        case 'ready':
          $newStatus = 'Listo para enviar';
          break;
        case 'sended':
          $newStatus = 'Enviado';
          break;
      }

      return $newStatus;

    }
  }