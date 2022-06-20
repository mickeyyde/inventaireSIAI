<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: ./pageCon.php");
    die();
}

require_once("./include/fBDD.php");
$conn1=connexionBDD();
$rMat=$conn1->query("SELECT * FROM Materiel ORDER BY id;")->fetchAll();
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
	</head>
    <body>
    <?php include('./include/header.php'); ?>
    <form action="./include/action.php" id="formAddStock">
        <input hidden name="ACTION" value="addSTOCK">
        <input hidden name="aS_idstock" value="<?= $_GET['idstock'];?>"><br><br>
        Matériel <br>
        <select style='width: 300px;' name="aS_idmat">
                <?php

                    foreach($rMat as $ligne){
                        print "<option value='".$ligne['id']."'>".$ligne['marque']." [".$ligne['id']."] ".$ligne['type']." : ".$ligne['reference']."</option>";
                    }
                ?>
        <select><br><br>
        Quantité Neuve <br>   
        <input type="number" name="aS_qte_ne" value="0" min="0" ><br><br>
        Quantité Emballage ouvert <br>
        <input type="number" name="aS_qte_eo" value="0" min="0"><br><br>
        Quantité Sans Emballage <br>
        <input type="number" name="aS_qte_se" value="0" min="0"><br><br>
        <input type="submit" value="confirmer">
    </form>
</body>

</html>
