<?php
    require_once("fBDD.php");
    $conn1=connexionBDD();
    print("<a href='./'>accueil</a>");     print("<br>"); print("<br>"); print("<br>");

    $r=$conn1->query("SELECT * FROM Materiel WHERE id_materiel = ".$_GET['id_materiel'].";")->fetch();
    var_dump($r);
?>