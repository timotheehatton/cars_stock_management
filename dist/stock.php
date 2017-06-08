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
    <a href="cars.php" class="sidebar--link">
      Véhicule
      <span class="sidebar--link--description">
        Affiché les véhicules en stock
      </span>
    </a>
    <a href="stock.php" class="sidebar--link sidebar--link--active">
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
      <?php if (!empty($_SESSION['add_error']))
      {
        echo '<div class="alert--errors alert"><a class="alert--btn--errors alert--btn" href="#">&times</a>';
        foreach($_SESSION['add_error'] as $_error): ?>
          <span><strong>Erreur</strong> <?= $_error ?></span><br>
        <?php endforeach;
        echo '</div>';
      }
      $_SESSION['add_error'] = []; ?>
      <?php if (!empty($_SESSION['log']))
      {
        echo '<div class="alert--success alert"><a class="alert--btn--success alert--btn" href="#">&times</a>';
        foreach($_SESSION['log'] as $_error): ?>
          <span><strong>Succes</strong> <?= $_error ?></span><br>
        <?php endforeach;
        echo '</div>';
      }
      $_SESSION['log'] = []; ?>
    <div class="content--stock">
      <?php
        foreach($cars as $_car):
      ?>
      <div class="content--stock--item">
        <img class="content--stock--item--img" src="./assets/img/<?= $_car->img ?>"/>
        <form class="content--stock--item--form" action="modification.php" method="post">
          <label class="content--stock--item--form--label">Brand
            <input class="content--stock--item--form--input" type="text" name="brand" value="<?= $_car->brand ?>">
          </label>
          <label class="content--stock--item--form--label">Model
            <input class="content--stock--item--form--input" type="text" name="model" value="<?= $_car->model ?>">
          </label>
          <label class="content--stock--item--form--label">Description
            <input class="content--stock--item--form--input" type="text" name="description" value="<?= $_car->description ?>">
          </label>
          <label class="content--stock--item--form--label">Year
            <input class="content--stock--item--form--input" type="text" name="year" value="<?= $_car->year ?>">
          </label>
          <label class="content--stock--item--form--label">Kilométrage
            <input class="content--stock--item--form--input" type="text" name="distance" value="<?= $_car->distance ?>">
          </label>
          <label class="content--stock--item--form--label">Price
            <input class="content--stock--item--form--input" type="text" name="price" value="<?= $_car->price ?>">
          </label>
          <input type="hidden" name="id" value="<?= $_car->id ?>">
          <input class="content--stock--item--form--btn content--stock--item--form--btn--validate" type="submit" name="validate" value="validate">
        </form>
        <form class="content--stock--item--delete" action="delete.php" method="post">
          <input type="hidden" name="id" value="<?= $_car->id ?>">
          <button class="content--stock--item--delete--btn" type="submit" name="delete">&times<button/>
        </form>
      </div>
      <?php endforeach;?>
    </div>
    <div class="content--add">
      <a href="#" class="content--add--btn">Ajouter un véhicule</a>
      <form class="content--add--form" action="add.php" method="post" enctype="multipart/form-data">
        <label class="content--add--form--file">
          <img class="content--add--form--file--img" id="image" src="./assets/img/car-placeholder.png" id="image"/>
          <input id="files"class="input--file" id="files" type="file" name="img">
        </label>
        <div class="content--add--form--txt">
          <label class="content--add--form--label">Brand
            <input class="content--add--form--input" type="text" name="brand" value="">
          </label>
          <label class="content--add--form--label">Model
            <input class="content--add--form--input" type="text" name="model" value="">
          </label>
          <label class="content--add--form--label">Description
            <input class="content--add--form--input" type="text" name="description" value="">
          </label>
        </div>
        <div class="content--add--form--number">
          <label class="content--add--form--label">Year
            <input class="content--add--form--input" type="text" name="year" value="">
          </label>
          <label class="content--add--form--label">Kilométrage
            <input class="content--add--form--input" type="text" name="distance" value="">
          </label>
          <label class="content--add--form--label">Price
            <input class="content--add--form--input" type="text" name="price" value="">
          </label>
        </div>
        <button class="content--add--form--btn" type="submit" name="validate">validate</button>
      </form>
    </div>
  </div>
  <script src="./assets/javascript/bundle.js"></script>
</body>
</html>
