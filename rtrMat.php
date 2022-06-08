<?php
require_once("./include/fBDD.php");
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
    <?php include("./include/header.php");?>
		<form action="./include/action.php" method="get" id="form1">
        <input name='ACTION' type='hidden' value='retirer'/>
            Reference:
            <input type="text" name="R_ref" size="30">
            Quantité à retirer : 
            <input type="number" name="R_qte" min="1" size="10">
        </form>
        <button type="submit" form="form1" value="Submit">Confirmer</button>
	</body>
</html>