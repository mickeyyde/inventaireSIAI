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
        <script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
	</head>
    <body>
        <div id="t"><button class="open-button" onclick="openForm()">Se connecter</button>


<div class="form-popup" id="myForm">
  <form action="./include/connexion.php" class="form-container" method="post">
  <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button> 
  <button type="submit" class="btn">Se connecter</button>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Entrez un mail" name="mail" required>

    
    
  </form>
</div>
</div>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
 <!---   
	<body>
    <form method='POST' action="./include/connexion.php">
    <input type="text" name="mail" size="50"></td>
    <input type="submit" value="Se connecter"></td>
</form>
	</body>
 --->   
</html>
