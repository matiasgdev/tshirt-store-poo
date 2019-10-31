<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Tienda de Remeras </title>
  <!-- CSS CUSTOM -->
  <link rel="stylesheet" href="<?=BASE_URL?>assets/css/bundle.css" />
</head>
<body>
  <!-- HEADER -->
  <header class="Header">
    <div class="container">
      <div class="Header__hero">
        <a  class="Header__hero--title" href="">
          <h1>amazing offers!</h1>
        </a>
      </div>
    </div>
  </header>
  <!-- MENU -->
  <nav class="Nav">
    <div class="container">
      <ul class="Nav__list">
        <li class="Nav__list--link link-actually">
          <a href="<?= BASE_URL ?>"> Inicio </a>
        </li>

        <?php $categoreis =  Utils::showCategories(); ?>
        <?php while($category = $categoreis->fetch_object()): ?>
          <li class="Nav__list--link">
            <a href=""> <?= $category->name; ?> </a>
          </li>
        <?php endwhile; ?>
        
      </ul>
    </div>
  </nav>
  
<main class="Main">
  <div class="container">