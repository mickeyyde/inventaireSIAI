function tableUpdate() {
    try{
        var trs = document.getElementsByTagName('tr');
        for(var i=0;i=trs.length;i++){
            var oldtr = document.querySelector("[class='jstr']");   
            oldtr.remove();   
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
        for (var j = 0; j < 5; j++) {
            var td = document.createElement('td');
            if(j == 0 ){
                test = document.createElement('a');
                test.innerText = "click"+obj[i][4];
                test.setAttribute('href', "./det.php?id_materiel="+obj[i][4]);
                td.appendChild(test);
                tr.appendChild(td);  
            }else{
                td.appendChild(document.createTextNode(obj[i][j-1]));
                tr.appendChild(td);  
            }
        }
        tbl.appendChild(tr);
    }
}