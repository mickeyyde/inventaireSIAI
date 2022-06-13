<?php
session_start();
require("./fBDD.php");
$c = connexionBDD();

$stock = getStockFromId($c, $_GET['id']);
$result = getQteFromStock($c, $stock);

echo json_encode($result);
?>