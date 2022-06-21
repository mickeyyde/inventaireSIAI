<?php
require_once("../fBDD.php");
$conn = connexionBDD();

switch($_SERVER["QUERY_STRING"]){
    default:
        $rMat=$conn->query("SELECT * FROM log ORDER BY date DESC;")->fetchAll();
        $arr = array();
        foreach($rMat as $ligne) {
            $prop = getPropFromId($conn, $ligne["auteur"]);
            array_push($arr,array(0 => $prop['nom']." ".$prop['nom'], 1 => $ligne["date"], 2 => $ligne["action"], 3 => $ligne["detail"])); 
        }
        echo json_encode($arr);  
        break;
}
?>