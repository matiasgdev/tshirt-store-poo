<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Tienda de Remeras </title>
  <!-- CSS CUSTOM -->
  <link rel="stylesheet" href="assets/css/bundle.css" />
</head>
<body>
  <!-- HEADER -->
  <header class="Header">
    <div class="container">
      <div class="Header__hero">
       <img width="200px" class="Header__hero--img" src="assets/img/remera.png" alt="Remera Logo">
       <a class="Header__hero--title" href="">
         <h1>Tienda</h1>
       </a>
      </div>
    </div>
  </header>

  <!-- MENU -->
  <nav class="Nav">
    <ul class="Nav__list">
      <li class="Nav__list--link">
        <a href=""> Inicio </a>
      </li>
      <li class="Nav__list--link">
        <a href=""> Categoria 1 </a>
      </li>
      <li class="Nav__list--link">
        <a href=""> Categoria 2 </a>
      </li>
      <li class="Nav__list--link">
        <a href=""> Categoria 3 </a>
      </li>
    </ul>
  </nav>
  
  <!-- MAIN CONTENT -->
  <main class="Main">
    <!-- SIDEBAR -->
    <aside class="Main__aside">
      <div class="Main__aside__block login-block">
        <form action="" method="POST">
          <label for="email"> Email </label>
          <input type="email" name="email" >
          <label for="password"> Password </label>
          <input type="password" name="password" >
          <button> Enviar </button>
        </form>
        <div class="Main__aside__block--links">
          <a href="">Mis pedidos</a>
          <a href="">Gestionar pedidos</a>
          <a href="">Gestionar categorias</a>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <section class="Main__main">
        <div class="Main__products">

          <article class="Main__products--item">
            <img width="100px"src="assets/img/remera.png" alt="Remera logo">
            <h2 class="Main__products--title">Remera azul</h2>
            <p class="Main__products--price"> 30 Dolares </p>
            <a class="Main__products--link"> Comprar </a>
          </article>

          <article class="Main__products--item">
          <img width="100px"src="assets/img/remera.png" alt="Remera logo">
            <h2 class="Main__products--title">Remera azul</h2>
            <p class="Main__products--price"> 30 Dolares </p>
            <a class="Main__products--link"> Comprar </a>
          </article>

          <article class="Main__products--item">
          <img width="100px"src="assets/img/remera.png" alt="Remera logo">
            <h2 class="Main__products--title">Remera azul</h2>
            <p class="Main__products--price"> 30 Dolares </p>
            <a class="Main__products--link"> Comprar </a>
          </article>

        </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="Footer" >
    <p> Desarrollado por Matías Navarro &copy; <?= date('Y'); ?>  </p>
  </footer>

</body>
</html>
    

  