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
		<form action="action.php" method="get" id="form1">
            Reference:
            <input type="text" name="P_ref" size="30">
            Quantité à retirer : 
            <input type="number" name="P_qte" min="1" size="10">
        </form>
        <button type="submit" form="form1" value="Submit">Confirmer</button>
	</body>
</html>