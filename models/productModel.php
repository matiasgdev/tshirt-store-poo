<?php 

  class Product {
    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $offer;
    private $date;
    private $image;
    
    private $db;

    public function __construct() {
      $this->db = Database::connect();
    }

    // getters


    public function getId() {
      return $this->id;
    }
    
    public function getCategoryId() {
      return $this->category_id;
    }
    public function getName() {
      return $this->name;
    }
    public function getDescription() {
      return $this->description;
    }
    public function getPrice() {
      return $this->price;
    }
    public function getStock() {
      return $this->stock;
    }
    
    public function getOffer() {
      return $this->stock;
    }

    public function getDate() {
      return $this->stock;
    }

    public function getImage() {
      return $this->image;
    }

    //setters

    public function setId($id) {
      $this->id = $id;
    }

    public function setCategoryId($categoryId) {
      $this->category_id = $categoryId;
    }

    public function setName($name) {
      $this->name = $this->db->real_escape_string($name);
    }

    public function setDescription($description) {
      $this->description = $this->db->real_escape_string($description);
    }

    public function setPrice($price) {
      $this->price = $this->db->real_escape_string($price);
    }

    public function setStock($stock) {
      $this-> stock = $this->db->real_escape_string($stock) ;
    }

    public function setOffer($offer) {
      $this->offer = $this->db->real_escape_string($offer);
    }

    public function setDate($date) {
      $this->date = $date;
    }

    public function setImage($image) {
      $this->image = $image;
    }

    public function getAll() {

      $products = $this->db->query("SELECT * FROM products ORDER BY id ASC");

      return $products;
    }

    public function save() {

      $query = "INSERT INTO products 
            VALUES (NULL, '{$this->getCategoryId()}', '{$this->getName()}', 
            '{$this->getDescription()}', {$this->getPrice()}, {$this->getStock()},
            NULL, CURDATE(), '{$this->getImage()}');"; 

      $save = $this->db->query($query);

      $result = false;

      if ($save) {
        $result = true;
      }

      return $result;
    }

    
  }