<?php

require_once "../includes/connect.php";
require_once "../includes/check_url.php";

require_once "../includes/upload_mahasiswa/Classes/PHPExcel.php";
require_once '../includes/upload_mahasiswa/vendor/autoload.php';

error_reporting(E_ERROR | E_PARSE);

$file = empty($_FILES['file_mhs']) ? NULL : $_FILES['file_mhs'];

$response = array();


#file checking 

function checkIsEmpty($empty_or_not)
{
    if (!empty($empty_or_not)) {
        return 1;
    } else {
        return 0;
    }
}

function checkExtension($file_extension)
{
    $original_file_name = $file_extension['name'];
    $split_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
    $valid_extensions = array('xls', 'xlsx');
    if (in_array(strtolower($split_extension), $valid_extensions)) {
        return 1;
    } else {
        return 0;
    }
}

if (checkIsEmpty($file) == 0) {
    $response = array('title' => "Failed", 'text' => "File tidak diinputkan!", 'icon' => "error"); 
    echo json_encode($response);
    exit();
}


if (checkExtension($file) == 0) {
    $response = array('title' => "Failed", 'text' => "Extension file tidak sesuai!", 'icon' => "error"); 
    echo json_encode($response);
    exit();
}

# Function helper

function change_date($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    $split = explode(' ', $tanggal);

    $findMonth = array_search($split[2], $bulan);

    if ($findMonth < 10) {
        $newFormat = '0' . $findMonth;
    } else {
        $newFormat = $findMonth;
    }

    return $newFormat;
}

function find_ketua($dataValue)
{
    $jabatan = array("ketua", "anggota", "pembimbing");

    $idxStrKetua = stripos($dataValue, $jabatan[0]);
    $idxStrAnggota = stripos($dataValue, $jabatan[1]);
    $idxStrPembimbing = stripos($dataValue, $jabatan[2]);

    $idxStartKetua = $idxStrKetua + strlen($jabatan[0]);
    $lenSubStrKetua = $idxStrAnggota - $idxStartKetua;
    $namaKetua = trim(substr($dataValue, $idxStartKetua, $lenSubStrKetua));

    return $namaKetua;
}

function find_anggota($dataValue)
{
    $jabatan = array("ketua", "anggota", "pembimbing");

    $idxStrKetua = stripos($dataValue, $jabatan[0]);
    $idxStrAnggota = stripos($dataValue, $jabatan[1]);
    $idxStrPembimbing = stripos($dataValue, $jabatan[2]);

    $idxStartAnggota = $idxStrAnggota + strlen($jabatan[1]);
    $lenSubStrAnggota = $idxStrPembimbing - $idxStartAnggota;
    $namaAnggota = trim(substr($dataValue, $idxStartAnggota, $lenSubStrAnggota));

    return $namaAnggota;
}

function find_pembimbing($dataValue)
{

    $jabatan = array("ketua", "anggota", "pembimbing");

    $idxStrKetua = stripos($dataValue, $jabatan[0]);
    $idxStrAnggota = stripos($dataValue, $jabatan[1]);
    $idxStrPembimbing = stripos($dataValue, $jabatan[2]);

    $idxStartPembimbing = $idxStrPembimbing + strlen($jabatan[2]);
    $pembimbing = trim(substr($dataValue, $idxStartPembimbing));

    $splitStr = explode(" - ", $pembimbing);

    $dataClean = array();

    foreach ($splitStr as $key => $datapembimbing) {

        if (sizeof($splitStr) == 2) {
            // $check = $check+1;
            if (is_numeric($datapembimbing)) {
                $NIP = $datapembimbing;
                $getSecondName = "";
                $SecondNIP = "";
            } else {
                $getName = trim($datapembimbing);
                $getSecondName = "";
                $SecondNIP = "";
            }
        } else if (sizeof($splitStr) == 3) {
            if (preg_match('~[0-9]+~', $datapembimbing) == 1 && is_string($datapembimbing) == 1) {
                if (strlen($datapembimbing) == 5) {
                    $NIP = $datapembimbing;
                } else {
                    $getLen = strlen($datapembimbing);
                    $getLenName = strlen($datapembimbing) - 5;
                    $SecondNIP = trim(substr($datapembimbing, -5));
                    $getName = trim(substr($datapembimbing, 0, $getLenName));
                }
            } elseif (is_string($datapembimbing) == 1 && preg_match('~[0-9]+~', $datapembimbing) == 0) {
                $getSecondName = trim($datapembimbing);
            }
        }
    }

    if ($SecondNIP == "" && $getSecondName == "") {
        $dataClean[] = array(
            'NIP' => $NIP,
            'nama_pembimbing' => $getName
        );
    } else {
        $dataClean[] = array(
            'NIP' => $NIP,
            'nama_pembimbing' => $getName
        );
        $dataClean[] = array(
            'NIP'  => $SecondNIP,
            'nama_pembimbing'  => $getSecondName
        );
    }

    return $dataClean;
}

