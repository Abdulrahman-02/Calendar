<?php
if (isset($_POST["submit"])) {
    //getting data
    $uid = $_POST["uid"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $psw = $_POST["psw"];
    $pswRepeat = $_POST["psw-repeat"];

    //instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $email, $birthday, $psw, $pswRepeat);

    //running error handlers
    $signup->signupUser();

    //going back to front page
    header("location:../register.php");
}

