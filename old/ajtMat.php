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
        <input name='ACTION' type='hidden' value='ajouter'/>
        Designation:    
        <input type="text" name="A_des" size="30">
        Marque:
            <select name="A_marque">
                <?php
                    $res = ListeMarque($conn1)->fetchAll();
                    foreach($res as $ligne){
                        print "<option value='".$ligne['nom_marque']."'>".$ligne['nom_marque']."</option>";
                    }
                ?>
            <select>
            Reference:
            <input type="text" name="A_ref" size="30">
            Quantité à ajouter
            <input type="number" name="A_qte" min="1" size="10">
        </form>
        <button type="submit" form="form1">Confirmer</button>
	</body>
</html>