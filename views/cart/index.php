<h1 class="Main__main--title">Carrito de la compra</h1>

<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
  <section class="Cart">

    <figure class="Car__imageContainer">
      <img src="" alt="">
    </figure>

    <a class="Cart__delete" href="<?= BASE_URL . 'cart/delete_all' ?>"> Vaciar carrito </a>
    <div class="Cart__container">

      <table class="Cart__form">
        <thead>
          <tr>
            <th> Imagen </th>
            <th> Nombre </th>
            <th> Precio </th>
            <th> Unidades </th>
            <th> Quitar </th>
          </tr>
        </thead>
        <tbody>

          <?php foreach($cart as $index => $item): ?>
            <?php $product = $item['product'];  ?>

              <tr class="tr-hover">
              
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
                  <a href="<?= BASE_URL . 'product/details&id=' . $product->id ?>" class="resalt--file">
                    <?= $product->name ?>
                  </a>
                </td>
                
                <td>
                  $<?= $product->price ?>
                </td>
              
                <td>
                  <div class="Cart__form--units">
                    <?= $item['units'] ?>
                    <a href="<?= BASE_URL . 'cart/up&index=' . $index ?>"> + </a>
                    <a href="<?= BASE_URL . 'cart/down&index=' . $index ?>"> - </a>
                  </div>
                </td>

                <td class="Cart__form--remove">
                  <a style="color: brown;"class="Cart__delete" href="<?= BASE_URL . 'cart/remove&index=' . $index ?>"> X </a>
                </td>
              
              
              </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

      <!-- total -->
      <?php $stats = Utils::cartStats(); ?>
      <p class="Cart__total"> Precio total: <?= '$ '.$stats['total'] ?> </p>
      
    </div>
    
    <a class="Cart__do-order" href="<?= BASE_URL. 'order/do' ?>">Realizar pedido</a>
    
  </section>
<?php else: ?>

  <p>El carrito está vacio, añade algún producto</p>

<?php endif;  ?>