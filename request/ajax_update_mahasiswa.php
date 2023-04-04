<?php 

require_once "../includes/connect.php";
require_once "../includes/check_url.php";

$id_mahasiswa = $_POST['i'];
$nama_mahasiswa = $_POST['j'];
$nrp_mahasiswa =  $_POST['k'];
$jurusan =  $_POST['l'];
$tanggal_skripsi = $_POST['m'];
$jam_skripsi = $_POST['n'];
$judul_skripsi =  $_POST['o'];
$ruangan =  $_POST['p'];
$ketua = $_POST['q'];
$anggota = $_POST['r'];
$pembimbing_1 =  $_POST['s'];
$pembimbing_2 = $_POST['t'];

$search_mahasiswa = $con -> prepare("SELECT count(*) FROM `mahasiswa` WHERE id = ?");
$search_mahasiswa -> bind_param("i", $id_mahasiswa);
$search_mahasiswa -> execute();
$search_mahasiswa -> bind_result($result_search_mahasiswa);
$search_mahasiswa -> fetch(); 
$search_mahasiswa -> close();

if ($result_search_mahasiswa != 1) {
    $response[] = array('title' => "Failed", 'text' => "Mahasiswa tidak teregister", 'icon' => "error"); 
    echo json_encode($response);
    exit;
} 

# check name

$check_name= $con -> prepare("SELECT `nama`, `nrp`,`id_jurusan`, `tanggal_skripsi`, `judul_skripsi`, `ruangan_skripsi` FROM `mahasiswa` WHERE id = ?");
$check_name -> bind_param("i", $id_mahasiswa);
$check_name -> execute();
$check_name -> bind_result($result_name, $result_nrp, $result_jurusan, $result_tanggal, $result_title, $result_room);
$check_name -> fetch(); 
$check_name -> close();

if ($nama_mahasiswa != $result_name) {
    $name_change = $con -> prepare("UPDATE `mahasiswa` SET `nama` = ? WHERE `id` = ?");
    $name_change -> bind_param("si",$nama_mahasiswa, $id_mahasiswa);
    $name_change -> execute();
    $name_change -> close();
}

# check nrp

if (strlen($result_nrp) == 8 || strlen($result_nrp) == 9) {
    if ($nrp_mahasiswa != $result_nrp) {
        $nrp_change = $con -> prepare("UPDATE `mahasiswa` SET `nrp` = ? WHERE `id` = ?");
        $nrp_change -> bind_param("si",$nrp_mahasiswa, $id_mahasiswa);
        $nrp_change -> execute();
        $nrp_change -> close();
    }
}

# check jurusan

$check_jurusan= $con -> prepare("SELECT `id` FROM `jurusan` WHERE id = ?");
$check_jurusan -> bind_param("i", $jurusan);
$check_jurusan -> execute();
$check_jurusan -> bind_result($result_jurusan_db);
$check_jurusan -> fetch(); 
$check_jurusan -> close();

if ($jurusan != $result_jurusan && $jurusan != 'null') {
    $jurusan_change = $con -> prepare("UPDATE `mahasiswa` SET `id_jurusan` = ? WHERE `id` = ?");
    $jurusan_change -> bind_param("ii",$result_jurusan_db, $id_mahasiswa);
    $jurusan_change -> execute();
    $jurusan_change -> close();
}

# check tanggal dan jam

$combine = $tanggal_skripsi . " " . $jam_skripsi;

if ($combine != $result_tanggal) {
    $tanggal_change = $con -> prepare("UPDATE `mahasiswa` SET `tanggal_skripsi` = ? WHERE `id` = ?");
    $tanggal_change -> bind_param("si",$combine, $id_mahasiswa);
    $tanggal_change -> execute();
    $tanggal_change -> close();
}

# check judul

if ($judul_skripsi != $result_title) {
    $title_change = $con -> prepare("UPDATE `mahasiswa` SET `judul_skripsi` = ? WHERE `id` = ?");
    $title_change -> bind_param("si",$judul_skripsi, $id_mahasiswa);
    $title_change -> execute();
    $title_change -> close();
}

# check ruangan

if ($ruangan != $result_room) {
    $room_change = $con -> prepare("UPDATE `mahasiswa` SET `ruangan_skripsi` = ? WHERE `id` = ?");
    $room_change -> bind_param("si",$ruangan, $id_mahasiswa);
    $room_change -> execute();
    $room_change -> close();
}

# check ketua

$check_dosen_ketua= $con -> prepare("SELECT `id_dosen` FROM `penguji` JOIN mahasiswa ON penguji.id_mahasiswa = mahasiswa.id WHERE id_mahasiswa = ? AND id_jabatan = 1");
$check_dosen_ketua -> bind_param("i", $id_mahasiswa);
$check_dosen_ketua -> execute();
$check_dosen_ketua -> bind_result($result_ketua);
$check_dosen_ketua -> fetch(); 
$check_dosen_ketua -> close();

