<?php
function connexionBDD(){
    try{
        $connex = new PDO("pgsql:host=localhost options='--client_encoding=UTF8';dbname=postgres;port=5432","postgres","postgres");
        print "Connecté :)<br/>";
    } catch (PDOException $e) {
        print "Erreur de connexion à la base de données ! : ".$e->getMessage();
        die();
    }
    return $connex;
}

function ListeMarque($c){
    $rMarque=$c->query("SELECT nom_marque FROM Marque ORDER BY nom_marque;");
    return $rMarque;
}

function ListeMateriel($c){
    $rMat=$c->query("SELECT * FROM Materiel");
    return $rMat;
}

function AjouterMateriel($c, $ma, $ref, $qte){
    $r=$c->query("SELECT * FROM Materiel WHERE reference_materiel = '".$ref."';")->fetch();
    //var_dump($id);
    if(!$r == false){
        $c->query("UPDATE materiel SET  quantite = (quantite + ".$qte.") WHERE reference_materiel = '".$ref."';");
        header("Location: ./det.php?id_materiel=".$r['id_materiel']);
        die();
    } else {
        $c->query("INSERT INTO Materiel VALUES(DEFAULT, '".$ma."', '".$ref."', ".$qte.");");
        $r = $c->query("SELECT * FROM Materiel WHERE reference_materiel = '".$ref."';")->fetch();
        header("Location: ./det.php?id_materiel=".$r['id_materiel']);
        die();
    }
    
    //a modifier -> les header ne devrait pas être dans la fonction, plutôt retourner le $id
}

function RetirerMateriel($c, $ref, $qte){
    $r=$c->query("SELECT * FROM Materiel WHERE reference_materiel = '".$ref."';")->fetch();
    if(!$r == false){
        if(($r['quantite'] - $qte) < 0){
            header("Location: ./");
            die();
        } else {
            $c->query("UPDATE materiel SET  quantite = (quantite - ".$qte.") WHERE reference_materiel = '".$ref."';");
            header("Location: ./det.php?id_materiel=".$r['id_materiel']);
            die();
        }
    } else {
        header("Location: ./");
        die();
    }


    //a modifier -> les header ne devrait pas être dans la fonction, plutôt retourner le $id
}
?>      