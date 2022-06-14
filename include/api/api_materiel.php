<?php
session_start();
require("../fBDD.php");
$c = connexionBDD();

$result = rechercheDefault($c);
echo json_encode($result);

?>