<?php 

  class Category {
    private $id;
    private $name;
    private $db;

    public function __construct() {
      $this->db = Database::connect();
    }

    function getId() {
      return $this->id;
    }
    function getName() {
      return $this->name;
    }

    function setId($id) {
      $this->id = $id;
    } 

    function setName($name) {
      $this->name = $this->db->real_escape_string($name);
    }

    public function getAll() {

      $result = $this->db->query("SELECT * FROM categories ORDER BY id ASC");
      return $result;
    }
    public function getOne() {

      $result = $this->db->query("SELECT * FROM categories WHERE id={$this->getId()}");
      return $result->fetch_object();
    }



    public function save() {
      $query = "INSERT INTO categories 
            VALUES (NULL, '{$this->getName()}');"; 

      $save = $this->db->query($query);

      $result = false;

      if ($save) {
        $result = true;
      }

      return $result;
    }


  }