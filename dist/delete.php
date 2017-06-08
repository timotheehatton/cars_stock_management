<?php
  session_start();
  include 'config.php';

if (!empty($_POST['id'])) {
  $queryD = $pdo->query('DELETE FROM cars WHERE id = "'.$_POST['id'].'"');

  array_unshift($_SESSION['log'], 'Le vehicule à bien était supprimer du stock');

  header('Location: http://localhost:8888/stock_php/dist/stock.php');
  exit();
}
else {
 echo "error";
}
