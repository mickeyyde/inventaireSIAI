<?php
    require_once("fBDD.php");
    $conn1=connexionBDD();
?>
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
<?php
        $r=$conn1->query("SELECT * FROM Materiel WHERE id_materiel = ".$_GET['id_materiel'].";")->fetch();
        print("Designation:<b>".$r["designation"]."</b><br>");
        print("Marque:<b>".$r["ref_marque"]."</b><br>");
        print("Reference:<b>".$r["reference"]."</b><br>");
        print("Quantite:<b>".$r["qte"]."</b><br>");
        print("Caractéristiques produit:<b>".$r["caracteristique"]."</b><br>");
        print("Commentaire:<b>".$r["commentaire"]."</b><br>");
?>

	</body>
</html>