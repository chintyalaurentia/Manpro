<?php 
    include "includes/connect_mysqli.php";
    $id = $_GET['id'];
    $query = mysqli_query($con,"SELECT m.nrp as nrp, nama, tanggal_skripsi, judul_skripsi, ruangan_skripsi, 
                                jurusan, nilaiAkhir FROM mahasiswa m JOIN jurusan j ON m.id_jurusan = j.id WHERE m.id='$id'");
    $row = mysqli_fetch_array($query);
    $nrp = $row['nrp'];
    $queryKetua = mysqli_query($con,"SELECT d.id as id, d.nama as namaDosen FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
                                    JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=1");
    $rowKetua = mysqli_fetch_array($queryKetua);
    // while($rowPenguji = mysqli_fetch_array($queryPenguji)){
    //     echo $rowPenguji['namaDosen'];
    // }

    $queryAnggota = mysqli_query($con,"SELECT d.nama as namaDosen FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
                                    JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=2");
    $rowAnggota = mysqli_fetch_array($queryAnggota);

    $queryRekapan = mysqli_query($con, "SELECT status_sidang, catatan_sidang, tugas_tambahan FROM rekapan WHERE id_mahasiswa='$id'");
    $rowRekapan = mysqli_fetch_array($queryRekapan);

    if($rowRekapan['status_sidang'] == 1){
        $status = 'Lulus';
    }
    else{
        $status = "Tidak Lulus";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Berita Acara</title>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
                crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        *{
            font-family: 'Poppins';
        }

        body{
            background-image: url('asset/bgWeb.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            overflow: overlay;
            /* height: 100vh !important; */
        }

        ::-webkit-scrollbar {
            width: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #f57120;
            border-radius: 10px;
        }
        .container{
            width: 80%;
            margin: 100px auto;
        }
        .submit{
            text-align: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <div class="row my-3">
            <div class="col-3">
                <label for="">NRP Mahasiswa</label>
            </div>
            <div class="col-9">
                <input id="nrpval" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Nama</label>
            </div>
            <div class="col-9">
                <input id="nameval" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Jurusan</label>
            </div>
            <div class="col-9">
                <input id="jurusanval" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Hasil Sidang</label>
            </div>
            <div class="col-9">
                <input id="statusSidang" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
      
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Konsentrasi Skripsi</label>
            </div>
            <div class="col-9">
                <input id="konsentrasi" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Nilai Akhir</label>
            </div>
            <div class="col-9">
                <input id="nilai" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>

            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Catatan Sidang</label>
            </div>
            <div class="col-9">
                <textarea id="catatan" class="form-control" placeholder="" id="floatingTextarea" disabled></textarea>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Tugas Tambahan</label>
            </div>
            <div class="col-9">
                <input id="tugas" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Ketua Penguji</label>
            </div>
            <div class="col-9">
                <input id="ketua" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Anggota Penguji</label>
            </div>
            <div class="col-9">
                <input id="anggota" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
        </div>

        <?php 
            $queryPembimbing = mysqli_query($con,"SELECT d.nama as namaDosen, d.id as id FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
            JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=3");
// $rowPembimbing = mysqli_fetch_array($queryPembimbing);


            while($rowPembimbing = mysqli_fetch_array($queryPembimbing)){
            ?>

            <div class="row my-3">
                <div class="col-3">
                    <label for="">Pembimbing</label>
                </div>
                <div class="col-9">
                    <p name="pembimbing" id="pembimbing" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled><?php echo $rowPembimbing['namaDosen']; ?></p>
                </div>
            </div>

            
            <?php }
            ?>
        <!-- <button id="coba" type="button" class="btn btn-primary">Primary</button> -->
    </div>

    <script>
        $(document).ready(function(){
            $("#nrpval").val("<?php echo $row['nrp']; ?>");
            $("#nameval").val("<?php echo $row['nama']; ?>");
            $("#konsentrasi").val("<?php echo $row['jurusan']; ?>");
            $("#jurusanval").val("<?php echo $row['jurusan']; ?>");
            $("#ketua").val("<?php echo $rowKetua['namaDosen']; ?>");
            $("#anggota").val("<?php echo $rowAnggota['namaDosen']; ?>");
            $("#statusSidang").val("<?php echo $status; ?>");
            $("#catatan").val("<?php echo $rowRekapan['catatan_sidang']; ?>");
            $("#tugas").val("<?php echo $rowRekapan['tugas_tambahan']; ?>");
            $("#nilai").val("<?php echo $row['nilaiAkhir']; ?>");
        })
    </script>
</body>
</html>