<?php
    require_once("fBDD.php");
    $conn1=connexionBDD();
    $r=$conn1->query("SELECT * FROM Materiel WHERE id_materiel = ".$_GET['id_materiel'].";")->fetch();
    
    
    if ($r == false){
        header("Location: ./");
        die();
    }
    
    if (isset($_FILES['img_mat']['name'])) {
        $imageName = $_FILES['img_mat']['name'];
        $targetImage = $_SERVER['DOCUMENT_ROOT']."/ressource/imgMat/".basename($_FILES["img_mat"]["name"]);
        $imageExtension = strtolower(pathinfo($targetImage,PATHINFO_EXTENSION));
        $extension = array("apng", "bmp", "gif", "ico", "cur", "jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "svg", "tif", "tiff", "webp");
    
        // Si limage respecte les extensions autorisé
        if (in_array($imageExtension, $extension)) {
                $query = $conn1->prepare("UPDATE materiel SET img = :nom_img WHERE id_materiel = :id;");
                $query->bindValue(':nom_img', $imageName, PDO::PARAM_STR);
                $query->bindValue(':id', $r['id_materiel'], PDO::PARAM_INT);
                $query->execute();
            if (!file_exists($targetImage)) {
                move_uploaded_file($_FILES['img_mat']['tmp_name'], $targetImage);
            }
        }
        header("Refresh:0");
    }  

?>
<html>
	<head>
		<meta charset="UTF-8">
        <link href="./style/style.css" rel="stylesheet">
        <link href="./style/styledet.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="./ressource/BYES.png" />
        <script type="text/javascript">
            function modifier(){
                ipt = ['des', 'carac', 'com'];
                for(i = 0; i < 3; i++){
                    document.querySelector("[class='str"+i+"']").innerHTML="<input name='M_"+ipt[i]+"' type='text' value='"+document.querySelector("[class='str"+i+"']").textContent+"'>";
                }
                document.getElementById("qte").innerHTML="<input name='M_qte' type='number' min='0' value='"+document.getElementById("qte").textContent+"'>";
                document.getElementById("modif").remove();
                var bCancel = document.createElement('button'); bCancel.setAttribute('onclick', 'document.location.reload(true);'); bCancel.setAttribute('class', 'button button2'); bCancel.innerText = "Annuler";
                document.getElementById("butt").appendChild(bCancel);
                var bSuppr = document.createElement('button'); bSuppr.setAttribute('onclick', 'deleteMat();'); bSuppr.setAttribute('class', 'button button3'); bSuppr.innerText = "Supprimer ce matériel";
                document.getElementById("butt").appendChild(bSuppr);
                var bSubmit = document.createElement('button'); bSubmit.setAttribute('onclick', 'document.forms["formDet"].submit();');bSubmit.setAttribute('class', 'button'); bSubmit.setAttribute('form', "formDet"); bSubmit.innerText = "Valider";
                document.getElementById("butt").appendChild(bSubmit);
                
            }

            function deleteMat(){
                if (confirm( "Êtes vous sûr de vouloir supprimer le matériel de référence "+document.getElementById("ref").textContent+" de la base de données? (Impossible de revenir en arrière)" )) {
                    var getD_1 = new XMLHttpRequest;
                    getD_1.open( "GET", "./action.php?D_1=1&ref="+document.getElementById("ref").textContent, false ); // false for synchronous request
                    getD_1.send(null);		
                    alert("alert");
                    window.location.href = "./index.html";

                } else {
                    document.location.reload(true);
                }
            }
        </script>
	</head>
	<body id="body">
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
<div class="container">
<?php
if(is_null($r['img'])){
    print("<img src='./ressource/imgNull.png' alt='imgNull.png'>");
}else{
    print("<img src='./ressource/imgMat/".$r['img']."' alt='".$r['img']."'>");
}
?>
  <div class="text-container">
  <form action="./action.php" method="get" id="formDet">
                <input name='M_id' type='hidden' value='<?= $r['id_materiel']?>'/>
                ID BDD: <b><?= $r['id_materiel']?></b><br>
                Designation: <b class="str0"><?= $r["designation"]?></b><br>
                Marque: <b><?= $r["ref_marque"]?></b><br>
                Reference: <b id="ref"><?= $r["reference"]?></b><br>
                Quantite: <b id="qte"><?= $r["qte"]?></b><br>
                Caractéristiques: <b class="str1"><?= $r["caracteristique"]?></b><br>
                Commentaire: <i class="str2"><?= $r["commentaire"]?></i><br>
    </form>
    <form enctype="multipart/form-data" action="#" method="post">
                <br>Image: <?= $r["img"]?>
                <input name="img_mat" type="file"/><br><br>
                <input type="submit" value="ModifierImage"/>
    </form>
  </div>
  
</div>
<div id="butt"><button id="modif" class="button button2" onclick="modifier();">Modifier</button><br></div>

	</body> 
</html>