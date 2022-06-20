<?php
session_start();
if (!isset($_SESSION['id'])){
    header("Location: ./pageCon.php");
    die();
}
require("./fBDD.php");
$conn1=connexionBDD();
date_default_timezone_set('Europe/Paris');
$getDate = getdate();
$date = $getDate['year']."-".$getDate['mon']."-".$getDate['mday']." ". $getDate['hours'].":".$getDate['minutes'].":".$getDate['seconds'];

if(isset($_GET['ACTION'])){
switch($_GET['ACTION']){
    case 'modifierQTE':
        $idmat = $_GET['M_idmat'];
        $idstock = $_GET['M_idstock'];
        $ne = $_GET['M_ne'];
        $eo = (int)$_GET['M_eo'];
        $se = $_GET['M_se'];
        updateQTE($conn1, $idstock, $idmat, $ne, $eo, $se);
        //updateHistorique($conn1, $date, 'MODIFIER','[<=>] idBDD:['.$id.'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location: ../det.php?id_materiel='.$idmat.'&stock='.$idstock);
        break;

    case 'modifierMAT':
        $idmat = $_GET['M_idmat'];
        $type = $_GET['M_type'];
        $com = $_GET['M_com'];
        $des = $_GET['M_des'];
        updateMAT($conn1, $idmat, $type, $com, $des);
        //updateHistorique($conn1, $date, 'MODIFIER','[<=>] idBDD:['.$id.'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location: ../det.php?id_materiel='.$idmat);
        break;

    case 'newMAT':
        $ref = $_GET['A_ref'];
        $r=$conn1->query("SELECT * FROM Materiel WHERE reference = '".$ref."';")->fetch();
        if($r == false){
            $conn1->query("INSERT INTO Materiel VALUES(DEFAULT, '".$_GET['A_marque']."', '".$ref."', '".$_GET['A_type']."', '', '', '');");
        }
        break;
    
    case 'supprimerMAT':
        $id = $_GET['S_idmat'];
        $conn1->query("DELETE FROM materiel where id = ".$id.";");
        //updateHistorique($conn1, $date,'SUPPRIMER','[X] idBDD:['.$r["id_materiel"].'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location:../');
        break;

    case 'supprimerMATfromSTOCK':
        $conn1->query("DELETE FROM quantite where (ref_materiel = ".$_GET['S_matid']." AND ref_stock = ".$_GET['S_stockid'].");");
        break;
    
    case 'newSTOCK':
        $nom = $_GET['nom'];
        $conn1->query("INSERT INTO stock VALUES(DEFAULT, '".$nom."', '".$_SESSION['id']."' )");
        break;

    case 'addSTOCK':
        $r = $conn1->query("SELECT * FROM quantite WHERE (ref_materiel = ".$_GET['aS_idmat']." AND ref_stock = ".$_GET['aS_idstock'].")")->fetch();
        if($r == false){
            $conn1->query("INSERT INTO quantite VALUES(".$_GET['aS_idmat'].", ".$_GET['aS_idstock'].", ".$_GET['aS_qte_ne'].", ".$_GET['aS_qte_eo'].", ".$_GET['aS_qte_se'].")");
        }else{
            $conn1->query("UPDATE quantite SET qte_ne = qte_ne + ".$_GET['aS_qte_ne'].", qte_eo = qte_eo + ".$_GET['aS_qte_eo'].", qte_se = qte_se + ".$_GET['aS_qte_se']." WHERE (ref_materiel = ".$_GET['aS_idmat']." AND ref_stock = ".$_GET['aS_idstock'].")");
        }
        break;

    case 'supprimer_marque':
        $marque = $_GET['SUPP_marque'];
        //$conn1->query("SELECT * FROM marque where nom_marque = '".$marque."';")->fetch();
        //updateHistorique($conn1, $date,'SUPPRIMER','[X] idBDD:['.$r["id_marque"].'] m:'.$r["nom_marque"]);
        $conn1->query("DELETE FROM marque where id = '".$marque."';");
        header('Location:../');
        break;

    case 'new_marque':
        $marque = strtoupper($_GET['N_marque']);
        $conn1->query("INSERT INTO marque VALUES(DEFAULT, '".$marque."');");
        //updateHistorique($conn1, $date,'AJOUTER','Nouvelle marque: '.$marque.'');
        header('Location:../');
        break;

    default:
        header('Location: ../');
        break;
}
}

if(isset($_POST['idstock'])){
    $conn1->query("DELETE FROM stock WHERE id='".$_POST['idstock']."';");
    header('Location:../profil.php');
    die();
}
?>