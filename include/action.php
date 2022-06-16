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
        $idstock = $_GET['M_idstock'];
        $ne = $_GET['M_ne'];
        $eo = (int)$_GET['M_eo'];
        $se = $_GET['M_se'];
        updateQTE($conn1, $idstock, $idmat, $ne, $eo, $se);
        //updateHistorique($conn1, $date, 'MODIFIER','[<=>] idBDD:['.$id.'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location: ../det.php?id_materiel='.$idmat.'&stock='.$idstock);
        break;

    case 'ajouter':
        $marque = $_GET['A_marque'];
        $qte = (int)$_GET['A_qte'];
        $des = $_GET['A_des'];
        $ref = strtoupper($_GET['A_ref']);
        $id = AjouterMateriel($conn1, $des, $marque, $ref, $qte);
        updateHistorique($conn1, $date,'AJOUTER','[+] idBDD:['.$id.'] m:'.$marque.' r:'.$ref.'');
        header('Location:../det.php?id_materiel='.$id);
        break;
    
    case 'retirer':
        $r=$conn1->query("SELECT * FROM materiel where reference = '".$ref."';")->fetch();
        $ref = strtoupper($_GET['R_ref']);
        $qte = (int)$_GET['R_qte'];
        $id = RetirerMateriel($conn1, $ref, $qte);
        updateHistorique($conn1, $date,'RETIRER','[-] idBDD:['.$id.'] m:'.$r["ref_marque"].' r:'.$ref.'');
        header('Location:../det.php?id_materiel='.$id);
        break;

    case 'supprimer':
        $ref = $_GET['S_ref'];
        $r=$conn1->query("SELECT * FROM materiel where reference = '".$ref."';")->fetch();
        updateHistorique($conn1, $date,'SUPPRIMER','[X] idBDD:['.$r["id_materiel"].'] m:'.$r["ref_marque"].' r:'.$ref.'');
        deleteMat($conn1, $r['id_materiel']);
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
?>