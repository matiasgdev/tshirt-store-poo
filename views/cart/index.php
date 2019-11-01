<h1 class="Main__main--title">Carrito de la compra</h1>

<section class="Cart">

  <figure class="Car__imageContainer">
    <img src="" alt="">
  </figure>

  <div class="Cart__container">

    <table>
      <thead>
        <tr>
          <th> Imagen </th>
          <th> Nombre </th>
          <th> Precio </th>
          <th> Unidades </th>
        </tr>
      </thead>
      <tbody>

        <?php foreach($cart as $index => $item): ?>
          <?php $product = $item['product'];  ?>

          <tr>

            <td> <!-- Image -->
              <?php if($product->image != null): ?>
                <img
                src="<?=BASE_URL?>uploads/images/<?= $product->image ?>" 
                alt="Remera logo"
                height="50px"
                >
              <?php else: ?>
                <img
                src="<?=BASE_URL?>assets/img/remera.png" 
                alt="Remera logo"
                height="50px"
                >
              <?php endif; ?> 
            </td>

            <td>
              <?= $product->name ?>
            </td>
            
            <td>
              $<?= $product->price ?>
            </td>

            <td>
              <?= $item['units'] ?>
            </td>


          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>

    <!-- total -->
    <?php $stats = Utils::cartStats(); ?>
    <p class="Cart__total"> Precio total: <?= '$ '.$stats['total'] ?> </p>
    
  </div>
  
<a href="<?= BASE_URL. 'order/do' ?>">Hacer pedido</a>

</section>