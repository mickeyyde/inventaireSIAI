<?php
session_start();
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
    <?php include('./include/header.php'); ?>
    <form action="./include/action.php">
        <input type="hidden" name="ACTION" value="newMAT">
        <input name="A_type" type="text" placeholder="Type">
        <select name="A_marque">
                <?php
                    $res = ListeMarque($conn1)->fetchAll();
                    foreach($res as $ligne){
                        print "<option value='".$ligne['nom']."'>".$ligne['nom']."</option>";
                    }
                ?>
        <select>
        <input type="text" name="A_ref" placeholder="Reference">
        <input type="submit" value="confirmer">
    </form>
</body>

</html>
