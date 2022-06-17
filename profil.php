<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: ./pageCon.php");
    die();
}
require("./include/fBDD.php");
$conn1 = connexionBDD();
$prop = getPropFromId($conn1, $_SESSION['id'])

?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
	<script>
        function supprimerStock(idstock){
            if(confirm("Etes vous certains de vouloir supprimer ce stock?")){
                if(confirm("Etes vous VRAIMENT certains de vouloir supprimer ce stock?")){
                    console.log('big suppression la');
                    document.forms["formSuppStock"].submit();
                }
            }
        }

        function showhiddenform(){
            var input = document.getElementById('inputnewstock');
            var oldbt = document.getElementById('showhiddenbutton');
            var newbt = document.getElementById('buttonnewstock');
            oldbt.setAttribute("hidden", true);
            input.removeAttribute("hidden");
            newbt.removeAttribute("hidden");
        }
    </script>
    </head>
	<body>
    <?php include("./include/header.php");?>
        Profil de <?= $prop['nom']." ".$prop['prenom']; ?><br><br>
        ID BDD: <?= $prop['id']; ?><br>
        Mail: <?= $prop['mail']; ?><br><br>
        Liste des Stocks: <form style='display:inline;' action=""><button onclick='showhiddenform();' id="showhiddenbutton" type="button">Ajouter nouveau</button><input id="inputnewstock" type="text" size="50" placeholder="Nom du stock" hidden><button hidden id="buttonnewstock">Valider</button></form>
            <ul>
                <?php 
                    $listestock = getStockFromIdProp($conn1, $prop['id']);
                    foreach($listestock as $ligne){
                        print('<li>');
                        print("<form method='POST' id='formSuppStock' style='display:inline;' action='./include/action.php' ><input type='text' name='idstock' hidden value='".$ligne['id']."'><a href='./stock.php?id=".$ligne['id']."'>".$ligne['nom']."</a>&nbsp&nbsp&nbsp&nbsp");
                        print("</form><button onclick='supprimerStock(".$ligne['id'].");'>Supprimer</button>");
                        print('</li>');
                    }
                ?>
            </ul>
	</body>
</html>
