<?php
  session_start();
  include 'config.php';


  if (   empty($_POST['brand'])
      && empty($_POST['model'])
      && empty($_POST['description'])
      && empty($_POST['year'])
      && empty($_POST['distance'])
      && empty($_POST['price']))
  {
    array_push($_SESSION['add_error'], 'Aucune données renseigner');
    // Default values
    $_POST['brand']       = '';
    $_POST['model']       = '';
    $_POST['description'] = '';
    $_POST['year']        = '';
    $_POST['distance']    = '';
    $_POST['price']       = '';
  }

  // No data sent
  else
  {
    // Retrieve data
    $brand        = trim($_POST['brand']);
    $model        = trim($_POST['model']);
    $description  = trim($_POST['description']);
    $year         = (int)$_POST['year'];
    $distance     = (int)$_POST['distance'];
    $price        = (int)$_POST['price'];

    // Brand error
    if(empty($brand))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner la marque du vehicule");

    // Model error
    if(empty($model))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner la model du vehicule");

    // Description error
    if(empty($description))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner la descritpion du vehicule");

    // Year error
    if(empty($year))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner l'année du vehicule");

    // Distance error
    if(empty($distance))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner le kilometrage du vehicule");
    else if($distance < 0)
        array_push($_SESSION['add_error'], "Veuillez saisir un kilometrage valide");

    // Price error
    if(empty($price))
        array_push($_SESSION['add_error'], "Vous n'avez pas renseigner le prix du vehicule");
    else if($price < 0)
        array_push($_SESSION['add_error'], "Veuillez saisir un prix valide");

    // No errors
    if(empty($_SESSION['add_error']))
    {
      $prepare = $pdo->prepare('UPDATE cars SET brand = :brand, model = :model, distance = :distance, description = :description, year = :year, price = :price WHERE id = "'.$_POST['id'].'"');

      $prepare->bindValue('brand', $brand);
      $prepare->bindValue('model', $model);
      $prepare->bindValue('description', $description);
      $prepare->bindValue('year', $year);
      $prepare->bindValue('distance', $distance);
      $prepare->bindValue('price', $price);

      $prepare->execute();

      array_unshift($_SESSION['log'], 'Le vehicule à bien était modifié');

       // Reset values
       $_POST['img']         = '';
       $_POST['brand']       = '';
       $_POST['model']       = '';
       $_POST['description'] = '';
       $_POST['year']        = '';
       $_POST['distance']    = '';
       $_POST['price']       = '';

    }
  }

  header('Location: http://localhost:8888/stock_php/dist/stock.php');
  exit();