function upload_data_mahasiswa($year, $smt, $no_nrp, $nama, $date, $title, $loc)
{
    global $con;

    $count_mahasiswa = $con->prepare("SELECT COUNT(*) FROM `mahasiswa`");
    $count_mahasiswa->execute();
    $count_mahasiswa->bind_result($result_count_mahasiswa);
    $count_mahasiswa->fetch();
    $count_mahasiswa->close();

    if ($result_count_mahasiswa >= 0) {
        $search_mahasiswa = $con->prepare("SELECT COUNT(*) FROM `mahasiswa` WHERE nrp = ?");
        $search_mahasiswa->bind_param("s", $no_nrp);
        $search_mahasiswa->execute();
        $search_mahasiswa->bind_result($result_search_mahasiswa);
        $search_mahasiswa->fetch();
        $search_mahasiswa->close();

        if ($result_search_mahasiswa == 0) {
            $insert_to_mahasiswa = $con->prepare("INSERT INTO mahasiswa (`tahun_ajaran`, `semester`, `nrp`, `nama`, `tanggal_skripsi`, `judul_skripsi`, `ruangan_skripsi`) VALUES (?,?,?,?,?,?,?)");
            $insert_to_mahasiswa->bind_param("sssssss", $year, $smt, $no_nrp, $nama, $date, $title, $loc);
            $insert_to_mahasiswa->execute();
            $insert_to_mahasiswa->close();
        } 
    }
}


function upload_data_dosen($arr_data_dosen)
{
    global $con;

    foreach ($arr_data_dosen as $list_nip_pembimbing) {
        $count_dosen = $con->prepare("SELECT COUNT(*) FROM `dosen`");
        $count_dosen->execute();
        $count_dosen->bind_result($result_count_dosen);
        $count_dosen->fetch();
        $count_dosen->close();

        if ($result_count_dosen >= 0) {
            $search_dosen = $con->prepare("SELECT COUNT(*) FROM `dosen` WHERE nip = ?");
            $search_dosen->bind_param("s", $list_nip_pembimbing['NIP']);
            $search_dosen->execute();
            $search_dosen->bind_result($result_search);
            $search_dosen->fetch();
            $search_dosen->close();

            if ($result_search == 0) {
                $insert_to_dosen = $con->prepare("INSERT INTO `dosen`(`nip`, `nama`) VALUES (?,?)");
                $insert_to_dosen->bind_param("ss", $list_nip_pembimbing['NIP'], $list_nip_pembimbing['nama_pembimbing']);
                $insert_to_dosen->execute();
                $insert_to_dosen->close();
            } else {
                continue;
            }
        }
    }
}

