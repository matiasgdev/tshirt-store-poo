<h1 class="Main__main--title"> Crear nuevos productos </h1>


<!-- insert messages validators -->
<?php  if (isset($_SESSION['product'])): ?>

  <span> Producto creado con éxito </span>

<?php elseif(isset($_SESSION['product-error'])): ?>

  <span> <?= $_SESSION['product-error']; ?> </span>

<?php endif; ?>

<form 
  action="<?= BASE_URL ?>product/save"
  method="POST"
  enctype="multipart/form-data"
>
  <label for="name"> Nombre </label> <br/>
  <input type="text" name="name" autocomplete="off" > <br/>

  <label for="description"> Descripcion </label> <br/>
  <textarea name="description"></textarea> <br/>

  <label for="price"> Precio </label> <br/>
  <input type="text" name="price" > <br/>

  <label for="stock"> Stock </label> <br/>
  <input type="number" name="stock" > <br/>

  <label for="category"> Category </label> <br/>
  <select name="category">

    <?php $categories = Utils::showCategories() ?>

    <?php while($category = $categories->fetch_object()): ?>
      <option value="<?=$category->id?>"> <?= $category->name ?> </option>
    <?php endwhile; ?>

  </select>
  <label for="image"> Imagen </label> <br/>
  <input type="file" name="image"> <br/>

  <button> Cargar </button>

</form>

<!-- delete messages -->
<?php Utils::deleteSession('product'); ?>
<?php Utils::deleteSession('product-error'); ?>