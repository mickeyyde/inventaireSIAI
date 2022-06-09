<?php
    require_once("./include/fBDD.php");
    $conn1=connexionBDD();
    $r=$conn1->query("SELECT * FROM Materiel WHERE id_materiel = ".$_GET['id_materiel'].";")->fetch();
    
    
    if ($r == false){
        header("Location: ./");
        die();
    }
    
    if (isset($_FILES['img_mat']['name'])) {
            $imageName = $_FILES['img_mat']['name'];
            $targetImage = $_SERVER['DOCUMENT_ROOT']."/ressource/imgMat/".basename($_FILES["img_mat"]["name"]);
            $imageExtension = pathinfo($targetImage);
            $extension = array("apng", "bmp", "gif", "ico", "cur", "jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "svg", "tif", "tiff", "webp");
        
            // Si limage respecte les extensions autorisé
            if (in_array($imageExtension['extension'], $extension)) {
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
        <script src="./js/det.js"></script>
	</head>
	<body id="body">
    <?php include("./include/header.php");?>
<div class="container">
<?php
if(is_null($r['img'])){
    print("<img src='./ressource/imgNull.png' alt='imgNull.png'>");
}else{
    print("<img src='./ressource/imgMat/".$r['img']."' alt='".$r['img']."'>");
}
?>
  <div class="text-container">
  <form action="./include/action.php" method="get" id="formDet">
                <input name='ACTION' type='hidden' value='modifier'/>
                <input name='M_id' type='hidden' value='<?= $r['id_materiel']?>'/>
                ID BDD: <b><?= $r['id_materiel']?></b><br>
                Designation: <b class="str0"><?= $r["designation"]?></b><br>
                Marque: <b><?= $r["ref_marque"]?></b><br>
                Reference: <b id="ref"><?= $r["reference"]?></b><br>
                Quantite: <b id="qte"><?= $r["qte"]?></b><br>
                Caractéristiques: <b class="str1"><?= $r["caracteristique"]?></b><br>
                Commentaire: <i class="str2"><?= $r["commentaire"]?></i><br>
    </form>
    <br>Image: <?= $r["img"]?>
    <form enctype="multipart/form-data" action="#" method="post">
                <input name="img_mat" type="file"/><br><br>
                <input type="submit" value="ModifierImage"/>
    </form>
  </div>
  
</div>
<div id="butt"><button id="modif" class="button button2" onclick="modifier();">Modifier</button><br></div>
</body> 
</html>