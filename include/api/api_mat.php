<?php
require("../fBDD.php");
$c = connexionBDD();

$query = explode("/", $_SERVER["QUERY_STRING"]);

// localhost/include/api_xmax.php?recherche/marque/type

foreach($query as $filtre => $item){
    if($item == ""){
        switch($filtre){
            case 0:
                $recherche = null;
                break;
            case 1:
                $marque = null;
                break;
            case 2:
                $type = null;
                break;
        }
    } else{
        switch($filtre){
            case 0:
                $recherche = $item;
                break;
            case 1:
                $marque = $item;
                break;
            case 2:
                $type = $item;
                break;
        }
    }
}

switch($recherche){
    case null:
        switch($marque){
            case null:
                switch($type){
                    case null: //------------------------------------------------null/null/null------------------------------------------------
                        $rArr = rechercheDefault($c);
                        $arrJSON = json_encode($rArr);
                        echo $arrJSON;
                        break;

                    default: //------------------------------------------------null/null/...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE type ~ '".$type."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"],   3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break;
                }
                break;

            default: 
                switch($type){
                    case null: //------------------------------------------------null/.../null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE marque ~ '".$marque."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break;

                    default: //------------------------------------------------null/.../...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (marque ~ '".$marque."' AND type ~ '".$type."' );")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 
                }
                break;
        }
        break;

    default: 
        switch($marque){
            case null:
                switch($type){
                    case null: //------------------------------------------------.../null/null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE reference ~ '".$recherche."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 

                    default: //------------------------------------------------.../null/...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND type ~ '".$type."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 
                    
                }
                break;

            default:
                switch($type){
                    case null: //------------------------------------------------.../.../null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND marque ~ '".$marque."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 

                    default: //------------------------------------------------.../.../...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND marque ~ '".$marque."' AND type ~ '".$type."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["type"], 1 => $ligne["marque"], 2 => $ligne["reference"], 3 => $ligne['designation'], 4 => $ligne['id']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                     break; 
                }
                break;
        }
        break;
}
