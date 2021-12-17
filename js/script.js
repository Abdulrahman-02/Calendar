function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // ajouter des 0 pour les nombres < 10
    m = checkTime(m);
    s = checkTime(s);
    t = setTimeout(function() {
      startTime()
    }, 500);
    document.getElementById('time').innerHTML ="Il est " + h + ":" + m + ":" + s;
  }
  startTime();