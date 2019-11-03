
<?php 
  session_start();
  require_once 'autoload.php';
  require_once 'config/Database.php';
  require_once 'config/parameters.php';
  /* HELPERS */
  require_once 'helpers/utils.php';
  /* HEADER */
  require_once 'views/layout/header.php';
  /* SIDEBAR */
  require_once 'views/layout/sidebar.php';


  /* ERROR PAGES */
  function showPageError() {
    $error = new errorController();
    $error->index();
  }

  //  
  if (isset($_GET['controller'])){
    $controllerName = $_GET['controller'].'Controller';
  }
  elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controllerName = DEFAULT_CONTROLLER;
  } else {
    showPageError();
    exit();
  }

  if (class_exists($controllerName) ){
    
    $controller = new $controllerName();

    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])){
      $actionName = $_GET['action'];
      $controller->$actionName();
    } 
    elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {

      $actionName = ACTION_DEFAULT;
      $controller->$actionName();
    } else {
      showPageError();
    }

  } else {
    showPageError();
  }

  /* FOOTER */
  require_once 'views/layout/footer.php';

?>