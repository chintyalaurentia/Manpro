<?php 

require_once "../includes/connect.php";
require_once "../includes/check_url.php";

$changed_role = $_POST['a'];
$id = $_POST['b'];

$response = array();

// function findDosen ($dosen){ 
//     global $con;

//     $search_dosen = $con -> prepare("SELECT id FROM `dosen` WHERE nama LIKE ?");
//     $search_dosen -> bind_param("s", $dosen);
//     $search_dosen -> execute();
//     $search_dosen -> bind_result($result_dosen);
//     $search_dosen -> fetch(); 
//     $search_dosen -> close();

//     return $result_dosen;
// }

function checkRole ($id_dosen) {
    global $con;

    $check_dosen_role = $con -> prepare("SELECT `role` FROM `dosen` WHERE id = ?");
    $check_dosen_role -> bind_param("i", $id_dosen);
    $check_dosen_role -> execute();
    $check_dosen_role -> bind_result($result_role);
    $check_dosen_role -> fetch(); 
    $check_dosen_role -> close();

    return $result_role;
}

#cek lagi kenapa update gak jalan

function changeRole ($old_role, $new_role, $id_dosen) {
    global $con;
    
    if ($old_role != $new_role) {
        $role_change = $con -> prepare("UPDATE `dosen` SET `role` = ? WHERE `id` = ?");
        $role_change -> bind_param("ii",$new_role, $id_dosen);
        $tes = $role_change -> execute();
        $role_change -> close();
        return 1;
    } else {
        return 2;
    }
}

$find_role = checkRole($id);
$res = changeRole($find_role, $changed_role, $id);

if ($res == "1") {
    $response = array('title' => "Success", 'text' => "Role berhasil diganti", 'icon' => "success"); 
    echo json_encode($response);
    exit;
} else {
    $response[] = array('title' => "Failed", 'text' => "Role tidak terupdate", 'icon' => "error"); 
    echo json_encode($response);
    exit;
}



?>