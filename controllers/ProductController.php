<?php 
  require_once 'models/productModel.php';
  class productController {

    public function index() {
      /* render view */
      $product = new Product();

      $products = $product->getRandom(6);

      require_once 'views/product/featured.php';
    }

    public function details() {

      if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $product = new Product();
        $product->setId($id);
        
        $productById = $product->getOne();


        require_once 'views/product/details.php';
      }
    }


    public function management() {

      Utils::isAdmin();

      $product = new Product();

      $products = $product->getAll();

      require_once 'views/product/management.php';
    }

    public function create() {

      Utils::isAdmin();

      require_once 'views/product/create.php';

    }

    public function save() {
      Utils::isAdmin();

      if (isset($_POST)) {
        $_SESSION['product-error'] = '';
        
        $category = isset($_POST['category']) ? $_POST['category'] : false;
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $description = isset($_POST['description']) ? $_POST['description'] : false;
        $price = isset($_POST['price']) ? $_POST['price'] : false;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
        

        if ($name and $description and $price and $stock and $category) {

          $product = new Product();

          
          $product->setCategoryId($category);
          $product->setName($name);
          $product->setDescription($description);
          $product->setPrice($price);
          $product->setStock($stock);
          //upload image

          if (isset($_FILES['image']) && $_FILES['image']['name'] != ''){
            $image = $_FILES['image'];
            $imageName = $image['name'];
            $mimeType = $image['type'];

            //extension file
            $searchExtensionImage = str_split($imageName, strpos($imageName, '.') + 1);
            $extensionImage = $searchExtensionImage[1];

            //new image name
            $imageNameHashed = md5($imageName) . '.' .$extensionImage;


            if ($mimeType == 'image/jpg' || 
                $mimeType == 'image/jpeg' || 
                $mimeType == 'image/png' || 
                $mimeType == 'image/gif') {

              // if directory not exists
              if (!is_dir('uploads/images')) {
                mkdir('uploads/images', 0777, true);
              }
              // save image
              move_uploaded_file($image['tmp_name'], 'uploads/images/'.$imageNameHashed);
              //set image to object
              $product->setImage($imageNameHashed);

            } else {
              $_SESSION['product-error'] = 'Inserción fallida. No se puede ingresar ese tipo de archivo.';
              header("Location:". BASE_URL . 'product/create' );
              return;
            } 

          } 
          
          // save or update
          
          $productIsSaved = $product->save();


          if ($productIsSaved) {
            $_SESSION['product'] = true;
            require_once 'views/product/create.php';
          } else {
            $_SESSION['product-error'] = 'Inserción fallida. No se pudo ingresar este producto.';
            header("Location:". BASE_URL . 'product/create' );
            return;
          }

        } else {
          $_SESSION['product-error'] = 'Inserción fallida. Ingrese todos los datos.';
          header("Location:". BASE_URL . 'product/create' );
          return;
        }

      header("Refresh: 2, URL=". BASE_URL . 'product/management' );

      }
    }

    public function update() {
      Utils::isAdmin();

      if (isset($_POST) && isset($_GET['id'])) {
        $_SESSION['product-error'] = '';
        
        $category = isset($_POST['category']) ? $_POST['category'] : false;
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $description = isset($_POST['description']) ? $_POST['description'] : false;
        $price = isset($_POST['price']) ? $_POST['price'] : false;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
        // id get
        $id = isset($_GET['id']) ? $_GET['id'] : false;        

        if ($name and $description and $price and $stock and $category) {

          $product = new Product();

          
          $product->setCategoryId($category);
          $product->setName($name);
          $product->setDescription($description);
          $product->setPrice($price);
          $product->setStock($stock);
          $product->setId($id);
          //upload image

          if (isset($_FILES['image']) && $_FILES['image']['name'] != ''){

            $image = $_FILES['image'];
            $imageName = $image['name'];
            $mimeType = $image['type'];

            //extension file
            $searchExtensionImage = str_split($imageName, strpos($imageName, '.') + 1);
            $extensionImage = $searchExtensionImage[1];

            //new image name
            $imageNameHashed = md5($imageName) . '.' .$extensionImage;


            if ($mimeType == 'image/jpg' || 
                $mimeType == 'image/jpeg' || 
                $mimeType == 'image/png' || 
                $mimeType == 'image/gif') {

              // if directory not exists
              if (!is_dir('uploads/images')) {
                mkdir('uploads/images', 0777, true);
              }
              // save image
              move_uploaded_file($image['tmp_name'], 'uploads/images/'.$imageNameHashed);
              //set image to object
              $product->setImage($imageNameHashed);

            } else {
              $_SESSION['product-error'] = 'Inserción fallida. No se puede ingresar ese tipo de archivo.';
              header("Location:". BASE_URL . 'product/edit&id='.$id );
              return;
            } 

          }
          // update
          
          $productIsSaved = $product->update();


          if ($productIsSaved) {
            $_SESSION['product'] = true;
            require_once 'views/product/create.php';
          } else {
            $_SESSION['product-error'] = 'Actualizacion fallida. No se pudo ingresar este producto.';
            header("Location:". BASE_URL . 'product/edit&id='.$id );
            return;
          }

        } else {
          $_SESSION['product-error'] = 'Actualizacion fallida. Ingrese todos los datos.';
          header("Location:". BASE_URL . 'product/edit&id='.$id );
          return;
        }

      header("Location:". BASE_URL . 'product/management' );
    }
  }
    public function edit() {
      Utils::isAdmin();

      if (isset($_GET['id'])) {
        $edit = true;

        $id = $_GET['id'];

        $product = new Product();
        $product->setId($id);

        $productById = $product->getOne();


        require_once 'views/product/create.php';
      }
    }

    
    public function delete() {

      Utils::isAdmin();

      if (isset($_GET['id'])) {
        $product = new Product();

        $id = $_GET['id'];
    
        $product->setId($id);

        $wasDeleted = $product->delete();

        if ($wasDeleted) {
          $_SESSION['product'] = 'Producto borrado correctamente';
        } else {
          $_SESSION['product-error'] = 'Error al borrar el producto';
        }

      } else {
        $_SESSION['product-error'] = 'Error al borrar el producto';
      }

      header("Location:". BASE_URL . 'product/management');
      
    }
}
?>