if ($result_ketua != $ketua) {
    $ketua_change = $con -> prepare("UPDATE `penguji` SET `id_dosen` = ? WHERE `id_mahasiswa` = ? AND `id_jabatan` = 1");
    $ketua_change -> bind_param("ii",$ketua, $id_mahasiswa);
    $ketua_change -> execute();
    $ketua_change -> close();

    $ketua_change_penilaian = $con -> prepare("UPDATE `penilaian` SET `id_penguji` = ? WHERE `id_penguji` = ? AND `id_mahasiswa` = ?");
    $ketua_change_penilaian -> bind_param("iii",$ketua, $result_ketua, $id_mahasiswa);
    $ketua_change_penilaian -> execute();
    $ketua_change_penilaian -> close();

}

# check anggota

$check_dosen_anggota= $con -> prepare("SELECT `id_dosen` FROM `penguji` JOIN mahasiswa ON penguji.id_mahasiswa = mahasiswa.id WHERE id_mahasiswa = ? AND `id_jabatan` = 2");
$check_dosen_anggota -> bind_param("i", $id_mahasiswa);
$check_dosen_anggota -> execute();
$check_dosen_anggota -> bind_result($result_anggota);
$check_dosen_anggota -> fetch(); 
$check_dosen_anggota -> close();

if ($result_anggota != $anggota) {
    $anggota_change = $con -> prepare("UPDATE `penguji` SET `id_dosen` = ? WHERE `id_mahasiswa` = ? AND `id_jabatan` = 2");
    $anggota_change -> bind_param("ii",$anggota, $id_mahasiswa);
    $anggota_change -> execute();
    $anggota_change -> close();

    $anggota_change_penilaian = $con -> prepare(" UPDATE `penilaian` SET `id_penguji` = ? WHERE `id_penguji` = ? AND `id_mahasiswa` = ?");
    $anggota_change_penilaian -> bind_param("iii",$anggota, $result_anggota, $id_mahasiswa);
    $anggota_change_penilaian -> execute();
    $anggota_change_penilaian -> close();
}

# check pembimbing

$check_pembimbing_satu = $con->prepare("SELECT id_dosen FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = ? AND penguji.id_jabatan = 3 ORDER BY penguji.id ASC LIMIT 1");
$check_pembimbing_satu -> bind_param("i", $id_mahasiswa);
$check_pembimbing_satu->execute();
$check_pembimbing_satu->bind_result($result_pembimbing_satu);
$check_pembimbing_satu->fetch();
$check_pembimbing_satu->close();

if ($result_pembimbing_satu != $pembimbing_1 && $pembimbing_1 != 'null') {
    $pembimbing1_change = $con -> prepare("UPDATE `penguji` SET `id_dosen` = ? WHERE `id_dosen` = ? AND `id_mahasiswa` = ? AND `id_jabatan` = 3 ORDER BY id_dosen ASC LIMIT 1");
    $pembimbing1_change -> bind_param("iii",$pembimbing_1, $result_pembimbing_satu, $id_mahasiswa);
    $pembimbing1_change -> execute();
    $pembimbing1_change -> close();

    $pembimbing1_change_penilaian = $con -> prepare("UPDATE `penilaian` SET `id_penguji` = ? WHERE `id_penguji` = ? AND `id_mahasiswa` = ? ORDER BY id_penguji ASC LIMIT 1");
    $pembimbing1_change_penilaian -> bind_param("iii",$pembimbing_1, $result_pembimbing_satu, $id_mahasiswa);
    $pembimbing1_change_penilaian -> execute();
    $pembimbing1_change_penilaian -> close();

}

$check_pembimbing_dua = $con->prepare("SELECT id_dosen FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = ? AND penguji.id_jabatan = 3 ORDER BY penguji.id DESC LIMIT 1");
$check_pembimbing_dua -> bind_param("i", $id_mahasiswa);
$check_pembimbing_dua->execute();
$check_pembimbing_dua->bind_result($result_pembimbing_dua);
$check_pembimbing_dua->fetch();
$check_pembimbing_dua->close();

if ($result_pembimbing_dua != $pembimbing_2 && $pembimbing_2 != 'null') {
    $pembimbing2_change = $con -> prepare(" UPDATE `penguji` SET `id_dosen` = ? WHERE `id_dosen` = ? AND `id_mahasiswa` = ? AND `id_jabatan` = 3 ORDER BY id_dosen DESC LIMIT 1");
    $pembimbing2_change -> bind_param("iii",$pembimbing_2, $result_pembimbing_dua, $id_mahasiswa);
    $pembimbing2_change -> execute();
    $pembimbing2_change -> close();

    $pembimbing2_change_penilaian = $con -> prepare(" UPDATE `penilaian` SET `id_penguji` = ? WHERE `id_penguji` = ? AND `id_mahasiswa` = ? ORDER BY id_penguji DESC LIMIT 1");
    $pembimbing2_change_penilaian -> bind_param("iii",$pembimbing_2, $result_pembimbing_dua, $id_mahasiswa);
    $pembimbing2_change_penilaian -> execute();
    $pembimbing2_change_penilaian -> close();
}

$response = array('title' => "Success", 'text' => "Data Mahasiswa berhasil diganti!", 'icon' => "success"); 
echo json_encode($response);
exit;



?>