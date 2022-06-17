<?php
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
    
    case 'supprimerMAT':
        $id = $_GET['S_id'];
        $conn1->query("DELETE FROM materiel where id = ".$id.";");
        //updateHistorique($conn1, $date,'SUPPRIMER','[X] idBDD:['.$r["id_materiel"].'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location:../');
        break;

    case 'supprimer_marque':
        $marque = $_GET['SUPP_marque'];
        $r=$conn1->query("SELECT * FROM marque where nom_marque = '".$marque."';")->fetch();
        updateHistorique($conn1, $date,'SUPPRIMER','[X] idBDD:['.$r["id_marque"].'] m:'.$r["nom_marque"]);
        $conn1->query("DELETE FROM marque where id_marque = ".$r['id_marque'].";");
        header('Location:../');
        break;

    case 'new_marque':
        $marque = strtoupper($_GET['N_marque']);
        $r=$conn1->query("INSERT INTO marque VALUES(DEFAULT, '".$marque."');");
        updateHistorique($conn1, $date,'AJOUTER','Nouvelle marque: '.$marque.'');
        header('Location:../');
        break;

    default;
}
}

if(isset($_POST['idstock'])){
    $conn1->query("DELETE FROM stock WHERE id='".$_POST['idstock']."';");
    header('Location:../profil.php');
    die();
}
?>