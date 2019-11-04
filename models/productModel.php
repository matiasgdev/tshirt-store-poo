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
      $this->description = trim($this->db->real_escape_string($description));
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

    private function isImageCreated() {
      if ($this->getImage() != null) {
        return $this->getImage();
      }
      return false;
    }

    public function getAll() {

      $products = $this->db->query("SELECT * FROM products ORDER BY id ASC");

      return $products;
    }

    public function getAllByCategory() {

      $query = "SELECT p.*, c.name AS 'category_name'"
              ." FROM products p"
              ." INNER JOIN categories c ON c.id = p.category_id"
              ." WHERE p.category_id = {$this->getCategoryId()}"
              ." ORDER BY id ASC";
      
      $products = $this->db->query($query);

      return $products;
    }

    public function getOne() {
      $product = $this->db->query("SELECT * FROM products WHERE id = {$this->getId()}");

      return $product->fetch_object();
    }

    public function getRandom($limit) {

      $products = $this->db->query("SELECT * FROM products ORDER BY RAND() LIMIT $limit");

      return $products;
    }


    public function save() {

      $query = "INSERT INTO products VALUES (NULL, {$this->getCategoryId()}, '{$this->getName()}', '{$this->getDescription()}', {$this->getPrice()}, {$this->getStock()}, NULL, CURDATE(), '{$this->isImageCreated()}')"; 
      $save = $this->db->query($query);


      $result = false;

      if ($save) {
        $result = true;
      }

      return $result;
    }

    public function delete() {


      $query = "DELETE FROM products WHERE id={$this->getId()}";

      $isDeleted = $this->db->query($query);
      
      if ($isDeleted) {
        return true;
      } else {
        return false;
      }

    }

    public function update() {

      $image = $this->isImageCreated();

      // query
      $query = "UPDATE products SET 
          name ='{$this->getName()}',
          category_id={$this->getCategoryId()},
          description = '{$this->getDescription()}',
          price = {$this->getPrice()},
          stock = {$this->getStock()}";

      if ($image) {
        $query .= ", image='$image'";
      }

      $query.=" WHERE id=".$this->getId();

      $product = $this->db->query($query);

      return $product;
    }
    
  }