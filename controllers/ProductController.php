<?php 
  require_once 'models/productModel.php';
  class productController {

    public function index() {
      /* render view */
      require_once 'views/product/featured.php';
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

          // save
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
}
?>