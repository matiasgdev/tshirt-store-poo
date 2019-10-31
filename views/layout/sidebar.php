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
      <h3 class="Main__aside--welcome">
        Bienvenido <?= $_SESSION['user']->name ?>
      </h3>
      <span class="Main__aside--logout">
        <a href=<?= BASE_URL . 'user/logout' ?> > Cerrar sesión </a>
      </span>
    <div class="Main__aside__block--links">
      <a href="">Mis pedidos</a>
    <?php endif; ?>

      <!-- if admin -->
      <?php if (isset($_SESSION['admin'])): ?>
        <a href="">Gestionar pedidos</a>
        <a href="<?= BASE_URL ?>product/management">Gestionar productos</a>
        <a href="">Gestionar categorias</a>
      <?php endif; ?>

    </div>
</aside>
<section class="Main__main">