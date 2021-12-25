<?php 
    define("DB_HOST", "localhost");
    define("DB_NAME", "test");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "root");
    define("DB_PASSWORD", "password");

    class Cal {
        private $pdo = null;
        private $stmt = null;
        public $error = "";


        public function __construct(){
            try {
                $this->pdo = new PDO(
                    "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
                    DB_USER, DB_PASSWORD, [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
              );
            } catch (Exception $ex) { exit($ex->getMessage()); }
        }


        // SAUVEGARDER UN EVENEMENT
        public function save ($start, $end, $txt, $color, $id=null) {
            // Vérification de date fin et début
            $uStart = strtotime($start);
            $uEnd = strtotime($end);
            if ($uEnd < $uStart) {
              $this->error = "La date de fin ne peut etre avant la date de début";
              return false;
            }
        
            //  Isérer un nouvel événement ou modifier
            if ($id==null) {
              $sql = "INSERT INTO `events` (`evt_start`, `evt_end`, `evt_text`, `evt_color`) VALUES (?,?,?,?)";
              $data = [$start, $end, $txt, $color];
            } else {
              $sql = "UPDATE `events` SET `evt_start`=?, `evt_end`=?, `evt_text`=?, `evt_color`=? WHERE `evt_id`=?";
              $data = [$start, $end, $txt, $color, $id];
            }
        
            //EXECUTER
            return $this->execute($sql, $data);
        }

        // Supprimer un événement
        public function delete ($id) {
            return $this->execute("DELETE FROM `events` WHERE `evt_id`=?", [$id]);
        }

        // Récupérer la liste des évenements pour un mois
        public function get ($month, $year) {
            //  premier et dernier jour du mois
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $first_day = "{$year}-{$month}-01 00:00:00";
            $last_day = "{$year}-{$month}-{$daysInMonth} 23:59:59";
        
            // récupération des événements
            if (!$this->execute(
              "SELECT * FROM `events` WHERE (
                (`evt_start` BETWEEN ? AND ?)
                OR (`evt_end` BETWEEN ? AND ?)
                OR (`evt_start` <= ? AND `evt_end` >= ?)
              )", [$first_day, $last_day, $first_day, $last_day, $first_day, $last_day]
            )) { return false; }
        
            // $events = [
            //  "e" => [ EVENT ID => [DATA], EVENT ID => [DATA], ... ],
            //  "d" => [ DAY => [EVENT IDS], DAY => [EVENT IDS], ... ]
            // ]
            $events = ["e" => [], "d" => []];
            while ($row = $this->stmt->fetch()) {
              $eStartMonth = substr($row["evt_start"], 5, 2);
              $eEndMonth = substr($row["evt_end"], 5, 2);
              $eStartDay = $eStartMonth==$month
                         ? (int)substr($row["evt_start"], 8, 2) : 1 ;
              $eEndDay = $eEndMonth==$month
                       ? (int)substr($row["evt_end"], 8, 2) : $daysInMonth ;
              for ($d=$eStartDay; $d<=$eEndDay; $d++) {
                if (!isset($events["d"][$d])) { $events["d"][$d] = []; }
                $events["d"][$d][] = $row["evt_id"];
              }
              $events["e"][$row["evt_id"]] = $row;
              $events["e"][$row["evt_id"]]["first"] = $eStartDay;
            }
            return $events;
        }

        // execution de la requete sql
        private function execute($sql, $data = null){
            try {
                $this->stmt = $this->pdo->prepare($sql);
                $this->stmt->execute($data);
                return true;
            } catch (Exception $ex) {
                $this->error = $ex->getMessage();
                return false;
              }
        }
    }

$_CAL = new Cal();