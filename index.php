<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Calendrier</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/script.js"></script>  
  </head>
  <body>
    <div class="topnav">
      <?php
      if (isset($_SESSION["userid"])) {
      ?>
      <li><a href="#"><?php echo $_SESSION["useruid"]?></a></li>
      <li><a href="back/includes/logout.inc.php" class="header-login-a">LOGOUT</a></li>
      <?php
      }
      else{
      ?>
        <div class="login-container">
          <form method="post" action="back/includes/login.inc.php">
            <h1>Connexion</h1>
				<div class="form-group">
					<label for="email">Nom d'utilisateur</label>
					<input type="text" name="uid" placeholder="Enter user name" class="form-control">
				</div>
				<div class="form-group">
				<label for="email">Mot de passe</label>
					<input type="password" name="psw" placeholder="Enter Password" class="form-control">
				</div>
            <button type="submit" name="submit">S'identifier</button>
            <p class="login-register-text">Vous n'avez pas un compte? <a href="back/register.php">Inscrivez-vous ici</a>.</p>
          </form>
        </div>
      </div>
      <!--heure-->
      <div id="time"></div>
      <!--calendar-->	
  </body>
</html>