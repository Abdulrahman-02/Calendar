<?php
class SignupContr extends Signup{

    private $uid;
    private $email;
    private $birthday;
    private $psw;
    private $pswRepeat;

    public function __construct($uid, $email, $birthday, $psw, $pswRepeat){

        $this->uid = $uid;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->psw = $psw;
        $this->pswRepeat = $pswRepeat;
    }

    public function signupUser(){
        if($this->emptyInput() == false){
            //echo 'empty input';
            header("location:../register.php?error=emptyInput");
        }
        if($this->invalidUid() == false){
            //echo 'invalide username';
            header("location:../register.php?error=invalidEmail");
        }
        if($this->invalidEmail() == false){
            //echo 'invalide email';
            header("location:../register.php?error=invalidEmail");
        }
        if($this->pswMatch() == false){
            //echo 'password don't match';
            header("location:../register.php?error=pwdMatch");
        }
        if($this->uidTakenCheck() == false){
            //echo 'username or email already taken';
            header("location:../register.php?error=emailTakenCheck");
        }

        $this->setUser($this->uid,$this->email,$this->birthday,$this->psw);
    }

    private function emptyInput(){
        if(empty($this->uid) || empty($this->email) || empty($this->birthday) || empty($this->psw) || empty($this->pswRepeat)){
                $result = false;
        } else {
            $result= true;
        }
        return $result;
    }

    private function invalidUid(){
        if (!preg_match("/^[a-zA-Z0-9]*$/",$this->uid)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function pswMatch(){
        if (!$this->psw !== $this->pswRepeat) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

}