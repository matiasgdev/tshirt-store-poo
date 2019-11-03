<h1 class="Main__main--title">
  Detalles del pedido nro. <?= $order->id ?>
</h1>

<div class="Order__data">

<?php if(isset($order)):?>

  <?php if(isset($_SESSION['admin'])): ?>

    <div class="Order__data__management">

      <span>Cambiar estado del pedido</span>

      <form  action="<?=  BASE_URL . 'order/status'?>" method="POST">

        <input type="hidden" value="<?=$order->id ?>" name="orderId">

        <select name="status">
          <option value="confirm" <?= $order->status == "confirm" ? 'selected' : '' ?> > Pendiente </option>
          <option value="preparation" <?= $order->status == "preparation" ? 'selected' : '' ?> > En preparación </option>
          <option value="ready" <?= $order->status == "ready" ? 'selected' : '' ?> > Listo para enviar </option>
          <option value="sended" <?= $order->status == "sended" ? 'selected' : '' ?> > Enviado </option>
        </select>

        <button> Actualizar </button>

      </form>

    </div>

  <?php endif;?>

  <br/>

  <h4>Datos del pedido</h4>
  <ul>
    <li>Total a pagar: $ <?= $order->cost ?> </li>
    <li> Estado: <?= Utils::showStatus($order->status) ?> </li>
  </ul>

  <br/>

  <h4>
    Datos del envio: 
  </h4>
  <ul>
    <li> Localidad: <?= $order->location ?> </li>
    <li> Direccion: <?= $order->address ?> </li>
  </ul>

  <br/>
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