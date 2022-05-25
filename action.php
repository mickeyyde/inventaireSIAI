<?php
require_once("./fBDD.php");
$conn1=connexionBDD(); 

$marque = $_GET['P_marque'];
$ref = $_GET['P_ref'];
$qte = (int)$_GET['P_qte'];

AjouterMateriel($conn1, $marque, $ref, $qte);
?>