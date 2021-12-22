<?php
  session_start();

    function DbHandler ()
    {
        $dbHost = 'localhost';
        $dbName = 'calendar_bdd';
        $dbUser = 'root';
        $dbPass = 'Abdou_2002';
        
        $Dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
        
        $options = array(
          PDO::ATTR_PERSISTENT => true,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
          $Connection = new PDO($Dsn, $dbUser, $dbPass, $options);
          return $Connection;
        } catch (Exception $e) {
          var_dump('Impossible d\'établir une connexion à la base de données. Pour la raison suivante : ' . $e->getMessage());
        }
    }
?>