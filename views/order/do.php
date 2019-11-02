
<?php if (isset($_SESSION['user'])): ?>

  <h1 class="Main__main--title">Hacer pedido</h1>

  <br/>
  <a href="<?= BASE_URL. 'cart/index'?>"> Ver el carrito de compras </a>

  <div class="Do">

    <form class="Do__form" action="<?= BASE_URL . 'order/add'?>" method="POST">
    
      <h3 class="Do__title"> Ingresar direccion para el envio </h3>
      <label for="location">Locacion</label>
      <br/>
      <input type="text" name="location" required>
      <br/>

      <label for="address">Direccion</label>
      <br/>
      <input type="text" name="address" required>
      <br/>

      <button> Enviar </button>

    </form>

  </div>

<?php else: ?>

  <p class="Main__main--title">
    Necesitas estar identificado para poder acceder
  </p>
  <p>
    Por favor, inicia sesión o 
    <a style="color: #39869e;
    text-decoration: underline;" href="<?= BASE_URL . 'user/register' ?>" > 
    Registrate 
    </a>
  </p>

<?php endif; ?>