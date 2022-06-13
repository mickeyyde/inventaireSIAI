<?php
session_start();
require_once('./fBDD.php');
$connex = connexionBDD();

if (isset($_POST['mail'])){
    $sql = "SELECT * FROM proprietaire WHERE mail = '".$_POST['mail']."'";
    $r = $connex->query($sql)->fetch();

    if ($r != false){
        $_SESSION['mail'] = $r['mail'];
        header('Location: ../index.php');
        die();
    } else {
        header('Location: ../pageCon.php');
        die();
    }
} else {
    header('Location: ../pageCon.php');
    die();
}
?>