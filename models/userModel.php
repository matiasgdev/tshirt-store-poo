<?php 

  class User {
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $rol;
    public $avatar;

    public $db;

    public function __construct() {
      $this->db = Database::connect();
    }

    // getters
    function getId() {
      return $this->id;
    }
  
    function getName() {
      return $this->name;
    }
    function getLastname() {
      return $this->lastname;
    }
    function getEmail() {
      return $this->email;
    }
    function getPassword() {
      return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    function getRol() {
      return $this->rol;
    }
    function getAvatar() {
      return $this->avatar;
    }
    // setters
    function setId($id) {
      $this->id = $id;
    } 
    
    function setName($name) {
      $this->name = $this->db->real_escape_string($name);
    } 
    function setLastname($lastname) {
      $this->lastname = $this->db->real_escape_string($lastname);
    } 
    function setEmail($email) {
      $this->email = $this->db->real_escape_string($email);
    } 
    function setPassword($password) {
      $this->password = $password;
    } 
    function setRol($rol) {
      $this->rol = $rol;
    } 
    function setAvatar($avatar) {
      $this->avatar = $avatar;
    }

    // others method

    public function save() {

      $query = "INSERT INTO users 
            VALUES (NULL, '{$this->getName()}', '{$this->getLastname()}', 
            '{$this->getEmail()}', '{$this->getPassword()}', 'user', NULL);"; 

      $save = $this->db->query($query);

      $result = false;

      if ($save) {
        $result = true;
      }

      return $result;
    }

    public function login($email, $password) {
      // verify data
      $query = "SELECT * FROM users WHERE email = '$email'";

      $login = $this->db->query($query);

      $result = false;

      if ($login && $login->num_rows == 1) {
        $user = $login->fetch_object();
      
        // verify password
        if (password_verify($password, $user->password)) {
          $result = $user;
        } else {
          $result = false;
        }
      }

      return $result;

    }
  }