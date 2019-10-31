<h1 class="Main__main--title"> Gestionar categorias </h1>

<a class="Main__main--button btn-create" href="<?=BASE_URL ?>category/create">
  Crear categoria
</a>

<table  class="Main__main--table">
  <thead>
    <tr>
      <th class="Main__main--table--idrow"> ID </th>
      <th> Nombre </th>
    </tr> 
  </thead>
  <tbody>
    <?php while($category =  $categories->fetch_object() ): ?>
      <tr>
        <td class="Main__main--table--idrow">
          <?= $category->id ?>
        </td>
        <td>
          <?= $category->name ?>
        </td>
      </tr>
      <?php endwhile; ?>
  </tbody>
</table>

