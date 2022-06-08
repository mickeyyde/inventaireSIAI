<?php
require_once("./fBDD.php");
$conn1=connexionBDD(); 

if (isset($_GET['M_des'])){
    $id = $_GET['M_id'];
    $des = $_GET['M_des'];
    $qte = (int)$_GET['M_qte'];
    $carac = $_GET['M_carac'];
    $com = $_GET['M_com'];
    ModifierMateriel($conn1, $des, $qte, $carac, $com, $id);
    header("Location: ./det.php?id_materiel=".$id);
}
if (isset($_GET['P_marque'])){
    $marque = $_GET['P_marque'];
    $qte = (int)$_GET['P_qte'];
    $des = $_GET['P_des'];
    $ref = $_GET['P_ref'];

    AjouterMateriel($conn1, $des, $marque, $ref, $qte);
} else if(isset($_GET['D_1'])){
    $ref = $_GET['ref'];
    $conn1->query("DELETE FROM materiel where reference = '".$_GET['ref']."';");
}else{
    $ref = $_GET['P_ref'];
    $qte = (int)$_GET['P_qte'];

    RetirerMateriel($conn1, $ref, $qte);
}
?>