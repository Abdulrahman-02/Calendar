var cal = {

    //initialiser le calendrier
    hMth:null,      //moi
    hYr:null,       //année
    hWrap:null,     //jours



    init  : () => {

    //obtenir les éléments html by id
    cal.hMth = document.getElementById("calmonth");
    cal.hYr = document.getElementById("calyear");
    cal.hWrap = document.getElementById("calwrap");

    
    //fixer les commandes
    cal.hMth.onchange = cal.draw;
    cal.hYr.onchange = cal.draw;


    //dessiner mois/année en cour
    cal.draw();
    },

//FONCTION DE SOUTIEN - AJAX FETCH
ajax : (data, load) => {
    fetch("ajax.php", { method:"POST", body:data })
    .then(res=>res.text()).then(load);
},
//dessiner calendrier
draw : () => {

    //données de formulaire
    let data = new FormData();
    data.append("req","draw");
    data.append("month",cal.hMth.value);
    data.append("year",cal.hYr.value);

    //AJAX chargé le mois selctioné
    cal.ajax(data, (res) => {

    //fixer le calendrier à son emballage
    cal.hWrap.innerHTML = res;


    });
},
};

window.addEventListener("DOMContentLoaded", cal.init);
