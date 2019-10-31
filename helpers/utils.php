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

    public static function showCategories() {
      require_once 'models/categoryModel.php';
      
      $category = new Category();
      
      return $category->getAll();

    }
  }