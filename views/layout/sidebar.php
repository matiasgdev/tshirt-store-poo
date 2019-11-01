<aside class="Main__aside">

  <div class="Main__aside__block login-block">
    <!-- if not logged  -->
    <?php if(!isset($_SESSION['user'])): ?>
    <h2>Login</h2>
    <form action=<?= BASE_URL . 'user/login' ?> method="POST">
      <label for="email"> Email </label>
      <input type="email" name="email" >
      <label for="password"> Password </label>
      <input type="password" name="password" >
      <button> Enviar </button>
    </form>
    <small>¿Aun no tienes cuenta?</small>
    <small><a href="<?= BASE_URL ?>user/register" >Registrate</a></small>
    <!-- if users is logged -->
    <?php else: ?>
      <h4 class="Main__aside--welcome">
        <?= $_SESSION['user']->name ?>
      </h4>
      <span class="Main__aside--logout">
        <a href=<?= BASE_URL . 'user/logout' ?> > Cerrar sesión </a>
      </span>
    <div class="Main__aside__block--links">
      <a href="" class="order-item"> Mis pedidos</a>
    <?php endif; ?>
    
    <div class="Cart">

      <h2 class="Cart__title">Mi carrito de compras</h2>

      <!-- stats of cart -->
      <?php $stats = Utils::cartStats(); ?>
      <ul class="Cart__list">
        <li>Cantidad: <?= $stats['count'].' items' ?> </li>
        <li>Total: <?= '$  '.$stats['total'] ?> </li>
      </ul>
      <a href="<?= BASE_URL ?>cart/index" >
        Ver carrito 
      </a>

    </div>

      <!-- if admin -->
      <?php if (isset($_SESSION['admin'])): ?>
        <h4 class="admin">Panel admin</h4>
        <a href="">> Gestionar pedidos</a>
        <a href="<?= BASE_URL ?>product/management">> Gestionar productos</a>
        <a href="<?= BASE_URL ?>category/index">> Gestionar categorias</a>
      <?php endif; ?>

    </div>
</aside>
<section class="Main__main">