<?php
require_once("./include/fBDD.php");
$conn1=connexionBDD();
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link href="./style/historique.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
        <script type="text/javascript">

             var objRequete = new XMLHttpRequest;

             function fRetour() {
				if (objRequete.readyState==4 && objRequete.status==200) { 
                    try {
                        obj=JSON.parse(objRequete.responseText);
                        tableUpdateHisto(obj);
                    } catch (e) {
                        alert("pb parsing. Voir l'erreur dans la console si possible");
                        console.error("Parsing error:-( :", e);
                    }
				}
			}
			
			function fAction() {
					objRequete.open('get','./include/api_histo.php?');	
                    objRequete.onreadystatechange = fRetour;		
                    objRequete.send(null);									
					return true; 
			 }
        </script>
	</head>
	<body onload="fAction();">
    <?php include("./include/header.php");?>
    <br>
    <Table Border=1 class="tabcenter" id="tableauhisto">
            <tr>
                <th><b>Action</b></th>
                <th><b>Date</b></th>
                <th><b>Detail</b></th>
            </tr>
            <tr>
            </tr>
        </table>
        <script src='./js/index.js'></script>
    </body>
</html>