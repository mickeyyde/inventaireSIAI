<?php
require_once("./fBDD.php");
$conn = connexionBDD();

switch($_SERVER["QUERY_STRING"]){
    default:
        $rMat=$conn->query("SELECT * FROM historique ORDER BY date DESC;")->fetchAll();
        $arr = array();
        foreach($rMat as $ligne) {
            array_push($arr,array(0 => $ligne["action"], 1 => $ligne["date"], 2 => $ligne["detail"])); 
        }
        echo json_encode($arr);  
        break;
}
?>