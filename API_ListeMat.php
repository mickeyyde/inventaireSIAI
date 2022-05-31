<?php
require_once("fBDD.php");
$c = connexionBDD();

if (isset($_GET["recherche"])){
    switch ($_GET["recherche"]) {
        case "":
            $rMat=$c->query("SELECT * FROM Materiel ORDER BY id_materiel;")->fetchAll();
            $arr = array();
            foreach($rMat as $ligne) {
                array_push($arr,array(0 => $ligne["marque_materiel"], 1 => $ligne["reference_materiel"], 2 => $ligne["quantite"])); 
            }    
            $arrJSON = json_encode($arr);
            echo $arrJSON;

            break;
        default:
            $rMat=$c->query("SELECT * FROM Materiel WHERE reference_materiel ~ '".$_GET["recherche"]."';")->fetchAll();
            $arr = array();
            foreach($rMat as $ligne) {
                array_push($arr,array(0 => $ligne["marque_materiel"], 1 => $ligne["reference_materiel"], 2 => $ligne["quantite"]));
            } 
            $arrJSON = json_encode($arr);  
            echo $arrJSON;
    }
}else {
            $rMat=$c->query("SELECT * FROM Materiel ORDER BY id_materiel;")->fetchAll();
            $arr = array();
            foreach($rMat as $ligne) {
                array_push($arr,array(0 => $ligne["marque_materiel"], 1 => $ligne["reference_materiel"], 2 => $ligne["quantite"])); 
            }    
            $arrJSON = json_encode($arr);
            echo $arrJSON;
}




// faire une fonction query($sql)
?>