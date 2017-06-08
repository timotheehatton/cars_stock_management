<?php
  session_start();
  include 'config.php';

  $queryP = $pdo->query('SELECT * FROM cars');
  $cars =  $queryP->fetchAll();

?><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title>Stock management</title>
  <meta name="description" content="Un outil de gestion des stock">
  <link rel="stylesheet" href="./assets/stylesheet/reset.css">
  <link rel="stylesheet" href="./assets/fonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/stylesheet/main.css">
</head>
<body>
  <header class="sidebar">
    <h1 class="sidebar--title">Cars Stock Management</h1>
    <a href="cars.php" class="sidebar--link sidebar--link--active">
      Véhicule
      <span class="sidebar--link--description">
        Affiché les véhicules en stock
      </span>
    </a>
    <a href="stock.php" class="sidebar--link">
      Stock
      <span class="sidebar--link--description">
        Ajouté et modifié les véhicules du stocks
      </span>
    </a>
    <a href="#" class="sidebar--link">
      Statistiques
      <span class="sidebar--link--description">
        Affiché les statistique du stock
      </span>
    </a>
    <a href="#" class="sidebar--link">
      Configuration
      <span class="sidebar--link--description">
        Paramétré stock management
      </span>
    </a>
  </header>
  <div class="content">
    <div class="content--product">
      <?php
        foreach($cars as $_car):
      ?>
      <div class="content--product--item">
        <img src="./assets/img/<?= $_car->img ?>" alt="" class="content--product--item--img">
        <p class="content--product--item--content">
          <span class="content--product--item--content--brand"><?= $_car->brand ?></span>
          <span class="content--product--item--content--model"><?= $_car->model ?></span>
          <span class="content--product--item--content--description"><?= $_car->description ?></span>
          <span class="content--product--item--content--year">Année : <?= $_car->year ?></span>
          <span class="content--product--item--content--distance">Kilométrage : <?= $_car->distance ?>Km</span>
          <span class="content--product--item--content--price"><?= $_car->price ?> €</span>
        </p>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <script src="./assets/javascript/bundle.js"></script>
</body>
</html>
