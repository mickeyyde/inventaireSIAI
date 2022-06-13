<?php
session_start();
require_once("./fBDD.php");
$c = connexionBDD();

$stock = getStockFromSession($c,$_SESSION['mail']);
$result = getQteFromStock($c, $stock);

echo json_encode($result);
?>