<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form action="includes/signup.inc.php">
  <div class="container">
    <h1>Register</h1>
    <hr>
    <label for="username"><b>User Name</b></label>
    <input type="text" placeholder="Enter User Name" name="uid" id="uid" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="birthday"><b>Birthday</b></label>
    <input type="date"  name="birthday" id="birthday" required>    

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <hr>

    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Vous avez déja un compte? <a href="../index.php">S'identifier</a>.</p>
  </div>
</form>
    
</body>
</html>