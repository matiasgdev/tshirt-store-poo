<h1 class="Main__main--title">Algunos de nuestros productos</h1>
<div class="Main__products">
  
  <?php while($product = $products->fetch_object()): ?>

  <article class="Main__products--item">

    <a class="Main__products--item--details" 
      href="<?= BASE_URL .'product/details&id=' . $product->id;?>" 
    >
      Ver detalles
    </a>
    
    <h2 class="Main__products--item--title">  <?= $product->name; ?>  </h2>

    
    <?php if($product->image != null): ?>
      <img width="150px"src="<?=BASE_URL?>uploads/images/<?= $product->image ?>" alt="Remera logo">
    <?php else: ?>
      <img width="150px"src="<?=BASE_URL?>assets/img/remera.png" alt="Remera logo">
    <?php endif; ?>


    <p class="Main__products--item--price"> $<?= $product->price; ?> </p>

    <a href="<?= BASE_URL . 'cart/add&id=' . $product->id?>" class="Main__products--item--link"> Añadir al carro </a>

  </article>
  <?php endwhile; ?>


</div>