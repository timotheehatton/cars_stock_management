<?php
  session_start();
  include 'config.php';

  $error_messages = [];

  $queryP = $pdo->query('SELECT * FROM users');
  $users =  $queryP->fetchAll();

	if(!empty($_POST))
	{
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);
		$password_hash = md5($password);

		if(empty($login))
			$error_messages['login'] = 'Veuillez entrer votre login';

		if(empty($password))
			$error_messages['password'] = 'Veuillez entrer votre mot de passe';

		if(empty($error_messages))
		{
      $query = $pdo->query('SELECT COUNT(*) FROM users WHERE login="'.$login.'" AND password="'.$password_hash.'" ');
      $login_val = $query->fetchColumn();

      if($login_val > 0 )
      {
        header('Location: http://localhost:8888/stock_php/dist/cars.php');
        exit();
      }
      else
      {
        $error_messages['login'] = 'Veuillez entrer un login valide';
        $error_messages['pass'] = 'Veuillez entrer un mot de passe valide';
      }
		}
	}
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
<?php if (!empty($error_messages))
{
  echo '<div class="alert--errors alert"><a class="alert--btn--errors alert--btn" href="#">&times</a>';
  foreach($error_messages as $_error): ?>
    <span><strong>Erreur</strong> <?= $_error ?></span><br>
  <?php endforeach;
  echo '</div>';
}
$error_messages = []; ?>
  <div class="login">
    <div class="login--card">
      <h1 class="login--card--title">Cars stock management</h1>
      <form class="login--card--form" action="index.php" method="post">
        <label class="login--card--form--label">Login
          <input class="login--card--form--input" type="text" name="login">
        </label>
        <label class="login--card--form--label">Password
          <input class="login--card--form--input" type="text" name="password">
        </label>
        <input class="login--card--form--btn" type="submit" name="submite" value="Valider">
      </form>
    </div>
  </div>
  <script src="./assets/javascript/bundle.js"></script>
</body>
</html>
