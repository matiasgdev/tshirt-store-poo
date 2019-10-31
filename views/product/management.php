<h1 class="Main__main--title"> Gestionar productos </h1>

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
      </tr>
      <?php endwhile; ?>
  </tbody>
</table>