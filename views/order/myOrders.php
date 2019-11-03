<?php if(isset($management)): ?>

<h1 class="Main__main--title">Gestionar pedidos</h1>
<?php else: ?>

<h1 class="Main__main--title">Mis pedidos</h1>

<?php endif; ?>


<?php if($orders->num_rows != 0 && is_object($orders)): ?>
<table class="Cart__form">
  
  <thead>
    <tr>
      <th> Nro. pedido </th>
      <th> Costo </th>
      <th> Fecha </th>
      <th> Estado </th>
    </tr>

  </thead>
  <tbody>
    <?php while($order = $orders->fetch_object()): ?>
      <tr class="tr-hover">
        <td> <a href="<?= BASE_URL . 'order/details&id=' . $order->id ?>" > <?= $order->id ?>  </a>  </td>
        <td> $ <?= $order->cost ?> </td>
        <td> <?= $order->date ?> </td>
        <td> <?= Utils::showStatus($order->status) ?> </td>
      </tr>

    <?php endwhile; ?>

  </tbody>

</table>

<?php else: ?>
  <p>Aún no has realizado ningún pedido.</p>

<?php endif; ?>