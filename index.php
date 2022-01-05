<?php
  require('user_session/Login.php');
  if (isset($_POST) && count($_POST) > 0) {
    $Response = Login($_POST);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Calendar Demo</title>
    <link rel="stylesheet" href="calendar.css">
    <script src="calendar.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

     <div class="topnav">
      <?php if (isset($Response['error'])): ?>
      <div class="alert"><b>Oops</b>, <?php echo $Response['error']; ?></div>
       <?php endif; ?>
        <div >
    <div class="login-container" >
    <div id="time"></div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login">

            <div>
                <label for="id" class="login__label">identifiant</label>
                <input type="email" name="email" placeholder="Entrer email"  class="login__input" required >
            </div>

            <div>
            <label for="password" class="login__label">Mot de passe</label>
            <input type="password" name="password" placeholder="Entrer Password" class="login__input" required>
            </div>

            <button type="submit" name="submit" class="mod">S'identifier</button>
             <button class="del"><a style="color:#ffffff" href="user_session/Register.php">S'inscrire</a></button>

        </form>

    </div>
            </div>
      </div>
      </div>
    <!-- periode selecteur -->
    <div id="calPeriod"><?php
      // mois selecteur
      $months = [
        1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril",
        5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Aout",
        9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Decembre"
      ];
      $monthNow = date("m");
      echo "<select id='calmonth'>";
      foreach ($months as $m=>$mth) {
        printf("<option value='%s'%s>%s</option>",
          $m, $m==$monthNow?" selected":"", $mth
        );
      }
      echo "</select>";

      // (A2) YEAR SELECTOR
      echo "<input type='number' id='calyear' value='".date("Y")."'/>";
    ?></div>

    <!-- (B) CALENDAR WRAPPER -->
    <div id="calwrap"></div>


  </body>
</html>
