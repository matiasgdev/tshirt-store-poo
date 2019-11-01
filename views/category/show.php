<?php if(isset($category)): ?>

  <h1 class="Main__main--title">   
    <?= $category->name ?>
  </h1>

    <?php if($products->num_rows == 0): ?>
      <p>No hay productos para mostrar</p>
    <?php else: ?>
      <div  class="Main__products">

          <?php while($product = $products->fetch_object()): ?>

            <article class="Main__products--item">

              <h2 class="Main__products--item--title">  <?= $product->name; ?>  </h2>
              <a class="Main__products--item--details" 
                href="<?= BASE_URL .'product/details&id=' . $product->id;?>" 
              >
                Ver detalles
              </a>
              
              <?php if($product->image != null): ?>
                <img width="150px"src="<?=BASE_URL?>uploads/images/<?= $product->image ?>" alt="Remera logo">
              <?php else: ?>
                <img width="150px"src="<?=BASE_URL?>assets/img/remera.png" alt="Remera logo">
              <?php endif; ?>


              <p class="Main__products--item--price"> $<?= $product->price; ?> </p>

              <a class="Main__products--item--link"> Comprar </a>

            </article>

        <?php endwhile; ?>
      
      </div>
    <?php endif; ?>

  </h1>

<?php else: ?>

  <h1 class="Main__main--title">
    La categoria no existe
  </h1>

<?php endif; ?>