<?php 

require_once "../includes/connect.php";
// require_once "../includes/check_url.php";

$id_mahasiswa = $_POST['b'];

$response = array();

function checkMahasiswa ($mahasiswa){ 
    global $con;

    $search_mahasiswa = $con -> prepare("SELECT count(1) FROM `mahasiswa` WHERE id = ?");
    $search_mahasiswa -> bind_param("i", $mahasiswa);
    $search_mahasiswa -> execute();
    $search_mahasiswa -> bind_result($result_search_mahasiswa);
    $search_mahasiswa -> fetch(); 
    $search_mahasiswa -> close();

    if ($result_search_mahasiswa == 1) {
        return 1;
    } 
}

if (checkMahasiswa($id_mahasiswa) == 1) {
    $_SESSION["id_mahasiswa"] = $id_mahasiswa;
    $response = array('title' => "Loading", 'text' => "Redirecting...", 'icon' => "warning"); 
    echo json_encode($response);
    exit;
} else {
    $response = array('title' => "Failed", 'text' => "Data mahasiswa tidak bisa di akses!", 'icon' => "error"); 
    echo json_encode($response);
    exit;
}

?>