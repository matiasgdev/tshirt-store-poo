<h1 class="Main__main--title"> Gestionar productos </h1>

<!-- messages -->
<?php  if (isset($_SESSION['product'])): ?>

  <span style="display: block"> <?=$_SESSION['product']?> </span>

<?php elseif(isset($_SESSION['product-error'])): ?>

  <span style="display: block"> <?= $_SESSION['product-error']; ?> </span>

<?php endif; ?>

<a class="Main__main--button btn-create" href="<?=BASE_URL ?>product/create">
  Crear productos
</a>


<table  class="Main__main--table">
  <thead>
    <tr>
      <th class="Main__main--table--idrow"> ID </th>
      <th> Nombre </th>
      <th> Precio </th>
      <th> Stock </th>
      <th> Acciones </th>
    </tr> 
  </thead>
  <tbody>
    <?php while($product =  $products->fetch_object() ): ?>
      <tr>
        <td class="Main__main--table--idrow">
          <?= $product->id ?>
        </td>
        <td>
          <?= $product->name ?>
        </td>
        <td>
          $<?= $product->price ?>
        </td>
        <td>
          <?= $product->stock ?>
        </td>
        <td>
          <a href="<?= BASE_URL ?>product/delete&id=<?= $product->id ?>" style="color: brown" > 
            Elim. 
          </a> /  
          <a href="<?= BASE_URL ?>product/edit&id=<?= $product->id ?>" style="color: green">
            Edit. 
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
  </tbody>
</table>

<?php Utils::deleteSession('product') ?>
<?php Utils::deleteSession('product-error')?>