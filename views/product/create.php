
<?php if(isset($edit) && isset($productById) && is_object($productById)): ?>
  <h1 class="Main__main--title"> Editar <?= $productById->name; ?> </h1>
  <?php $UrlAction = BASE_URL . "product/update&id=$productById->id" ?>
  <?php else: ?>
  <h1 class="Main__main--title"> Crear nuevos productos </h1>
  <?php $UrlAction = BASE_URL . 'product/save' ?>
<?php endif; ?>


<!-- insert messages validators -->
<?php  if (isset($_SESSION['product'])): ?>

  <span> Producto creado con éxito </span>

<?php elseif(isset($_SESSION['product-error'])): ?>

  <span> <?= $_SESSION['product-error']; ?> </span>

<?php endif; ?>

<form 
  action="<?= $UrlAction ?>"
  method="POST"
  enctype="multipart/form-data"
>
  <label for="name"> Nombre </label> <br/>
  <input type="text" name="name" autocomplete="off" autofocus="autofocus" 
    value="<?= (isset($productById) && is_object($productById)) ? $productById->name : '' ?>" 
  > <br/>

  <label for="description"> Descripcion </label> <br/>
  <textarea name="description"> 
    <?= (isset($productById) && is_object($productById)) ? trim($productById->description) : '' ?>
  </textarea> <br/>

  <label for="price"> Precio </label> <br/>
  <input type="text" name="price" 
    value="<?= (isset($productById) && is_object($productById)) ? $productById->price : '' ?>" 
  > <br/>

  <label for="stock"> Stock </label> <br/>
  <input type="number" name="stock"
  value="<?= (isset($productById) && is_object($productById)) ? $productById->stock : '' ?>" 
  > <br/>

  <label for="category"> Category </label> <br/>
  <select name="category">
    <?php $categories = Utils::showCategories() ?>

    <?php while($category = $categories->fetch_object()): ?>

      <option
      value="<?= $category->id ?>"
      <?= ( isset($productById) && is_object($productById) && $category->id == $productById->category_id ) ? 'selected' : ''; ?>
      > 
        <?= $category->name ?> 

      </option>

    <?php endwhile; ?>

  </select>
  <br/>
  
  <label for="image"> Imagen </label> <br/>
  <!-- load image -->
  <?php if (isset($productById) && is_object($productById) && !empty($productById->image)): ?>

    <img src="<?=BASE_URL . 'uploads/images/' . $productById->image ?>" alt="Imagen producto" width="150px" >

    <br/>

  <?php endif; ?>

  <input type="file" name="image"> <br/>

  <button> Cargar </button>

</form>

<!-- delete messages -->
<?php Utils::deleteSession('product'); ?>
<?php Utils::deleteSession('product-error'); ?>