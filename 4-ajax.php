<?php
// inclure le code de connexion a la base de donnnes : avec (require)  :
require "2-cal-core.php";

// requette condition :
  switch ($_POST["req"]) {


//Enregistrer_un_Evenement : 
    case "save":
    if (!is_numeric($_POST["eid"])) { $_POST["eid"] = null; }
    echo $_CAL->save(
      $_POST["start"], $_POST["end"], $_POST["txt"], $_POST["color"],
      isset($_POST["eid"]) ? $_POST["eid"] : null
    ) ? "OK" : $_CAL->error ;
    break;


// Supprimer_un_Evenement :
  case "del":
    echo $_CAL->del($_POST["eid"])  ? "OK" : $_CAL->error ;
    break;


// GENERATION DU CALENDRIER  : 
  case "draw":
    // CALCUL NOMBRE DE JOURS PAR MOIS : 
    $Num_days_in_month = cal_days_in_month(CAL_GREGORIAN, $_POST["month"], $_POST["year"]);

    // CALCUL DU PREMIER JOUR DU MOIS :
    $First_date = "{$_POST["year"]}-{$_POST["month"]}-01";

    // CALCUL DU DERNIER JOUR DU MOIS :
    $Last_date = "{$_POST["year"]}-{$_POST["month"]}-{$Num_days_in_month}";

    // JOUR DE SEMAINE (0 => Dimanche) : 
    // DEBUT DE MOIS  QUEL JOUR EXEMPLE ? : { 01 DECEMBRE 2021  C  3=> MRECREDI } : 
    $First_day = (new DateTime($First_date))->format("w");

    // FIN DE MOIS  QUEL JOUR EXEMPLE ? : { 31 DECEMBRE 2021  C  5=> VENDREDI } : 
    $Last_day = (new DateTime($Last_date))->format("w");


    // NOMS DES JOURS : 
    $days = ["Dim","Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"];
    // AFFICHER TOUS LES JOURS : 
    foreach ($days as $d) { echo "<div class='space head'>$d</div>"; }
    unset($days);


    // LES ESPACES AVANT LE PREMIER JOUR DU MOIS : 
    $space = $First_day;
    for ($i=0; $i<$space; $i++) { 
     echo "<div class='space blank'></div>"; }


    // GENERER LES JOURS DU MOIS : 
    $events = $_CAL->get($_POST["month"], $_POST["year"]);
    $Month_now = date("n");
    $Year_now = date("Y");
    $nowDay = ($Month_now==$_POST["month"] && $Year_now==$_POST["year"]) ? date("j") : 0 ;

      //AFFCIHER LES JOURS : BOUCLE : 
    for ($day = 1; $day <= $Num_days_in_month; $day++) { ?>
    <div class="space day <?=$day==$nowDay?" today":""?>" data-day="<?=$day?>">
      <div class="calnum"><?=$day?></div>

      <!---AFFICHER TOUS LES EVENEMENTS CORRESPONDANT A CHAQUE JOUR :   --->
        <?php if (isset($events["d"][$day])) { 
          foreach ($events["d"][$day] as $eid) { ?>

        <div class="calevt" data-eid="<?=$eid?>" 
          style="background:<?=$events["e"][$eid]["evt_color"]?>">
          <?=$events["e"][$eid]["evt_text"]?>
        </div>

      <!---AFFICHER LES DONNES D'UN TEL EVENEMENTS : ID,TEXT,COULEUR...    --->
        <?php if ($day == $events["e"][$eid]["first"]) {
          echo "<div id='evt$eid' class='calninja'>".json_encode($events["e"][$eid])."</div>";
        }}
      } 
      ?>
    </div>
          <?php }


    // LES ESPACES APRES LE DERNIER JOUR DU MOIS : 
     $space = $Last_day==0 ? 0 : 7-$Last_day ;
    for ($i=0; $i<$space; $i++) { 
      echo "<div class='space blank'></div>"; }
    

// FIN DU CODE AJAX !
}

