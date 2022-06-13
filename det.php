<?php
session_start();
require("./include/fBDD.php");
$conn1=connexionBDD();
$r=$conn1->query("SELECT * FROM Materiel WHERE id = ".$_GET['id_materiel'].";")->fetch();

if (isset($_GET['id_proprietaire'])){
    $prop = getPropFromId($conn1, $_GET['id_proprietaire']);
    if(!$prop == false){
        $stock = getStockFromMail($conn1, $prop['mail']);
        $qte = $conn1->query("SELECT * FROM quantite WHERE (ref_mat = ".$_GET['id_materiel']." AND ref_stock = ".$stock['id'].")")->fetch();
    } else {
        $prop = getPropFromMail($conn1, $_SESSION['mail']);
        $stock = getStockFromMail($conn1, $_SESSION['mail']);
        $qte = $conn1->query("SELECT * FROM quantite WHERE (ref_mat = ".$_GET['id_materiel']." AND ref_stock = ".$stock['id'].")")->fetch();
    }
} else {
    $prop = getPropFromMail($conn1, $_SESSION['mail']);
    $stock = getStockFromMail($conn1, $_SESSION['mail']);
    $qte = $conn1->query("SELECT * FROM quantite WHERE (ref_mat = ".$_GET['id_materiel']." AND ref_stock = ".$stock['id'].")")->fetch();
}

if($qte == false){
    $qte = array("qte_ne" => 0, "qte_eo" => 0, "qte_se" => 0);
}





if ($r == false){
    header("Location: ./");
    die();
}








if (isset($_FILES['img_mat']['name'])) {
    $imageName = $_FILES['img_mat']['name'];
    $targetImage = $_SERVER['DOCUMENT_ROOT']."/ressource/imgMat/".basename($_FILES["img_mat"]["name"]);
    $imageExtension = pathinfo($targetImage);
    $extension = array("apng", "bmp", "gif", "ico", "cur", "jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "svg", "tif", "tiff", "webp");

    if(isset($imageExtension['extension'])){
        if (in_array($imageExtension['extension'], $extension)) {
            //updateHistorique($conn1, $date, 'MODIFIER','[<=>] id:['.$r["id"].'] r:'.$r["reference"].' Modification de limage');
            $query = $conn1->prepare("UPDATE materiel SET img = :nom_img WHERE id = :id;");
            $query->bindValue(':nom_img', $imageName, PDO::PARAM_STR);
            $query->bindValue(':id', $r['id'], PDO::PARAM_INT);
            $query->execute();

            if (!file_exists($targetImage)) {
                move_uploaded_file($_FILES['img_mat']['tmp_name'], $targetImage);
            }
        } 
        header("Refresh:0");
        die();
    }      
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
<div class="inline container">
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
                ID BDD: <b><?= $r['id']?></b><br>
                Type: <b><?= $r["type"]?></b><br>
                Marque: <b><?= $r["marque"]?></b><br>
                Reference: <b id="ref"><?= $r["reference"]?></b><br>
                Commentaire: <i class="str2"><?= $r["commentaire"]?></i><br>
                Designation: <b class="str0"><?= $r["designation"]?></b><br>
    </form>
    <br>Image: <?= $r["img"]?>
    <form enctype="multipart/form-data" action="#" method="post">
                <input name="img_mat" type="file"/><br><br>
                <input type="submit" value="ModifierImage"/>
    </form>
</div>
</div>

<div class="inline container2">
    <h3>Stock de <?= $prop['nom']." ".$prop['prenom']; ?></h3>
<div class="text-container2">
    <br>Quantite Totale: <?= $qte['qte_ne'] + $qte['qte_eo'] + $qte['qte_se']?>
    <br><br>
    Neuf : <?= $qte['qte_ne']?><br> 
    Ouvert : <?= $qte['qte_eo']?><br>
    Sans emballage : <?= $qte['qte_se']?><br>
</div>
    
</div>

</body> 
</html>