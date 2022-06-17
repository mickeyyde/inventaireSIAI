<?php
session_start();
require("./include/fBDD.php");
$conn1=connexionBDD();
$r=$conn1->query("SELECT * FROM Materiel WHERE id = ".$_GET['id_materiel'].";")->fetch();
if ($r == false){
    header("Location: ./");
    die();
}
if(isset($_GET["stock"])){
    $InStock = ListeContenir($conn1, $_GET['id_materiel'], $_GET["stock"]);
}else{
    $InStock = ListeContenir($conn1, $_GET['id_materiel'], null);
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
<div class="wrapper">
<div class="container" id='div1'>
<?php
if(is_null($r['img'])){
    print("<img src='./ressource/imgNull.png' alt='imgNull.png'>");
}else{
    print("<img src='./ressource/imgMat/".$r['img']."' alt='".$r['img']."'>");
}
?>
  <div class="text-container">
  <form action="./include/action.php" method="get" id="formDet">
                <input name='ACTION' type='hidden' value='modifierMAT'/>
                <input name='M_idmat' id='idmat' type='hidden' value='<?= $r['id']?>'/>
                ID BDD: <b><?= $r['id']?></b><br>
                Type: <b class="str0"><?= $r["type"]?></b><br>
                Marque: <b><?= $r["marque"]?></b><br>
                Reference: <b id="ref"><?= $r["reference"]?></b><br>
                Commentaire: <i class="str1"><?= $r["commentaire"]?></i><br>
                Designation: <b class="str2"><?= $r["designation"]?></b><br>
    </form>
    <button id="modifmat" class="button button2" onclick='modifiermat()'>Modifier</button>  
</div>
<form id="formimg"enctype="multipart/form-data" action="" method="post">
                <input name="img_mat" type="file"/><input type="submit" value="ModifierImage"/><br><br>
                Image: <?= $r["img"]?>
                
    </form>
</div>

<div class="container" id='div2'>
  <div class="text-container">
    <form action="./include/action.php" method="get" id="formStock">
    <input type='text' hidden name='ACTION' value='modifierQTE'>
    <input type='text' hidden name='M_idmat' value='<?= $_GET['id_materiel'] ?>'>
    <?php
    if(isset($_GET['stock'])){
        $getstock = getstockfromid($conn1, $_GET['stock']);
        if($getstock != false){
            $stockprop = getPropFromId($conn1, $getstock['ref_proprietaire']);
            $sql = "SELECT * FROM quantite WHERE (ref_stock = ".$getstock['id']." AND ref_materiel =".$_GET['id_materiel'].");";
            $getqte=$conn1->query($sql)->fetch();
            print("<input type='text' hidden name='M_idstock' value='".$getstock['id']."'>");
            print("<b>[".$getstock['id']."] ".$getstock['nom']."</b><br><br>");
            print("Proprietaire: <i>".$stockprop['nom']." ".$stockprop['prenom']."</i><br><br>");
            print("QTE TOTALE: ".$getqte['qte_ne']+$getqte['qte_eo']+$getqte['qte_se']."<br><br>");
            print("QTE NEUF: <b class='qte0'>".$getqte['qte_ne']."</b><br>");
            print("QTE EMBALLAGE OUVERT: <b class='qte1'>".$getqte['qte_eo']."</b><br>");
            print("QTE SANS EMBALLAGE: <b class='qte2'>".$getqte['qte_se']."</b><br><br>");
            print("<button id='modifstock' onclick='modifierstock();' class='button button2'>Editer</button>");
    }
}
    ?>
    </form> <input type="text" hidden name="M_idstock" value="">
  </div>
</div>
</div>

<footer>
    <h3>Qui d'autre possède ce matériel?</h3>
    <div class=swipe>
        <?php 
            foreach($InStock as $ligne){
                $tempstock = getStockFromId($conn1, $ligne['ref_stock']);
                $tempprop = getPropFromId($conn1, $tempstock['ref_proprietaire']);
                print("<a href='./det.php?id_materiel=".$_GET['id_materiel']."&stock=".$tempstock['id']."'><div class='box'><div class='text'>");
                print($tempprop['nom']." ".$tempprop['prenom']." : [".$tempstock['id']."] ".$tempstock['nom']."<br><br>");
                print("QTE TOTALE: ".$ligne['qte_ne']+$ligne['qte_eo']+$ligne['qte_se']."<br><br>");
                print("QTE NEUF: ".$ligne['qte_ne']."<br>");
                print("QTE EMBALLAGE OUVERT: ".$ligne['qte_eo']."<br>");
                print("QTE SANS EMBALLAGE: ".$ligne['qte_se']."<br><br>");
                if(($ligne['commentaire'] == "")){
                    print("&nbspg ");
                }else{
                    print($ligne['commentaire']);
                } 
                print("</div></div></a>");
            }
        ?>
    </div>
</footer>
<script src='./js/index2.js'></script>
</body> 
</html>