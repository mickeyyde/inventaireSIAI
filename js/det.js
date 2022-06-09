function modifier(){
    ipt = ['des', 'carac', 'com'];
    for(i = 0; i < 3; i++){
        document.querySelector("[class='str"+i+"']").innerHTML="<input name='M_"+ipt[i]+"' type='text' value='"+document.querySelector("[class='str"+i+"']").textContent+"'>";
    }
    document.getElementById("qte").innerHTML="<input name='M_qte' type='number' min='0' value='"+document.getElementById("qte").textContent+"'>";
    document.getElementById("modif").remove();
    var bCancel = document.createElement('button'); bCancel.setAttribute('onclick', 'document.location.reload(true);'); bCancel.setAttribute('class', 'button button2'); bCancel.innerText = "Annuler";
    document.getElementById("butt").appendChild(bCancel);
    var bSuppr = document.createElement('button'); bSuppr.setAttribute('onclick', 'deleteMat();'); bSuppr.setAttribute('class', 'button button3'); bSuppr.innerText = "Supprimer ce matériel";
    document.getElementById("butt").appendChild(bSuppr);
    var bSubmit = document.createElement('button'); bSubmit.setAttribute('onclick', 'document.forms["formDet"].submit();');bSubmit.setAttribute('class', 'button'); bSubmit.setAttribute('form', "formDet"); bSubmit.innerText = "Valider";
    document.getElementById("butt").appendChild(bSubmit);
}

function deleteMat(){
    if (confirm( "Êtes vous sûr de vouloir supprimer le matériel de référence "+document.getElementById("ref").textContent+" de la base de données? (Impossible de revenir en arrière)" )) {
        var getD_1 = new XMLHttpRequest;
        getD_1.open( "GET", "../include/action.php?ACTION=supprimer&S_ref="+document.getElementById("ref").textContent, false );
        getD_1.send(null);		
        alert("Le matériel a été supprimé");
        window.location.href = "../index.php";
    } else {
        document.location.reload(true);
    }
}