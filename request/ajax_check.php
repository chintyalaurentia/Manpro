<?php 

require_once "../includes/connect.php";
require_once "../includes/check_url.php";

$_SESSION["id_dosen"] = 1;

$id_mahasiswa =  $_POST['b'];

$response = array();

function checkDosenResponsible ($mahasiswa) {
    global $con;

    $search_dosen = $con -> prepare("SELECT id_dosen FROM `penguji` WHERE id_mahasiswa = ?");
    $search_dosen-> bind_param("s", $mahasiswa);
    $search_dosen-> execute();
    $search_dosen-> bind_result($result_search_dosen);

    $dosen=array();

    while ($search_dosen->fetch()) {
        array_push($dosen, $result_search_dosen);
    }

    $search_dosen->close();
    
    return $dosen;
}

# check lagi pengecekan

// function checkMahasiswa ($mahasiswa){ 
//     global $con;

//     $search_mahasiswa = $con -> prepare("SELECT count(1) FROM `mahasiswa` WHERE id = ?");
//     $search_mahasiswa -> bind_param("i", $mahasiswa);
//     $search_mahasiswa -> execute();
//     $search_mahasiswa -> bind_result($result_search_mahasiswa);
//     $search_mahasiswa -> fetch(); 
//     $search_mahasiswa -> close();

//     if ($result_search_mahasiswa == 1) {
//         return 1;
//     } 
// }

function approveStatus ($mahasiswa, $dosen){ 
    global $con;

    $approval = $con -> prepare("UPDATE `penilaian` SET `tanggal_acc`= CURRENT_TIMESTAMP WHERE id_mahasiswa = ? AND id_penguji = ?");
    $approval -> bind_param("ss", $mahasiswa, $dosen);
    $approval -> execute();
    $approval -> close();

    if (mysqli_affected_rows($con) == -1) {
        return 1;
    } 
}

function get_date ($mahasiswa, $dosen){ 
    global $con;

    $find_approval = $con -> prepare("SELECT tanggal_acc FROM `penilaian` WHERE id_mahasiswa = ? AND id_penguji = ?");
    $find_approval -> bind_param("ss", $mahasiswa, $dosen);
    $find_approval -> execute();
    $find_approval -> bind_result($result_find_approval);
    $find_approval -> fetch(); 
    $find_approval -> close();

    $fix_date = date("d-m-y",strtotime($result_find_approval));

    if (!is_null($fix_date)) {
        return $fix_date;
    }
}


if (empty($id_mahasiswa) or is_null($id_mahasiswa)) {
    $response = array('title' => "Failed", 'text' => "Data mahasiswa tidak ditemukan", 'icon' => "error"); 
    echo json_encode($response);
    exit;
}

// if (checkMahasiswa($id_mahasiswa) != $id_mahasiswa) {
//     $response = array('title' => "Failed", 'text' => "Data mahasiswa tidak ditemukan", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// }

if (in_array($_SESSION["id_dosen"], checkDosenResponsible($id_mahasiswa)) != 1) {
    $response = array('title' => "Failed", 'text' => "Dosen tidak memiliki akses untuk melakukan ACC", 'icon' => "error"); 
    echo json_encode($response);
    exit;
} 


if (approveStatus($id_mahasiswa, $_SESSION["id_dosen"]) == "1") {
    $response = array('title' => "Success", 'text' => "Skripsi berhasil di ACC", 'icon' => "success", 'date' => get_date($id_mahasiswa,$_SESSION["id_dosen"])); 
    echo json_encode($response);
    exit;
} else {
    $response[] = array('title' => "Failed", 'text' => "Skripsi gagal di ACC, silahkan coba refresh!", 'icon' => "error"); 
    echo json_encode($response);
    exit;
}







?>