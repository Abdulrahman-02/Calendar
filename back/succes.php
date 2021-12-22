<?php
session_start();
if (!isset($_SESSION['current_session'])) header('Location: index.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/succes_style.css">
	

	<title>Register</title>
</head>

<body>
     <?php echo "<h1>Bienvenue " . $_SESSION['current_session']['user']['last_name'] . "</h1>"; ?>
	<div id="continer"  class="containers">
		<div class="top-card">
			<span id="croix" style="display:none" class="circle-check">✓</span>
			<h3 id='popup_stat'>succés</h3>
		</div>
		<p id="register_p">félicitations! votre compte est crée avec succés</p>
		<a id="register_btn" href="index.php" class="btn-continue">Continuer</a>


	</div>

</body>

</html>