<?php
if (isset($_POST["submit"])) {
    //getting data
    $uid = $_POST["uid"];
    $psw = $_POST["psw"];

    //instantiate LoginContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new loginContr($uid, $psw);

    //running error handlers
    $login->loginUser();

    //going back to front page
    header("location:../../index.php");
}