<?php 
    require_once "../includes/connect.php";

    $output = '';
    // echo $output;
    date_default_timezone_set("Asia/Jakarta");
    $idMhs = $_POST['idMhs'];
    $idPenguji = $_POST['idPenguji'];
    $idAnggota = $_POST['idAnggota'];
    $idAnggotaLama = $_POST['idAnggotaLama'];
    $statusSidang = $_POST['statusSidang'];
    $date = date("Y-m-d H:i:s");
    $konsentrasi = $_POST['konsentrasi'];
    $catatan = $_POST['catatan'];
    $listTugas = $_POST['listTugas'];
    $nilai = $_POST['nilai'];
    $absenPenguji = $_POST['absenPenguji'];
    $absenAnggota = $_POST['absenAnggota'];
    $pembimbing = json_decode($_POST['pembimbing']);
    $absenPembimbing = json_decode($_POST['absenPembimbing']);
    // $output = $pembimbing[0];
    // echo $output;
    
    $idPembimbing = array();
    for($i = 0; $i < sizeof($pembimbing); $i++){
        $namaPembimbing = $pembimbing[$i];
        // echo $output;
        $searchIdPembimbing = "SELECT id FROM `dosen` where nama = '$namaPembimbing'";
        $check2 = mysqli_query($con,$searchIdPembimbing);
        
        while($rowCheck2 = mysqli_fetch_assoc($check2)){
            // $output = $rowCheck2['id'];
            // echo $output;
            array_push($idPembimbing, $rowCheck2['id']);
        }
        
    }
    // $output = $idPembimbing[2];
    // echo $output;

    $searchMhs = "SELECT * FROM `rekapan` where id_mahasiswa = '$idMhs'";
    $check = mysqli_query($con,$searchMhs);
    $checkMhs = mysqli_num_rows($check);

    $searchIdAnggota = "SELECT * FROM `dosen` where nama = '$idAnggota'";
    $check1 = mysqli_query($con,$searchIdAnggota);
    

    while($checkAnggota = mysqli_fetch_array($check1)){
        $idAnggotaBaru = $checkAnggota['id'];
    }

    
    if($checkMhs > 0) {
        $output = 'Berita acara sudah dibuat';
        echo $output;
    }
    else{
        if ($idAnggotaLama != $idAnggotaBaru){
            $insertt = "INSERT INTO `rekapan`(`id`, `id_mahasiswa`, `id_penguji`, `status_sidang`, `konsentrasi`, `nilai_akhir`, `catatan_sidang`,`tugas_tambahan`) VALUES (Null,'$idMhs','$idPenguji','$statusSidang','$konsentrasi','$nilai','$catatan', '$listTugas')";
            $inserttqry = mysqli_query($con,$insertt);
    
            $update = "UPDATE `mahasiswa` SET `status` = 1 WHERE id = '$idMhs'";
            $updateqry = mysqli_query($con,$update);
    
            $updateAnggota = "UPDATE `penguji` SET `id_dosen` = '$idAnggotaBaru' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idAnggotaLama'";
            $updateAnggotaQry = mysqli_query($con,$updateAnggota);

            $updateAnggotaPenilaian = "UPDATE `penilaian` SET `id_penguji` = '$idAnggotaBaru' WHERE id_mahasiswa = '$idMhs' AND id_penguji = '$idAnggotaLama'";
            $updateAnggotaQryPenilaian = mysqli_query($con,$updateAnggotaPenilaian);
    
            $updatePenguji = "UPDATE `penguji` SET `id_kehadiran` = '$absenPenguji' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPenguji'";
            $updatePengujiQry = mysqli_query($con,$updatePenguji);
    
            $updatePenguji2 = "UPDATE `penguji` SET `id_kehadiran` = '$absenAnggota' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idAnggotaBaru'";
            $updatePengujiQry2 = mysqli_query($con,$updatePenguji2);

            for($j = 0; $j < count($idPembimbing); $j++){
                $idPembimbingFix = $idPembimbing[$j];
                $absenPembimbingFix = $absenPembimbing[$j];
                $updatePembimbing = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbingFix' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbingFix'";
                $updatePembimbingQry = mysqli_query($con,$updatePembimbing);
            }
            // $updatePembimbing1 = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbing1' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbing1";
            // $updatePembimbing1 = mysqli_query($con,$updatePembimbing1);

            // $updatePembimbing2 = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbing2' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbing2";
            // $updatePembimbing2 = mysqli_query($con,$updatePembimbing2);
    
            $output = "ok";
            echo $output;
        }
        else{
            // $output = "sama";
            // echo $output;
            $insertt = "INSERT INTO `rekapan`(`id`, `id_mahasiswa`, `id_penguji`, `status_sidang`, `konsentrasi`, `nilai_akhir`, `catatan_sidang`,`tugas_tambahan`) VALUES (Null,'$idMhs','$idPenguji','$statusSidang','$konsentrasi','$nilai','$catatan', '$listTugas')";
            $inserttqry = mysqli_query($con,$insertt);
    
            $update = "UPDATE `mahasiswa` SET `status` = 1 WHERE id = '$idMhs'";
            $updateqry = mysqli_query($con,$update);
            // $output = 'ok';
    
            $updatePenguji = "UPDATE `penguji` SET `id_kehadiran` = '$absenPenguji' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPenguji'";
            $updatePengujiQry = mysqli_query($con,$updatePenguji);
    
            $updatePenguji = "UPDATE `penguji` SET `id_kehadiran` = '$absenAnggota' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idAnggotaLama'";
            $updatePengujiQry = mysqli_query($con,$updatePenguji);

            for($j = 0; $j < count($idPembimbing); $j++){
                $idPembimbingFix = $idPembimbing[$j];
                $absenPembimbingFix = $absenPembimbing[$j];
                $updatePembimbing = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbingFix' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbingFix'";
                $updatePembimbingQry = mysqli_query($con,$updatePembimbing);
            }
            // $updatePembimbing1 = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbing1' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbing1";
            // $updatePembimbing1 = mysqli_query($con,$updatePembimbing1);

            // $updatePembimbing2 = "UPDATE `penguji` SET `id_kehadiran` = '$absenPembimbing2' WHERE id_mahasiswa = '$idMhs' AND id_dosen = '$idPembimbing2";
            // $updatePembimbing2 = mysqli_query($con,$updatePembimbing2);
    
            $output = 'ok2';
            echo $output;
        }
    }
?>