<?php
  require_once('./functions/Login.php');
  if (isset($_POST) && count($_POST) > 0) {
    $Response = Login($_POST);
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Calendrier</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="../js/script.js"></script>  
  </head>
  <body>
    <div class="topnav">
      <?php if (isset($Response['error'])): ?>
      <div class="alert"><b>Oops</b>, <?php echo $Response['error']; ?></div>
       <?php endif; ?>
        <div class="login-container">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Connexion</h1>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" placeholder="Entrer email" class="form-control" required>
				</div>
				<div class="form-group">
				<label for="password">Mot de passe</label>
					<input type="password" name="password" placeholder="Entrer Password" class="form-control" required>
				</div>
            <button type="submit" name="submit">S'identifier</button>
            <p class="login-register-text">Vous n'avez pas un compte? <a href="register.php">Inscrivez-vous ici</a>.</p>
          </form>
        </div>
      </div>
      <!--heure-->
      <div id="time"></div>
      <!--calendar-->	
  </body>
</html>
