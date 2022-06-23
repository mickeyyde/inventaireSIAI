<?php
session_start();
require_once("./include/fBDD.php");
$conn1=connexionBDD();
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/pageCon.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
	</head>
 
 
	<body>
    <form method='POST' action="./include/connexion.php">
    <input type="text" name="mail" size="50"></td>
    <input type="submit" value="Se connecter"></td>
</form>
	</body>
 
</html>
