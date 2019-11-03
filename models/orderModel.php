<?php 

  class Order {
    private $id;
    private $userId;
    private $location;
    private $address;
    private $cost;
    private $status;
    private $date;
    private $time;
    
    private $db;

    public function __construct() {
      $this->db = Database::connect();
    }

    // getters


    public function getId() {
      return $this->id;
    }
    
    public function getUserId() {
      return $this->userId;
    }
    public function getName() {
      return $this->name;
    }
    public function getLocation() {
      return $this->location;
    }
    public function getAddress() {
      return $this->address;
    }
    public function getCost() {
      return $this->cost;
    }
    
    public function getStatus() {
      return $this->status;
    }

    public function getDate() {
      return $this->stock;
    }

    //setters

    public function setId($id) {
      $this->id = $id;
    }

    public function setUserId($userId) {
      $this->userId = $userId;
    }

    public function setLocation($location) {
      $this->location = trim($this->db->real_escape_string($location));
    }

    public function setAddress($address) {
      $this->address = trim($this->db->real_escape_string($address));
    }

    public function setCost($cost) {
      $this-> cost = $cost ;
    }

    public function setStatus($status) {
      $this->status = trim($this->db->real_escape_string($status));
    }


    public function setDate($date) {
      $this->date = $date;
    }

    public function setTime($time) {
      $this->time = $time;
    }



    public function getAll() {

      $orders = $this->db->query("SELECT * FROM orders ORDER BY id DESC");

      return $orders;
    }

    public function getAllByUser() {

      $query = "SELECT * FROM orders"
                ." WHERE user_id = {$this->getUserId()}"
                ." ORDER BY id DESC";
      
      $orders = $this->db->query($query);

      return $orders;

    }

    public function getOne() {
      $order = $this->db->query("SELECT * FROM orders WHERE id = {$this->getId()}");

      return $order->fetch_object();
    }

    public function getOneByUser() {

      $query = "SELECT o.id, o.cost as 'cost' FROM orders o"
                //." INNER JOIN orders_line ol ON ol.order_id = o.id"
                ." WHERE o.user_id = {$this->getUserId()}"
                ." ORDER BY ID DESC LIMIT 1";
      
      $order = $this->db->query($query);

      return $order->fetch_object();

    }

    public function getProductsByOrder($orderId) {
      //$query = "SELECT * FROM products WHERE id"
      //        . " IN  (SELECT product_id FROM orders_line"
      //        . " WHERE order_id = {$orderId})";
      
      $query = "SELECT p.*, ol.units as 'units' FROM products p"
              ." INNER JOIN orders_line ol ON p.id = ol.product_id"
              ." WHERE ol.order_id = {$orderId}";
   
      $products = $this->db->query($query);

      return $products;
    }



    public function save() {

      $query = "INSERT INTO orders VALUES (NULL, {$this->getUserId()}, '{$this->getLocation()}', '{$this->getAddress()}',{$this->getCost()}, 'confirm', CURDATE(), CURTIME())"; 

      $save = $this->db->query($query);



      $result = false;

      if ($save) {
        $result = true;
      }

      return $result;
    }

    public function setLine() {

      //Get id of last insert (order)
      $query = "SELECT LAST_INSERT_ID() AS 'order'";    
      
      $data = $this->db->query($query);

      $orderId = $data->fetch_object()->order;

      //insert line order
      foreach($_SESSION['cart'] as $index => $item){
        $product = $item['product'];

        $query = "INSERT INTO orders_line VALUES(NULL, $orderId, {$product->id}, {$item['units']});";

        $isSaved = $this->db->query($query);

      }

      $result = false;
      if ($isSaved) {
        $result = true;
      }

      return $result;

    }

    public function updateStatus() {

      // query
      $query = "UPDATE orders SET status = '{$this->status}' WHERE id={$this->getId()}";

      $order = $this->db->query($query);

      return $order;
    }

    

    
    
  }