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
	</head>
	<body>
    <?php include("./include/header.php");?>
        Profil de <?= $prop['nom']." ".$prop['prenom']; ?><br><br>
        ID BDD: <?= $prop['id']; ?><br>
        Mail: <?= $prop['mail']; ?><br><br>
        Liste des Stocks:
            <ul>
                <?php 
                    $listestock = getStockFromIdProp($conn1, $prop['id']);
                    foreach($listestock as $ligne){
                        print('<li>');
                        print("<a href='./stock.php?id=".$ligne['id']."'>".$ligne['nom']."</a>");
                        print('</li>');
                        
                    }
                ?>
            </ul>
	</body>
</html>
