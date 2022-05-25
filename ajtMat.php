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
            Marque:
            <select name="P_marque">
                <?php
                    $res = ListeMarque($conn1)->fetchAll();
                    foreach($res as $ligne){
                        print "<option value='".$ligne['nom_marque']."'>".$ligne['nom_marque']."</option>";
                    }
                ?>
            <select>
            Reference:
            <input type="text" name="P_ref" size="30">
            Quantité
            <input type="number" name="P_qte" min="1" size="10">
        </form>
        <button type="submit" form="form1" value="Submit">Confirmer</button>
	</body>
</html>