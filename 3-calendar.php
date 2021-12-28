<!DOCTYPE html>
<html>
  <head>
    <title>Calendar Demo</title>
    <link rel="stylesheet" href="6-calendar.css">
    <script src="5-calendar.js"></script>
  </head>
  <body>
    <!-- (A) PERIOD SELECTOR -->
    <div id="calPeriod"><?php
      // (A1) MONTH SELECTOR
      // NOTE: DEFAULT TO CURRENT SERVER MONTH YEAR
      $months = [
        1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril",
        5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Aout",
        9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Decembre"
      ];
      $monthNow = date("m");
      echo "<select id='calmonth'>";
      foreach ($months as $m=>$mth) {
        printf("<option value='%s'%s>%s</option>",
          $m, $m==$monthNow?" selected":"", $mth
        );
      }
      echo "</select>";

      // (A2) YEAR SELECTOR
      echo "<input type='number' id='calyear' value='".date("Y")."'/>";
    ?></div>

    <!-- (B) CALENDAR WRAPPER -->
    <div id="calwrap"></div>

    <!-- (C) EVENT FORM -->
    <div id="calblock"><form id="calform">
      <input type="hidden" name="req" value="save"/>
      <input type="hidden" id="evtid" name="eid"/>
      <label for="start">Date Start</label>
      <input type="datetime-local" id="evtstart" name="start" required/>
      <label for="end">Date End</label>
      <input type="datetime-local" id="evtend" name="end" required/>
      <label for="txt">Event</label>
      <textarea id="evttxt" name="txt" required></textarea>
      <label for="color">Color</label>
      <input type="color" id="evtcolor" name="color" value="#e4edff" required/>
      <input type="submit" id="calformsave" value="save"/>
      <input type="button" id="calformdel" value="Delete"/>
      <input type="button" id="calformcx" value="Cancel"/>
    </form></div>
  </body>
</html>
