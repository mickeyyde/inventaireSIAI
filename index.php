<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: ./pageCon.php");
    die();
}

require_once("./include/fBDD.php");
$conn1=connexionBDD();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
        <script type="text/javascript">

             var objRequete = new XMLHttpRequest;

             function fRetour() {
				if (objRequete.readyState==4 && objRequete.status==200) { 
                    try {
                        obj=JSON.parse(objRequete.responseText);
                        tableUpdate(obj);
                    } catch (e) {
                        alert("pb parsing. Voir l'erreur dans la console si possible");
                        console.error("Parsing error:-( :", e);
                    }
				}
			}
			
			function fAction() {
                var recherche = document.getElementById('recherche').value;
                var marque = document.getElementById('marque').value;
                var type = document.getElementById('type').value;
                objRequete.open('get','./include/api/api_mat.php?'+String(recherche.toUpperCase())+'/'+String(marque.toUpperCase())+'/'+String(type.toUpperCase()),true);	

                //objRequete.open('get','./include/api/api_xmax.php?//',true);	
                objRequete.onreadystatechange = fRetour;		
                objRequete.send(null);									
                return true; 
			 }

            
        </script>
	</head>

	<body onload="fAction();">
        <?php include("./include/header.php");?>
        <h1>Inventaire du SIAI (Activez JavaScript sur votre navigateur)</h1><br>
        <br>
        <input type="text" id="type" placeholder="Type" size="30">
            <input type="text" id="marque" placeholder="Marque" size="30">
            <input type="text" id="recherche" placeholder="Reference" size="30">
            <button onclick="fAction();">Rechercher</button>
        <br> <br> 
        <Table Border=1 class="tabcenter" id="tableauref">
            <tr>
                <td  colspan="5"><a href="./newmat.php">Créer un nouveau matériel</a></td>
            </tr>
            <tr>
                <th><b>Détail</b></th>
                <th><b>Type</b></th>
                <th><b>Marque</b></th>
                <th><b>Reference</b></th>
                <th><b>Designation</b></th>
            </tr>
        </table>
        <br>
            <input type="image" onclick="copyCsvToClickBoard(obj);" class="exportbutton" id="csv" alt="csv button" src="./ressource/csv.png" />
            <input type="image" onclick="copyJsonToClickBoard(obj);" class="exportbutton" id="json" alt="json button" src="./ressource/json.png" />
            <script src='./js/index.js'></script>
	</body>
</html>