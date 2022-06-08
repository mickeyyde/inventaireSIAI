<?php
require_once("./fBDD.php");
$c = connexionBDD();

$query = explode("/", $_SERVER["QUERY_STRING"]);

// localhost/include/api_xmax.php?recherche/marque/designation

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
                $designation = null;
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
                $designation = $item;
                break;
        }
    }
}

switch($recherche){
    case null:
        switch($marque){
            case null:
                switch($designation){
                    case null: //------------------------------------------------null/null/null------------------------------------------------
                        $rArr = rechercheDefault($c);
                        $arrJSON = json_encode($rArr);
                        echo $arrJSON;
                        break;

                    default: //------------------------------------------------null/null/...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE designation ~ '".$designation."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break;
                }
                break;

            default: 
                switch($designation){
                    case null: //------------------------------------------------null/.../null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE ref_marque ~ '".$marque."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break;

                    default: //------------------------------------------------null/.../...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (ref_marque ~ '".$marque."' AND designation ~ '".$designation."' );")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
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
                switch($designation){
                    case null: //------------------------------------------------.../null/null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE reference ~ '".$recherche."';")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 

                    default: //------------------------------------------------.../null/...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND designation ~ '".$designation."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 
                    
                }
                break;

            default:
                switch($designation){
                    case null: //------------------------------------------------.../.../null------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND ref_marque ~ '".$marque."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                        break; 

                    default: //------------------------------------------------.../.../...------------------------------------------------
                        $rMat=$c->query("SELECT * FROM Materiel WHERE (reference ~ '".$recherche."' AND ref_marque ~ '".$marque."' AND designation ~ '".$designation."');")->fetchAll();
                        $arr = array();
                        foreach($rMat as $ligne) {
                            array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel']));
                        } 
                        $arrJSON = json_encode($arr);  
                        echo $arrJSON;
                     break; 
                }
                break;
        }
        break;
}