function upload_data_penguji($arr_data_penguji, $nrp_mahasiswa, $ketua, $anggota)
{
    global $con;

    $search_mahasiswa = $con->prepare("SELECT id FROM `mahasiswa` WHERE nrp = ?");
    $search_mahasiswa->bind_param("s", $nrp_mahasiswa);
    $search_mahasiswa->execute();
    $search_mahasiswa->bind_result($result_mahasiswa);
    $search_mahasiswa->fetch();
    $search_mahasiswa->close();

    $search_ketua = $con->prepare("SELECT id FROM `dosen` WHERE nama = ?");
    $search_ketua->bind_param("s", $ketua);
    $search_ketua->execute();
    $search_ketua->bind_result($result_ketua);
    $search_ketua->fetch();
    $search_ketua->close();


    $search_penguji_ketua = $con -> prepare("SELECT COUNT(*) FROM `penguji` WHERE id_mahasiswa = ? AND id_dosen = ? AND id_jabatan = 1");
    $search_penguji_ketua -> bind_param("ii", $result_mahasiswa, $result_ketua);
    $search_penguji_ketua -> execute();
    $search_penguji_ketua -> bind_result($result_ketua_num);
    $search_penguji_ketua -> fetch(); 
    $search_penguji_ketua -> close();

    # Ketua

    if ($result_ketua_num == 0) {
        $jabatan = 1;
        $insert_to_pembimbing = $con->prepare("INSERT INTO `penguji`(`id_dosen`, `id_mahasiswa`, `id_jabatan`) VALUES (?,?,?)");
        $insert_to_pembimbing->bind_param("iii", $result_ketua, $result_mahasiswa, $jabatan);
        $insert_to_pembimbing->execute();
        $insert_to_pembimbing->close();
    }

    # Anggota

    $search_anggota = $con->prepare("SELECT id FROM `dosen` WHERE nama = ?");
    $search_anggota->bind_param("s", $anggota);
    $search_anggota->execute();
    $search_anggota->bind_result($result_anggota);
    $search_anggota->fetch();
    $search_anggota->close();

    $search_penguji_anggota = $con -> prepare("SELECT COUNT(*) FROM `penguji` WHERE id_mahasiswa = ? AND id_dosen = ? AND id_jabatan = 2");
    $search_penguji_anggota -> bind_param("ii", $result_mahasiswa, $result_anggota);
    $search_penguji_anggota -> execute();
    $search_penguji_anggota -> bind_result($result_anggota_num);
    $search_penguji_anggota -> fetch(); 
    $search_penguji_anggota -> close();

    if ($result_anggota_num == 0) {
        $jabatan = 2;
        $insert_to_anggota = $con->prepare("INSERT INTO `penguji`(`id_dosen`, `id_mahasiswa`, `id_jabatan`) VALUES (?,?,?)");
        $insert_to_anggota->bind_param("iii", $result_anggota, $result_mahasiswa, $jabatan);
        $insert_to_anggota->execute();
        $insert_to_anggota->close();
    }

    foreach ($arr_data_penguji as $nip) {
        $search_pembimbing = $con->prepare("SELECT id FROM `dosen` WHERE nip = ?");
        $search_pembimbing->bind_param("s", $nip['NIP']);
        $search_pembimbing->execute();
        $search_pembimbing->bind_result($result_pembimbing);
        $search_pembimbing->fetch();
        $search_pembimbing->close();

        $search_penguji_pembimbing = $con -> prepare("SELECT COUNT(*) FROM `penguji` WHERE id_mahasiswa = ? AND id_dosen = ? AND id_jabatan = 3");
        $search_penguji_pembimbing -> bind_param("ii", $result_mahasiswa, $result_pembimbing);
        $search_penguji_pembimbing -> execute();
        $search_penguji_pembimbing -> bind_result($result_pembimbing_num);
        $search_penguji_pembimbing -> fetch(); 
        $search_penguji_pembimbing -> close();

        if ($result_pembimbing_num == 0) {
            #Pembimbing
            $jabatan = 3;

            $insert_to_pembimbing = $con->prepare("INSERT INTO `penguji`(`id_dosen`, `id_mahasiswa`, `id_jabatan`) VALUES (?,?,?)");
            $insert_to_pembimbing->bind_param("iii", $result_pembimbing, $result_mahasiswa, $jabatan);
            $insert_to_pembimbing->execute();
            $insert_to_pembimbing->close();
        }

        
    }
}

function upload_data_penilaian($nrp_mahasiswa)
{
    global $con;

    $search_mahasiswa = $con->prepare("SELECT id FROM `mahasiswa` WHERE nrp = ?");
    $search_mahasiswa->bind_param("s", $nrp_mahasiswa);
    $search_mahasiswa->execute();
    $search_mahasiswa->bind_result($result_mahasiswa);
    $search_mahasiswa->fetch();
    $search_mahasiswa->close();

    $search_dosen = $con->prepare("SELECT id_dosen FROM `penguji` WHERE id_mahasiswa = ?");
    $search_dosen->bind_param("i", $result_mahasiswa);
    $search_dosen->execute();
    $search_dosen->bind_result($result_dosen);

    $arr_dosen_penilai=array();

    while ($search_dosen->fetch()) {
        array_push($arr_dosen_penilai, $result_dosen);
    }

    $search_dosen->close();

    // var_dump($arr_dosen_penilai);

    foreach ($arr_dosen_penilai as $list_penilai) {
        $search_penilaian_dosen = $con -> prepare("SELECT COUNT(*) FROM `penilaian` WHERE id_mahasiswa = ? AND id_penguji = ?");
        $search_penilaian_dosen -> bind_param("ii", $result_mahasiswa, $list_penilai);
        $search_penilaian_dosen -> execute();
        $search_penilaian_dosen -> bind_result($result_penilaian_dosen);
        $search_penilaian_dosen -> fetch(); 
        $search_penilaian_dosen -> close();

        if ($result_penilaian_dosen == 0) {
            $insert_to_penilaian = $con -> prepare("INSERT INTO `penilaian`(`id_mahasiswa`, `id_penguji`) VALUES (?,?)");
            $insert_to_penilaian -> bind_param("ii", $result_mahasiswa, $list_penilai);
            $insert_to_penilaian -> execute();  
            $insert_to_penilaian -> close();  
        } else {
            continue;
        }  
    }

}


