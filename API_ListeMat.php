<?php
require_once("fBDD.php");
$c = connexionBDD();

if (isset($_GET["recherche"])){
    switch ($_GET["recherche"]) {
        case "":
            $rArr = rechercheDefault($c);
            $arrJSON = json_encode($rArr);
            echo $arrJSON;

            break;
        default:
            $rMat=$c->query("SELECT * FROM Materiel WHERE reference ~ '".$_GET["recherche"]."';")->fetchAll();
            $arr = array();
            foreach($rMat as $ligne) {
                array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
            } 
            $arrJSON = json_encode($arr);  
            echo $arrJSON;
    }
}else {
            $rArr = rechercheDefault($c);
            $arrJSON = json_encode($rArr);
            echo $arrJSON;
}
?>