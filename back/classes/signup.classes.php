<?php

class Signup extends Dbh{

    protected function checkUser($uid, $email){
        $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');
        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            header("location: ../register.php?error=stmtfailed");
            exit();
        }
        
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function setUser($uid, $email, $birthday, $psw){
        $stmt = $this->connect()->prepare('INSERT INTO users (`username`, `email`, `birthday`, `password`)
        VALUES (?, ?, ?, ?);');

        $hashedPwd = password_hash($psw,PASSWORD_DEFAULT);
        
        if (!$stmt->execute(array($uid,$email,$birthday,$hashedPwd))) {
            $stmt = null;
            header("location: ../register.php?error=stmtfailed");
            exit();
        }
        
        $stmt = null;

    }

}