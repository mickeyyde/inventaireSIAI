<?php
require_once("./fBDD.php");
$conn1=connexionBDD(); 

if (isset($_GET['P_marque'])){
    $marque = $_GET['P_marque'];
    $ref = $_GET['P_ref'];
    $qte = (int)$_GET['P_qte'];
    $des = $_GET['P_des'];

    AjouterMateriel($conn1, $des, $marque, $ref, $qte);
} else{
    $ref = $_GET['P_ref'];
    $qte = (int)$_GET['P_qte'];

    RetirerMateriel($conn1, $ref, $qte);
}
?>