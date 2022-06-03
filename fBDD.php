<?php
function connexionBDD(){
    try{
        $connex = new PDO("pgsql:host=localhost options='--client_encoding=UTF8';dbname=postgres;port=5432","postgres","postgres");
        //print "Connecté :)<br/>";
    } catch (PDOException $e) {
        print "Erreur de connexion à la base de donnée: ".$e->getMessage();
        die();
    }
    return $connex;
}

function ListeMarque($c){ 
    $rMarque=$c->query("SELECT nom_marque FROM Marque ORDER BY nom_marque;");
    return $rMarque;
}

function AjouterMateriel($c, $des, $ma, $ref, $qte){
    $r=$c->query("SELECT * FROM Materiel WHERE reference = '".$ref."';")->fetch();
    //var_dump($id);
    if(!$r == false){
        $c->query("UPDATE materiel SET  qte = (qte + ".$qte.") WHERE reference = '".$ref."';");
        header("Location: ./det.php?id_materiel=".$r['id_materiel']);
        die();
    } else {
        $c->query("INSERT INTO Materiel VALUES(DEFAULT, '".$des."', '".$ma."', '".$ref."', ".$qte.");");
        $r = $c->query("SELECT * FROM Materiel WHERE reference = '".$ref."';")->fetch();
        header("Location: ./det.php?id_materiel=".$r['id_materiel']);
        die();
    }
    
    //a modifier -> les header ne devrait pas être dans la fonction, plutôt retourner le $id
}

function RetirerMateriel($c, $ref, $qte){
    $r=$c->query("SELECT * FROM Materiel WHERE reference = '".$ref."';")->fetch();
    if(!$r == false){
        if(($r['qte'] - $qte) < 0){
            header("Location: ./");
            die();
        } else {
            $c->query("UPDATE materiel SET  qte = (qte - ".$qte.") WHERE reference = '".$ref."';");
            header("Location: ./det.php?id_materiel=".$r['id_materiel']);
            die();
        }
    } else {
        header("Location: ./");
        die();
    }


    //a modifier -> les header ne devrait pas être dans la fonction, plutôt retourner le $id
}

function rechercheDefault($conn){
    $rMat=$conn->query("SELECT * FROM Materiel ORDER BY id_materiel;")->fetchAll();
            $arr = array();
            foreach($rMat as $ligne) {
                array_push($arr,array(0 => $ligne["designation"], 1 => $ligne["ref_marque"], 2 => $ligne["reference"], 3 => $ligne["qte"], 4 => $ligne['id_materiel'])); 
            }
        return $arr;    
}

?>      