<?php     // (F2) GET EVENTS
    if (!$this->exec(
      "SELECT * FROM `events` WHERE (`evt_start` <= ? AND `evt_end` >= ?)", 
      [$dayFirst, $dayLast]
    )) { return false; }

    // $events = [
    //  "e" => [ EVENT ID => [DATA], EVENT ID => [DATA], ... ],
    //  "d" => [ DAY => [EVENT IDS], DAY => [EVENT IDS], ... ]
    // ]
    $events = ["e" => [], "d" => []];
    while ($row = $this->stmt->fetch()) {
      $eStartMonth = substr($row["evt_start"], 5, 2);
    echo "<h1>".$eStartMonth."</h1>";

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
  } ?>