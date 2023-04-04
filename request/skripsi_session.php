<?php 
    require_once "../includes/connect.php";
    
    $getnrp = $_GET["nrp"];
    $_SESSION['nrp'] = $getnrp;
    header('Location: ../skripsi.php');
    exit;

?>