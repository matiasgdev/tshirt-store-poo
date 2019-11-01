<h1 class="Main__main--title"> Crear categorias </h1>

<?php  if (isset($_SESSION['category-creation'])): ?>

  <span> Categoria creada con éxito </span>

<?php elseif(isset($_SESSION['category-error'])): ?>

  <span> Error al crear la categoría </span>
  
<?php endif; ?>

<form 
  action="<?= BASE_URL ?>category/save"
  method="POST"
>
  <label for="name"> Nombre </label>
  <br/>
  <input type="text" name="name" autofocus>

  <button> Guardar </button>

</form>

<?php Utils::deleteSession('category-creation') ?>
