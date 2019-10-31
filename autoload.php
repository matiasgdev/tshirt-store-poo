<?php 

  function controllersAutoload($className) {
    include 'controllers/' . $className . '.php';
  } 

  spl_autoload_register('controllersAutoload');
  
?>