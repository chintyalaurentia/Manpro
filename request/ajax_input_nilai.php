<?php

require_once "../includes/connect.php";
// require_once "../includes/check_url.php";
$output = '';
$id_mahasiswa = $_POST["idMhs"];
$id_dosen = $_POST["idDosen"];

date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d H:i:s");
$nilaiJudul = $_POST['a'];
$nilaiBab12 = $_POST['b'];
$nilaiBuku = $_POST['c'];
$nilaiKonsentrasi = $_POST['d'];
$nilaiBab5 = $_POST['e'];
$nilaiProgram = $_POST['f'];
$nilaiTotal = $_POST['g'];

// $output = $nilaiTotal;
// echo $output;

//cek dosen sm mhsnya bener ato ga
$search = "SELECT * FROM penilaian WHERE id_mahasiswa = '$id_mahasiswa' AND id_penguji = '$id_dosen'";
$check1 = mysqli_query($con,$search);
$check = mysqli_num_rows($check1);

//cek sudah dinilai ato blm
$searchNilai = "SELECT * FROM penilaian WHERE id_mahasiswa = '$id_mahasiswa' AND id_penguji = '$id_dosen' AND nilaiJudul != 0 AND nilaiBab12 != 0 AND nilaiBuku != 0 AND nilaiKonsentrasi != 0 AND nilaiBab5 != 0 AND nilaiProgram != 0 AND totalNilai != 0";
$checkNilai1 = mysqli_query($con,$searchNilai);
$checkNilai = mysqli_num_rows($checkNilai1);

//yg ini udh benerm tinggal lanjutin ngitung rata" nilai dibawah (msh smpe cek jml pembimbing)
if(is_numeric($nilaiJudul) && is_numeric($nilaiBab12) && is_numeric($nilaiBuku) && is_numeric($nilaiKonsentrasi) && is_numeric($nilaiBab5) && is_numeric($nilaiProgram) && is_numeric($nilaiTotal)){
    // $output = "numeric";
    // echo $output;
    if($check > 0){
        // $output = "ada";
        // echo $output;
        if($checkNilai > 0 ){
            $output = "sdh dinilai";
            echo $output;
        }
        else{
            // $output = "blm dinilai";
            // echo $output;
            if($nilaiJudul >= 0 && $nilaiJudul <= 100 && $nilaiBab12 >= 0 && $nilaiBab12 <= 100 && $nilaiBuku >= 0 && $nilaiBuku <= 100 && $nilaiKonsentrasi >= 0 && $nilaiKonsentrasi <= 100 && $nilaiBab5 >= 0 && $nilaiBab5 <= 100 && $nilaiProgram >= 0 && $nilaiProgram <= 100 && $nilaiTotal >= 0 && $nilaiTotal <= 100){
                // $output = "length <= 100";
                // echo $output;
                $insert = "UPDATE `penilaian` SET `nilaiJudul`='$nilaiJudul',`nilaiBab12`='$nilaiBab12',`nilaiBuku`='$nilaiBuku',`nilaiKonsentrasi`='$nilaiKonsentrasi',`nilaiBab5`='$nilaiBab5',`nilaiProgram`='$nilaiProgram',`totalNilai`='$nilaiTotal',`tanggal_acc`='$date' WHERE id_mahasiswa = '$id_mahasiswa' AND id_penguji = '$id_dosen'";
                $insertqry = mysqli_query($con, $insert);
                // $output = 'ok';
                // echo $output;
                //ambil nilai dari ketua
                $queryNilaiKetua = mysqli_query($con,"SELECT * FROM `penilaian` JOIN penguji ON penguji.id_mahasiswa = penilaian.id_mahasiswa AND penguji.id_dosen = penilaian.id_penguji WHERE penguji.id_jabatan = 1 AND penguji.id_mahasiswa = '$id_mahasiswa'");
                $rowNilaiKetua = mysqli_fetch_array($queryNilaiKetua);
                $nilaiKetua = $rowNilaiKetua['totalNilai'];
                
                
                //ambil nilai dari anggota
                $queryNilaiAnggota = mysqli_query($con,"SELECT * FROM `penilaian` JOIN penguji ON penguji.id_mahasiswa = penilaian.id_mahasiswa AND penguji.id_dosen = penilaian.id_penguji WHERE penguji.id_jabatan = 2 AND penguji.id_mahasiswa = '$id_mahasiswa'");
                $rowNilaiAnggota = mysqli_fetch_array($queryNilaiAnggota);
                $nilaiAnggota = $rowNilaiAnggota['totalNilai'];

                if($nilaiKetua == 0){
                    $jmlNilaiPenguji = $nilaiAnggota;
                }
                else if ($nilaiAnggota == 0){
                    $jmlNilaiPenguji = $nilaiKetua;
                }
                else{
                    $jmlNilaiPenguji = ($nilaiKetua+$nilaiAnggota)/2;
                }

                //ambil nilai dari pembimbing
                //cek pembimbing ada berapa
                $searchPembimbing = "SELECT * FROM penguji WHERE id_mahasiswa = '$id_mahasiswa' AND id_jabatan = 3";
                $checkPembimbingg = mysqli_query($con,$searchPembimbing);
                $checkPembimbing = mysqli_num_rows($checkPembimbingg);

                //ambil nilai dari pembimbing
                $queryNilaiPembimbing = mysqli_query($con,"SELECT * FROM `penilaian` JOIN penguji ON penguji.id_mahasiswa = penilaian.id_mahasiswa AND penguji.id_dosen = penilaian.id_penguji WHERE penguji.id_jabatan = 3 AND penguji.id_mahasiswa = '$id_mahasiswa'");
                $nilaiPembimbing = 0;
                $nilaiJumlah = 0;
                if($checkPembimbing == 2){
                    // $output = "ada 2";
                    // echo $output;
                    while($rowNilaiPembimbing = mysqli_fetch_array($queryNilaiPembimbing)){
                        // $nilaiJumlah += (int)$rowNilaiPembimbing['totalNilai'];
                        if($rowNilaiPembimbing['totalNilai'] == 0){
                            $nilaiJumlah += (int)$rowNilaiPembimbing['totalNilai'];
                            $nilaiPembimbing = $nilaiJumlah;
                        }
                        else{
                            $nilaiJumlah += (int)$rowNilaiPembimbing['totalNilai'];
                            $nilaiPembimbing = $nilaiJumlah/2;
                        }
                    }
                    //  $output = $nilaiPembimbing;
                    //  echo $output;
                    //update nilai akhir mahasiswanya
                    
                    // $jmlNilaiPenguji = ($nilaiKetua+$nilaiAnggota)/2;
                    $nilaiAkhirBeneran = ($jmlNilaiPenguji+$nilaiPembimbing)/2;
                    $updateNilaiAkhir = mysqli_query($con, "UPDATE `mahasiswa` SET `nilaiAkhir`='$nilaiAkhirBeneran' WHERE id = '$id_mahasiswa'");
                    $output = 'berhasil 2';
                    echo $output;

                }
                else if($checkPembimbing == 1){
                    // $output = "ada 1";
                    // echo $output;
                    $rowNilaiPembimbing = mysqli_fetch_array($queryNilaiPembimbing);
                    $nilaiPembimbing = $rowNilaiPembimbing['totalNilai'];


                    //update nilai akhir mahasiswanya
                    $jmlNilaiPenguji = ($nilaiKetua+$nilaiAnggota)/2;
                    $nilaiAkhirBeneran = ($jmlNilaiPenguji+$nilaiPembimbing)/2;
                    $updateNilaiAkhir = mysqli_query($con, "UPDATE `mahasiswa` SET `nilaiAkhir`='$nilaiAkhirBeneran' WHERE id = '$id_mahasiswa'");
                    $output = 'berhasil 1';
                    echo $output;
                }



            }
            else{
                $output = "length > 100";
                echo $output;
            }
        }
    }
    else {
        $output = "gaada";
        echo $output;
    }

}
else{
    $output = "not numeric";
    echo $output;
}