# Updating unmerge columns to be merged

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$filePath = $_FILES['file_mhs']['tmp_name'];
$original_file_name = $_FILES['file_mhs']['name'];

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
$data = $spreadsheet->getActiveSheet();

foreach ($data->getMergeCells() as $cells)
    $data->unmergeCells($cells);

$writer = new Xlsx($spreadsheet);
$writer->save($filePath);

$newData = $spreadsheet->getActiveSheet()->toArray();

$cellA1 = $data->getCell('A1');

foreach($newData as $row){

    if (is_null($row[1]) or is_null($row[2]) or is_null($row[3]) or is_null($row[4])) {
        continue;
    } elseif ($row[1] == "Tanggal Ruang" or $row[2] == "Mahasiswa" or $row[3] == "Team Penguji" or $row[4] == "Judul Skripsi") {
        continue;
    } else {
        # Split semester
        $semester = $cellA1->getValue();
        // $redefineSemester = str_replace("\n"," ", $semester);
        $splitSemester = explode("\n", $semester);
        $get_semester = $splitSemester[2];

        $find_year_position = stripos($get_semester,"2");
        $find_year = substr($get_semester, $find_year_position);

        $find_semester = substr($get_semester, 0, 15);

        # Split tanggal dan ruang
        $redefineDate = str_replace("\n", " ", $row[1]);
        $splitDate = explode(' ', $redefineDate);
        $newDateFormed = $splitDate[3] . ":" . change_date($redefineDate) . ":" . $splitDate[1] . " " . $splitDate[4] . ":00" ;
        $thesis_location = $splitDate[5];

        # Split nama dan nrp
        $redefineIdentity = str_replace("\n", " ", $row[2]);
        $splitIdentity = explode(' ', $redefineIdentity, 2);
        $nrp = $splitIdentity[0];
        $name = $splitIdentity[1];

        # Split nama dosen dan jabatan        
        $nama_ketua = find_ketua($row[3]);
        $nama_anggota = find_anggota($row[3]);
        $nama_pembimbing = find_pembimbing($row[3]);

        # Nama Skripsi
        $thesis_title = $row[4];        

        upload_data_mahasiswa($find_year, $find_semester, $nrp, $name, $newDateFormed, $thesis_title, $thesis_location);
        upload_data_dosen($nama_pembimbing);


    }
}

foreach($newData as $list_data){

    if (is_null($list_data[1]) or is_null($list_data[2]) or is_null($list_data[3]) or is_null($list_data[4])) {
        continue;
    } elseif ($list_data[1] == "Tanggal Ruang" or $list_data[2] == "Mahasiswa" or $list_data[3] == "Team Penguji" or $list_data[4] == "Judul Skripsi") {
        continue;
    } else {
        # Split nama dan nrp
        $redefineIdentity = str_replace("\n", " ", $list_data[2]);
        $splitIdentity = explode(' ', $redefineIdentity, 2);
        $nrp = $splitIdentity[0];
        $name = $splitIdentity[1];

        # Split nama dosen dan jabatan        
        $nama_ketua = find_ketua($list_data[3]);
        $nama_anggota = find_anggota($list_data[3]);
        $nama_pembimbing = find_pembimbing($list_data[3]);

        upload_data_penguji($nama_pembimbing, $nrp, $nama_ketua, $nama_anggota);

    }
}


foreach ($newData as $list_data) {

    if (is_null($list_data[1]) or is_null($list_data[2]) or is_null($list_data[3]) or is_null($list_data[4])) {
        continue;
    } elseif ($list_data[1] == "Tanggal Ruang" or $list_data[2] == "Mahasiswa" or $list_data[3] == "Team Penguji" or $list_data[4] == "Judul Skripsi") {
        continue;
    } else {
        # Split nama dan nrp
        $redefineIdentity = str_replace("\n", " ", $list_data[2]);
        $splitIdentity = explode(' ', $redefineIdentity, 2);
        $nrp = $splitIdentity[0];
        $name = $splitIdentity[1];

        # Split nama dosen dan jabatan        
        $nama_ketua = find_ketua($list_data[3]);
        $nama_anggota = find_anggota($list_data[3]);
        $nama_pembimbing = find_pembimbing($list_data[3]);

        upload_data_penilaian($nrp);
    }
}

$response = array('title' => "Success", 'text' => "Data Mahasiwa berhasil dimasukkan!", 'icon' => "success"); 
echo json_encode($response);
exit;
