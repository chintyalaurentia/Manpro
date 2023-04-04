<?php 

require_once "../includes/connect.php";
require_once "../includes/check_url.php";

$id_mahasiswa = $_POST['d'];

$find_mahasiswa_data = $con -> prepare("SELECT nrp, mahasiswa.nama, id_jurusan, jurusan, tanggal_skripsi, judul_skripsi, ruangan_skripsi FROM `mahasiswa` JOIN `jurusan` ON jurusan.id = mahasiswa.id_jurusan WHERE mahasiswa.id = ?");
$find_mahasiswa_data -> bind_param("i", $id_mahasiswa);
$find_mahasiswa_data -> execute();
$find_mahasiswa_data -> bind_result($nrp, $nama_mahasiswa, $id_jurusan, $jurusan, $tanggal_skripsi, $judul_skripsi, $ruangan_skripsi);
$find_mahasiswa_data -> fetch(); 
$find_mahasiswa_data -> close();

$date = new DateTime($tanggal_skripsi);
$get_date =  $date->format('Y-m-d');
$get_time = $date->format('H:i:s');

$find_ketua_penguji = $con -> prepare("SELECT penguji.id_dosen, dosen.nama FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = ? AND penguji.id_jabatan = 1");
$find_ketua_penguji -> bind_param("i", $id_mahasiswa);
$find_ketua_penguji -> execute();
$find_ketua_penguji -> bind_result($id_ketua_penguji, $ketua_penguji);
$find_ketua_penguji -> fetch(); 
$find_ketua_penguji -> close();

$find_anggota_penguji = $con -> prepare("SELECT penguji.id_dosen, dosen.nama FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = ? AND penguji.id_jabatan = 2");
$find_anggota_penguji -> bind_param("i", $id_mahasiswa);
$find_anggota_penguji -> execute();
$find_anggota_penguji -> bind_result($id_anggota_penguji, $anggota_penguji);
$find_anggota_penguji -> fetch(); 
$find_anggota_penguji -> close();


$count_pembimbing = $con->prepare("SELECT COUNT(*) FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = ? AND penguji.id_jabatan = 3");
$count_pembimbing -> bind_param("i", $id_mahasiswa);
$count_pembimbing->execute();
$count_pembimbing->bind_result($result_count_pembimbing);
$count_pembimbing->fetch();
$count_pembimbing->close();

function getListDosen() {
    global $con;

    $list_dosen=""; 

    $daftar_dosen = $con->query("SELECT id, nama FROM `dosen`");
    while ($row = $daftar_dosen->fetch_assoc()) {
        $list_dosen .= "<option value='".$row['id']."'>".$row['nama']."</option>";
    }

    return $list_dosen;
}

function getListPembimbing($c, $d) {
    global $con;

    $list_pembimbing = '';

    $find_pembimbing = $con->query("SELECT penguji.id_dosen as id_pembimbing, dosen.nama FROM `mahasiswa` JOIN `penguji`ON mahasiswa.id = penguji.id_mahasiswa JOIN `dosen`ON dosen.id = penguji.id_dosen WHERE mahasiswa.id = $d AND penguji.id_jabatan = 3");
    
    if ($c == 2) {
        $count=1; 
        while ($data_pembimbing = $find_pembimbing->fetch_assoc()) {
            $list_pembimbing .= "
            <div class='col-md-12 mt-3'>
                <label for='pembimbing-".$count."'>Pembimbing ".$count.":</label>
                <br>
                <select name='pembimbing-".$count."' id='pembimbing-".$count."' class='form-select'>
                    <option value='null' selected disabled hidden>". $data_pembimbing['nama']."</option>
                    ".getListDosen()."
                </select>
            </div>

            ";
            $count++;
        }
    } else if ($c == 1) {
        $count=1; 
        while ($data_pembimbing = $find_pembimbing->fetch_assoc()) {
            $list_pembimbing .= "
            <div class='col-md-12 mt-3'>
                <label for='pembimbing-".$count."'>Pembimbing ".$count.":</label>
                <br>
                <select name='pembimbing-".$count."' id='pembimbing-".$count."' class='form-select'>
                    <option value='null' selected disabled hidden>". $data_pembimbing['nama']."</option>
                    ".getListDosen()."
                </select>
            </div>

            ";
            $count++;
        }
    }

    return $list_pembimbing;
}




echo "
    <div class='row'>
        <div class='col-md-12 mt-3'>
            <label for='nama-mahasiswa'>Nama Mahasiswa</label>
            <br>
            <input id='nama-mahasiswa' type='text' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='".$nama_mahasiswa."'></input>
        </div>

        <div class='col-md-6 mt-3'>
            <label for='nrp-mahasiswa'>NRP Mahasiswa</label>
            <br>
            <input id='nrp-mahasiswa' type='text' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='".$nrp."'></input>
        </div>

        <div class='col-md-6 mt-3'>
            <label for='jurusan'>Jurusan</label>
            <br>
            <select name='jurusan' id='jurusan' class='form-select'>
                <option value='".$id_jurusan."' selected disabled hidden>". $jurusan."</option>
                <option value='1'>Informatika</option>
                <option value='2'>Sistem Informasi Bisnis</option>
                <option value='3'>Data Science and Analytics</option>
            </select>
        </div>

        <div class='col-md-6 mt-3'>
            <label for='tanggal_skripsi'>Tanggal Skripsi</label>
            <br>
            <input type='date' id='tanggal_skripsi' class='form-control' name='tanggal_skripsi' value='".$get_date."'>
        </div>

        <div class='col-md-6 mt-3'>
            <label for='jam_skripsi'>Waktu Skripsi</label>
            <br>
            <input type='time' id='jam_skripsi' class='form-control' name='jam_skripsi' value='".$get_time."'>
        </div>

        <div class='col-md-12 mt-3'>
            <label for='judul_skripsi'>Judul Skripsi</label>
            <br>
            <input id='judul_skripsi' type='text' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='".$judul_skripsi."'></input>
        </div>

        <div class='col-md-12 mt-3'>
            <label for='ruangan'>Ruangan Skripsi</label>
            <br>
            <input id='ruangan' type='text' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='".$ruangan_skripsi."'></input>
        </div>

        <div class='col-md-12 mt-3'>
            <label for='ketua'>Ketua Penguji</label>
            <br>
            <select name='ketua' id='ketua' class='form-select'>
                <option value='null' selected disabled hidden>". $ketua_penguji."</option>
                ".getListDosen()."
            </select>
        </div>

        <div class='col-md-12 mt-3'>
            <label for='anggota'>Anggota</label>
            <br>
            <select name='anggota' id='anggota' class='form-select'>
                <option value='null' selected disabled hidden>". $anggota_penguji."</option>
                ".getListDosen()."
            </select>
        </div>

        ".getListPembimbing($result_count_pembimbing, $id_mahasiswa)."

        <div class='col-md-12 mt-3 text-center'>
            <button class='btn btn-primary' id='update-content' data-search=".$id_mahasiswa.">Update</button>
        </div>

    </div>


"

?>