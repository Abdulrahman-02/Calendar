<?php

class LoginContr extends Login{

    private $uid;
    private $psw;


    public function __construct($uid, $psw){

        $this->uid = $uid;
        $this->psw = $psw;
    }

    public function loginUser(){
        if($this->emptyInput() == false){
            //echo 'empty input';
            header("location:../register.php?error=emptyInput");
        }

        $this->getUser($this->uid,$this->psw);
    }

    private function emptyInput(){
        if(empty($this->uid) || empty($this->psw)){
                $result = false;
        } else {
            $result= true;
        }
        return $result;
    }
}