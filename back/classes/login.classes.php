<?php

class Login extends Dbh{

    protected function getUser($uid, $psw){
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE username = ? OR email = ?;');

        
        
        if (!$stmt->execute(array($uid, $psw))) {
            $stmt = null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../../index.php?error=usernotfound");
            exit();
        }

        $pswHached = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkpsw = password_verify($psw, $pswHached[0]["password"]);
        
        if ($checkpsw == false) {
            $stmt = null;
            header("location: ../../index.php?error=wrongpassword");
            exit();
        }
        elseif($checkpsw == true){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? OR email = ? AND password = ?;');

            if (!$stmt->execute(array($uid, $uid, $psw))) {
            $stmt = null;
            header("location: ../../index.php?error=stmtfailed");
            exit();

            if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../../index.php?error=usernotfound");
            exit();
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["userid"] = $user[0]["id"];
        $_SESSION["useruid"] = $user[0]["username"];
        $stmt = null;
        }
            
        }

        $stmt = null;

    }

}