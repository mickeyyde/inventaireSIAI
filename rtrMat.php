<?php
require_once("fBDD.php");
$conn1=connexionBDD();
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
	</head>
	<body>
        <section style="background: lightblue; color: rgba(0, 0, 0, 0.5);">
            <nav class="shift">
                <ul>
                <li><a href="./ajtMat.php">Ajouter</a></li>
                <li><a href="./">Accueil</a></li>
                <li><a href="./rtrMat.php">Retirer</a></li>
                <li><a href="#">Historique</a></li>
                </ul>
            </nav>
        </section>
		<form action="action.php" method="get" id="form1">
            Reference:
            <input type="text" name="P_ref" size="30">
            Quantité à retirer : 
            <input type="number" name="P_qte" min="1" size="10">
        </form>
        <button type="submit" form="form1" value="Submit">Confirmer</button>
	</body>
</html>