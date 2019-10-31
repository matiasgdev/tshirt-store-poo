<?php 

  require_once 'models/userModel.php';

  class userController {
    public function index() {
      echo "Controller user, action index";
    }

    public function register() {
      require_once 'views/user/register.php';
    }

    public function save() {

      if (isset($_POST)) {

        // verify data
        $name =  isset($_POST['name']) ? $_POST['name'] : false;
        $lastname =  isset($_POST['lastname']) ? $_POST['lastname'] : false;
        $email =  isset($_POST['email']) ? $_POST['email'] : false;
        $password =  isset($_POST['password']) ? $_POST['password'] : false;

        if ($name && $lastname && $email && $password) {
          $user = new User();

          // set data
          $user->setName($name);
          $user->setLastname($lastname);
          $user->setEmail($email);
          $user->setPassword($password);

          // save user
          $isSave = $user->save();

          if ($isSave) {
            $_SESSION['register'] = 'completed';
          } else {
            $_SESSION['register'] = 'failed';
          }
        } 
        else {
          $_SESSION['register'] = 'failed';
        }

        header('Location: ' . BASE_URL . 'user/register');
      }
    }

    public function login() {
      if (isset($_POST)) {
        $_SESSION['login-error'] = '';

        $email =  isset($_POST['email']) ? $_POST['email'] : false;
        $password =  isset($_POST['password']) ? $_POST['password'] : false;


        if ($email && $password) {
          $user = new User();

          $user->setPassword($password);

          // Db query
          $userData = $user->login($email, $password);
          
          if (is_object($userData)) {
            // Create session
            $_SESSION['user'] = $userData;

            if ($userData->rol == 'admin')  {
              $_SESSION['admin'] = true;
            }

          } else {
            $_SESSION['login-error'] = 'Identificación fallida. No se encontraron datos del usuario.';
          }
        } else {
          $_SESSION['login-error'] = 'Identificación fallida. Ingrese los datos necesarios';
        }
        
      }
      header("Location:".BASE_URL);
    }

    public function logout() {
      if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
      }

      if (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
      }

      header("Location: ". BASE_URL);

    }
  }
?>