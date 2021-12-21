<?php
class Dbh{

    protected function connect(){
        try {
            $username = "root";
            $password = "Abdou_2002";
            $dbh = new PDO('mysql:host=localhost;dbname=calendar_bdd', $username, $password);
        } catch (PDOException $e) {
            print "Error " . $e->getMessage() . "<br/>";
            die();
        }
    }
}