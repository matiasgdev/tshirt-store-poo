<?php if(isset($productById)): ?>
  
  <h1 class="Main__main--title">   
    <?= $productById->name ?>
  </h1>

  <article class="Product">
    
    <figure class="Product__imageContainer">
      <?php if($productById->image != null): ?>
        <img  class="Product__imageContainer--image"
        src="<?=BASE_URL?>uploads/images/<?= $productById->image ?>" 
        alt="Remera logo">
      <?php else: ?>
        <img class="Product--imageContainer--image"
        src="<?=BASE_URL?>assets/img/remera.png" 
        alt="Remera logo">
      <?php endif; ?>
    </figure>

    <div class="Product__details">

      <span>Nombre</span>
      <p class="Product__details--name">
        <?= $productById->name; ?>
      </p>

      <span>Descripcion</span>
      <p class="Product__details--description">
        <?= $productById->description; ?>
      </p>
      
      <span>Precio: </span>
      <p class="Product__details--price">
         $<?= $productById->price; ?> 
      </p>
      
      <a href="<?= BASE_URL . 'cart/add&id=' . $productById->id?>" class="Main__products--item--link Product__details--buy"> Añadir al carro </a>
      <!-- <a class="Product__details--buy">
         Comprar 
      </a> -->
    </div>
  </article>

<?php else: ?>

  <h1 class="Main__main--title">
    El producto no existe
  </h1>

<?php endif; ?>