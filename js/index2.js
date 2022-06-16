function tableUpdate(obj) {
    try{
        var trs = document.getElementsByTagName('tr');
        for(var i=0;i=trs.length;i++){
            var oldtr = document.querySelector("[class='jstr']");   
            oldtr.remove();   ref_mat
        }
    }catch{
        console.log("Aucune référence correspondante dans la BDD");
    }
    var tbl = document.getElementById('tableauref');
    tbl.style.width = '50%';
    tbl.setAttribute('border', '1');
    for (var i = 0; i < obj.length; i++) {
        var tr = document.createElement('tr');
        tr.setAttribute('class', 'jstr');
        for (var j = 0; j < 6; j++) {
            var td = document.createElement('td');
            switch(j){
                case 0:
                    detMat = document.createElement('a');
                    detMat.innerText = "click";
                    detMat.setAttribute('href', "./det.php?id_materiel="+obj[i][7]+"&stock="+obj[i][8]);
                    td.appendChild(detMat);
                    tr.appendChild(td); 
                    break;

                case 5:
                    calcul = obj[i][4] + obj[i][5] + obj[i][6];
                    td.appendChild(document.createTextNode(calcul));
                    tr.appendChild(td);  
                    break;

                default:
                    td.appendChild(document.createTextNode(obj[i][j-1]));
                    tr.appendChild(td); 
                    break;
            }
        }
        tbl.appendChild(tr);
    }
}

function copyJsonToClickBoard(obj){
    var json = JSON.stringify(obj);

    navigator.clipboard.writeText(json)
        .then(() => {
        console.log("Texte copié")
    })
        .catch(err => {
        console.log('Un problème st survenu', err);
    })
 
}

function copyCsvToClickBoard(obj){
    var result = ConvertToCSV(obj);
    navigator.clipboard.writeText(result)
        .then(() => {
        console.log("Texte copié")
    })
        .catch(err => {
        console.log('Un problème st survenu', err);
    })
}

function ConvertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ';'
            line += array[i][index];
        }
        str += line + '\r\n';
    }

    return str;
}