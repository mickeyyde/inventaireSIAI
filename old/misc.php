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
    <br>
    <h1>Ajouter une marque</h1>
    <form action="./include/action.php" method="get" id="form1">
        <input name='ACTION' type='hidden' value='new_marque'/>
        <input type="text" name="N_marque" size="30">
        <button type="submit" form="form1">Confirmer</button>
    </form>
    <br><br><br><br><br><br>
    <h1>Retirer une marque</h1>
    <form action="./include/action.php" method="get" id="form">
    <input name='ACTION' type='hidden' value='supprimer_marque'/>
    <select name="SUPP_marque">
                <?php
                    $res = ListeMarque($conn1)->fetchAll();
                    foreach($res as $ligne){
                        print "<option value='".$ligne['nom_marque']."'>".$ligne['nom_marque']."</option>";
                    }
                ?>
    <select>
        <button type="submit" form="form">Confirmer</button>
    </form>
    
    </body>
</html>