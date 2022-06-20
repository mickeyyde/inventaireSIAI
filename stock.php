<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: ./pageCon.php");
    die();
}
require('./include/fBDD.php');
$connex = connexionBDD();

if (isset($_GET['id'])){
    $stock = getStockFromId($connex, $_GET['id']);
    if($stock == false){
        header("Location: ./profil.php");
        die();
    } else {
        $prop = getPropFromId($connex, $stock["ref_proprietaire"]);
    }
} else{
    header("Location: ./profil.php");
    die();
}
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
                    var idget = document.getElementById('idget').value;
					objRequete.open('get','./include/api/api_stock.php?id='+idget);	
                    objRequete.onreadystatechange = fRetour;		
                    objRequete.send(null);									
					return true; 
			 }

            
        </script>
	</head>
	<body onload="fAction();">
    <?php include("./include/header.php");?>
             <input type="text" id="idget" hidden value="<?= $_GET['id']; ?>">
        <h1><?= $prop["nom"]." ".$prop["prenom"]." : ".$stock["nom"]; ?></h1><br>
        <br><br>
        <Table Border=1 class="tabcenter" id="tableauref">
             <tr>
                <td  colspan="6"><a href="./stockadd.php?idstock=<?= $_GET['id']; ?>">Ajouter du matériel dans ce stock</a></td>
            </tr>
            <tr>
                <th><b>Détail</b></th>
                <th><b>Type</b></th>
                <th><b>Marque</b></th>
                <th><b>Reference</b></th>
                <th><b>Designation</b></th>
                <th><b>Quantite totale</b></th>
            </tr>
        </table>
        <br>
            <input type="image" onclick="copyCsvToClickBoard(obj);" class="exportbutton" id="csv" alt="csv button" src="./ressource/csv.png" />
            <input type="image" onclick="copyJsonToClickBoard(obj);" class="exportbutton" id="json" alt="json button" src="./ressource/json.png" />
            <script src='./js/index2.js'></script>
	</body>
</html>