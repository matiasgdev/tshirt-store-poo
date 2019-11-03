
<?php if (isset($_SESSION['order']) && $_SESSION['order'] == 'success'): ?>

  <div class="Order">
    <h1> Excelente! Pedido exitoso </h1>
    <p>
      Tu pedido ha sido guardado con éxito.
      Una vez que realices la transferencia bancaria a <small>2358881303840139888803491</small>  con el coste
      del pedido. Será procesado y enviado.
    </p>
    <div class="Order__data">

      <h3>Datos del pedido</h3>
      <?php if(isset($orderByUser)):?>
        <ul>
          <li>Numero del pedido: <?= $orderByUser->id ?> </li>
          <li>Total a pagar: $ <?= $orderByUser->cost ?> </li>
        </ul>

  
        <!-- Products of order -->
        <h4>Productos </h4>

        <table class="Cart__form">
          <thead>
            <tr>
              <th> Imagen </th>
              <th> Nombre </th>
              <th> Precio </th>
              <th> Unidades </th>
            </tr>
          </thead>
        <?php while($product = $productsByOrder->fetch_object()): ?>
        
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
                <a href="<?= BASE_URL . 'product/details&id=' . $product->id ?>">
                  <?= $product->name ?>
                </a>
              </td>
              
              <td>
                $<?= $product->price ?>
              </td>
            
              <td>
                <?= $product->units ?>
              </td>
            
            
            </tr>
            
            
            <?php endwhile; ?>
        </table>

      <?php endif; ?>
      
    </div>
  </div>



<?php elseif (isset($_SESSION['order-error'])): ?>

  <h1>No se pudo registrar tu pedido</h1>
  <p>

    <?= $_SESSION['order-error']; ?>

  </p>

<?php endif; ?>