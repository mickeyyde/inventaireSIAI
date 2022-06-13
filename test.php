<?php
session_start();
require_once('./include/fBDD.php');
$connex = connexionBDD();

$stock = getStockFromSession($connex, $_SESSION['mail']);

$result = getQteFromStock($connex, $stock);

print('<pre>');
var_dump($result);
print('</pre>');
?>