// $response = array();

// function check_input_numeric($nilai) {
//     if (is_numeric($nilai)){
//         return 1;
//     } else {
//         return 0;
//     }
// }

// function check_input_length($nilai) {
//     if ($nilai >= 0 && $nilai <= 100){
//         return 1;
//     } else {
//         return 0;
//     }
// }

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

// function checkDosenResponsible ($mahasiswa) {
//     global $con;

//     $search_dosen = $con -> prepare("SELECT id_dosen FROM `penguji` WHERE id_mahasiswa = ?");
//     $search_dosen-> bind_param("s", $mahasiswa);
//     $search_dosen-> execute();
//     $search_dosen-> bind_result($result_search_dosen);

//     $dosen=array();

//     while ($search_dosen->fetch()) {
//         array_push($dosen, $result_search_dosen);
//     }

//     $search_dosen->close();
    
//     return $dosen;
// }

// function insert_grade ($nilai1, $nilai2, $nilai3, $nilai4, $mahasiswa, $dosen){ 
//     global $con;

//     $approval = $con -> prepare("UPDATE `penilaian` SET `nilai_cpl1`= ?, `nilai_cpl2`= ?, `nilai_cpl3`= ?, `nilai_cpl4`= ? WHERE id_mahasiswa = ? AND id_penguji = ?");
//     $approval -> bind_param("iiiiss", $nilai1, $nilai2, $nilai3, $nilai4,$mahasiswa, $dosen);
//     $approval -> execute();
//     $approval -> close();

//     if (mysqli_affected_rows($con) == -1) {
//         return 1;
//     } 
// }



// if (check_input_numeric($nilai_1) != 1 && check_input_numeric($nilai_2) != 1 && check_input_numeric($nilai_3) != 1 && check_input_numeric($nilai_4) != 1) {
//     $response = array('title' => "Failed", 'text' => "Format nilai tidak berupa numerik", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// }

// if (check_input_length($nilai_1) != 1 && check_input_length($nilai_2) != 1 && check_input_length($nilai_3) != 1 && check_input_length($nilai_4) != 1) {
//     $response = array('title' => "Failed", 'text' => "Penilaian melebihi batas usahakan diantara 0-100", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// } 

// if (checkMahasiswa($id_mahasiswa) != 1) {
//     $response = array('title' => "Failed", 'text' => "Mahasiswa", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// } 

// if (in_array($_SESSION["id_dosen"], checkDosenResponsible($id_mahasiswa)) != 1) {
//     $response = array('title' => "Failed", 'text' => "Dosen tidak memiliki akses untuk melakukan penilaian", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// } 


// if (insert_grade($nilai_1, $nilai_2, $nilai_3, $nilai_4, $id_mahasiswa, $id_dosen)) {
//     $response = array('title' => "Success", 'text' => "Penilaian berhasil di input", 'icon' => "success"); 
//     echo json_encode($response);
//     exit;
// } else {
//     $response[] = array('title' => "Failed", 'text' => "Penilaian gagal di input, silahkan coba refresh!", 'icon' => "error"); 
//     echo json_encode($response);
//     exit;
// }





?>