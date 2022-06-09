<?php
require_once("./fBDD.php");
$conn1=connexionBDD(); 

switch($_GET['ACTION']){
    case 'modifier':
        $id = $_GET['M_id'];
        $des = $_GET['M_des'];
        $qte = (int)$_GET['M_qte'];
        $carac = $_GET['M_carac'];
        $com = $_GET['M_com'];
        ModifierMateriel($conn1, $des, $qte, $carac, $com, $id);
        header('Location: ../det.php?id_materiel='.$id);
        break;

    case 'ajouter':
        $marque = $_GET['A_marque'];
        $qte = (int)$_GET['A_qte'];
        $des = $_GET['A_des'];
        $ref = strtoupper($_GET['A_ref']);
        $id = AjouterMateriel($conn1, $des, $marque, $ref, $qte);
        header('Location:../det.php?id_materiel='.$id);
        break;
    
    case 'retirer':
        $ref = strtoupper($_GET['R_ref']);
        $qte = (int)$_GET['R_qte'];
        $id = RetirerMateriel($conn1, $ref, $qte);
        header('Location:../det.php?id_materiel='.$id);
        break;

    case 'supprimer':
        $ref = $_GET['S_ref'];
        $conn1->query("DELETE FROM materiel where reference = '".$_GET['S_ref']."';");
        header('Location:../');
        break;

    default;
}
?>