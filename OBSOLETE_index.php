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
			<h1>Inventaire du SIAI</h1>
			<Table Border=1 class="tabcenter">
				<tr>
                    <td></td>
					<td><b>Marque</b></td>
                    <td><b>Reference</b></td>
                    <td><b>Quantite</b></td>
				</tr>
                <?php
                    $res = ListeMateriel($conn1)->fetchAll();
                    foreach ($res as $ligne){
                        print "<tr>";
                        print "<td><a href='./det.php?id_materiel=".$ligne['id_materiel']."'>det</a></td>";
                        $m=$ligne["marque_materiel"];
                        $r=$ligne["reference_materiel"];
                        $q=$ligne["quantite"];
                        echo "<td>".$m."</td><td>".$r."</td><td>".$q."</td>";
                        print "</tr>";
                    }
                ?>
			</table>
            <br><br>
            <div class="nav">
                <a href="./ajtMat.php">Ajouter matériel</a>
                <input type="text" id="name" size="30">
                <a href="./rtrMat.php">Retirer matériel</a>
            </div>
	</body>
</html>