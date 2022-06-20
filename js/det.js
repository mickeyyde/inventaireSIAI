function modifiermat(){
    ipt = ['type', 'com', 'des'];
    for(i = 0; i < 3; i++){
        document.querySelector("[class='str"+i+"']").innerHTML="<input name='M_"+ipt[i]+"' type='text' value='"+document.querySelector("[class='str"+i+"']").textContent+"'>";
    }
    document.getElementById("modifmat").remove();
    var bCancel = document.createElement('button'); bCancel.setAttribute('onclick', 'document.location.reload(true);'); bCancel.setAttribute('class', 'button button2'); bCancel.setAttribute('id', 'cancel'); bCancel.innerText = "Annuler";
    document.getElementById("div1").appendChild(bCancel);
    var bSuppr = document.createElement('button'); bSuppr.setAttribute('onclick', 'deleteMat();'); bSuppr.setAttribute('class', 'button button3'); bSuppr.setAttribute('id', 'supp'); bSuppr.innerText = "Supprimer ce matériel";
    document.getElementById("div1").appendChild(bSuppr);
    var bSubmit = document.createElement('button'); bSubmit.setAttribute('onclick', 'document.forms["formDet"].submit();'); bSubmit.setAttribute('class', 'button'); bSubmit.setAttribute('id', 'fsub'); bSubmit.setAttribute('form', "formDet"); bSubmit.innerText = "Valider";
    document.getElementById("div1").appendChild(bSubmit);
}

function modifierstock(){
    ipt = ['ne', 'eo', 'se'];
    for(i = 0; i < 3; i++){
        document.querySelector("[class='qte"+[i]+"']").innerHTML="<input name='M_"+ipt[i]+"' type='number' min='0' value='"+document.querySelector("[class='qte"+[i]+"']").textContent+"'>";
    }
    document.getElementById("modifstock").remove();
    var bCancel = document.createElement('button'); bCancel.setAttribute('onclick', 'document.location.reload(true);'); bCancel.setAttribute('class', 'button button2'); bCancel.setAttribute('id', 'cancel'); bCancel.innerText = "Annuler";
    document.getElementById("div2").appendChild(bCancel);
    var bSuppr = document.createElement('button'); bSuppr.setAttribute('onclick', 'deleteFromStock();'); bSuppr.setAttribute('class', 'button button3'); bSuppr.innerText = "Supprimer du stock";
    document.getElementById("div2").appendChild(bSuppr);
    var bSubmit = document.createElement('button'); bSubmit.setAttribute('onclick', 'document.forms["formDet"].submit();');bSubmit.setAttribute('class', 'button'); bSubmit.setAttribute('id', 'fsub'); bSubmit.setAttribute('form', "formStock"); bSubmit.innerText = "Valider";
    document.getElementById("div2").appendChild(bSubmit);
}

function deleteMat(){
    if (confirm( "Êtes vous sûr de vouloir supprimer le matériel de référence "+document.getElementById("ref").textContent+" de la base de données? (Impossible de revenir en arrière)" )) {
        var getD_1 = new XMLHttpRequest;
        getD_1.open( "GET", "../include/action.php?ACTION=supprimerMAT&S_idmat="+document.getElementById("idmat").value, false );
        getD_1.send(null);		
        alert("Le matériel a été supprimé");
        window.location.href = "../index.php";
    } else {
        document.location.reload(true);
    }
}

function deleteFromStock(){
    if (confirm( "Êtes vous sûr de vouloir supprimer le matériel de référence "+document.getElementById("ref").textContent+" du stock ? (Impossible de revenir en arrière)" )) {
        var getD_2 = new XMLHttpRequest;
        getD_2.open( "GET", "../include/action.php?ACTION=supprimerMATfromSTOCK&S_matid="+document.getElementById("idmat").value+"&S_stockid="+document.getElementById("stockid").value, false );
        getD_2.send(null);		
        alert("Le matériel a été supprimé du stock");
        window.location.href = "../index.php";
    } else {
        document.location.reload(true);
    }
}