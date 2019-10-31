<?php 

  class Database {

    public static function connect() {
      /* setting */
      $root = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'store';

      $db = new mysqli( $root , $user, $password, $database);
      /* config querys */
      $db->query("SET NAMES 'utf8'");

      return $db;
    }
  }