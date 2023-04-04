<?php 
include "includes/connect.php";
$nrp = $_SESSION["nrp"];
$query = mysqli_query($con,"SELECT m.id as id, nama, tanggal_skripsi, judul_skripsi, ruangan_skripsi, 
                            jurusan, nilaiAkhir FROM mahasiswa m JOIN jurusan j ON m.id_jurusan = j.id WHERE nrp='$nrp'");
$row = mysqli_fetch_array($query);

$queryKetua = mysqli_query($con,"SELECT d.id as id, d.nama as namaDosen FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
                                JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=1");
$rowKetua = mysqli_fetch_array($queryKetua);
// while($rowPenguji = mysqli_fetch_array($queryPenguji)){
//     echo $rowPenguji['namaDosen'];
// }

$queryAnggota = mysqli_query($con,"SELECT d.nama as namaDosen, d.id as id FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
                                JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=2");
$rowAnggota = mysqli_fetch_array($queryAnggota);

$a=array();
$id=array();
$queryPembimbing = mysqli_query($con,"SELECT d.nama as namaDosen, d.id as id FROM mahasiswa m JOIN penguji p ON m.id=p.id_mahasiswa 
                                                    JOIN dosen d ON d.id=p.id_dosen WHERE nrp='$nrp' AND id_jabatan=3");
            // $rowPembimbing = mysqli_fetch_array($queryPembimbing);

            
while($rowPembimbing = mysqli_fetch_array($queryPembimbing)){
    array_push($a,$rowPembimbing["namaDosen"]);
    array_push($id,$rowPembimbing["id"]);
}

$size=sizeof($a);
// print_r($a[0]);
// echo $id[1];
$queryDosen = mysqli_query($con,"SELECT * FROM dosen");




$kehadiran = mysqli_query($con, "SELECT * FROM kehadiran");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>

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
                <div class="hasilSidang">
                    <input class="form-check-input" type="radio" name="hasilSidang" id="flexRadioDefault1" value=1>
                    <label class="form-check-label" for="flexRadioDefault1" >Lulus</label>
                </div>
                <div class="hasilSidang">
                    <input class="form-check-input" type="radio" name="hasilSidang" id="flexRadioDefault2" value=0>
                    <label class="form-check-label" for="flexRadioDefault2">Tidak Lulus</label>
                </div>            
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Konsentrasi Skripsi</label>
            </div>
            <div class="col-9">
                <input id="konsentrasi" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default">
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
                <textarea id="catatan" class="form-control" placeholder="" id="floatingTextarea"></textarea>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Tugas Tambahan</label>
            </div>
            <div class="col-9">
                <div class="form-check">
                    <input class="form-check-input listTugas" type="checkbox" value="Poster" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Poster</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input listTugas" type="checkbox" value="Video" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Video</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input listTugas" type="checkbox" value="Laporan Penelitian" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Laporan Penelitian</label>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Ketua Penguji</label>
            </div>
            <div class="col-6">
                <input id="ketua" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="col-3">
                <select class="form-select" aria-label="Default select example" id="absenPenguji">
                    <option selected disabled value="">Absensi</option>
                        <?php while ($rowKehadiran = mysqli_fetch_assoc($kehadiran)) : ?>
                            <option value="<?php echo $rowKehadiran["id"] ?>" id="opt"> <?php echo $rowKehadiran["status"]; ?> </option>
                        <?php endwhile; ?>
                </select>  
            </div>
        </div>

        <div class="row my-3">
            <div class="col-3">
                <label for="">Anggota Penguji</label>
            </div>
            <div class="col-5">
                <input id="anggota" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Edit
                </button>
            </div>

            <div class="col-3">
                <select class="form-select" aria-label="Default select example" id="absenAnggota">
                    <option selected disabled value="">Absensi</option>
                        <option value="1" id="opt"> Hadir </option>
                        <option value="2" id="opt"> Tidak Hadir </option>
                        <option value="3" id="opt"> Sakit </option>
                        <option value="4" id="opt"> Izin </option>
                        
                </select>  
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
                <div class="col-6">
                    <p name="pembimbing" id="pembimbing" type="text" class="form-control" aria-label="Disable example input" aria-describedby="inputGroup-sizing-default" disabled><?php echo $rowPembimbing['namaDosen']; ?></p>
                </div>
                <div class="col-3">
                    <select class="form-select" aria-label="Default select example" name="absenPembimbing" id="absenPem">
                        <option selected disabled value="">Absensi</option>
                            <option value="1" id="opt"> Hadir </option>
                            <option value="2" id="opt"> Tidak Hadir </option>
                            <option value="3" id="opt"> Sakit </option>
                            <option value="4" id="opt"> Izin </option>
                            
                    </select> 
                </div>
            </div>

            
            <?php }
            ?>
            

          
        
    

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Anggota Penguji</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" aria-label="Default select example" id="editAnggota">
                        <option selected disabled value="">Pilih Dosen</option>
                            <?php while ($rowDosen = mysqli_fetch_array($queryDosen)) : ?>
                                <option value="<?php echo $rowDosen["nama"] ?>"> <?php echo $rowDosen["nama"]; ?> </option>
                            <?php endwhile; ?>
                    </select>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="ok">Ok</button>
                </div>
                </div>
            </div>
        </div>

        <div class="row my-5 submit">
            <div class="col-12">
                <button id="submit" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- <button id="coba" type="button" class="btn btn-primary">Primary</button> -->
    </div>

    

    <script>
        $(document).ready(function(){
            $("#nrpval").val("<?php echo $nrp; ?>");
            $("#nameval").val("<?php echo $row['nama']; ?>");
            $("#jurusanval").val("<?php echo $row['jurusan']; ?>");
            $("#ketua").val("<?php echo $rowKetua['namaDosen']; ?>");
            $("#anggota").val("<?php echo $rowAnggota['namaDosen']; ?>");
            $("#nilai").val("<?php echo $row['nilaiAkhir']; ?>");
           
            

            // $(document).on("click", ".form-check", function(){
            //         var statusSidang = $("input[name='hasilSidang']:checked").val();
            //         alert(statusSidang);
            //     })
                
            var arr = [];
            $(".listTugas").change(function(){
                var value = $(this).val();
                
                var ischecked = $(this).is(':checked');
                if(!ischecked) {
                    // alert(value + " unchecked")
                    for( var i = 0; i < arr.length; i++){    
                        if ( arr[i] === value) { 
                            arr.splice(i, 1); 
                        }
                    }
                }
                else {
                    // alert(value + " checked")
                    arr.push(value)
                }

            })

            $(document).on("click", "#ok", function(){
                var anggotaBaru = $("#editAnggota").val();
                $('#staticBackdrop').modal('toggle');
                $("#anggota").val(anggotaBaru);
                // alert(anggotaBaru);
                // console.log(anggotaBaru);
            })

            $("#submit").click(function(){
                // alert(sizePembimbing);
                if ($("#catatan").val() != "" && $("#konsentrasi").val() != "" && $("#catatan").val() != "" && arr.length != 0 && $("#absenPenguji").val() != "" && $("#absenAnggota").val() != "" && $("#absenPem").val() != ""){
                    var valsPembimbing = document.getElementsByName("pembimbing");
                    var pembimbing=[];
                    for (var i=0, n=valsPembimbing.length;i<n;i++) {
                    pembimbing.push(valsPembimbing[i].innerHTML);
                    // alert(pembimbing[i]);
                    }

                    var valsAbsen = document.getElementsByName("absenPembimbing");
                    var absenPembimbing=[];
                    for (var i=0, n=valsAbsen.length;i<n;i++) {
                    absenPembimbing.push(valsAbsen[i].value);
                    // alert(absenPembimbing[i]);
                    }

                    var idMhs = "<?php echo $row['id']; ?>"
                    var idPenguji = "<?php echo $rowKetua['id']; ?>"
                    var idAnggota = $("#anggota").val();
                    var idAnggotaLama = "<?php echo $rowAnggota['id']; ?>"
                    var statusSidang = $("input[name='hasilSidang']:checked").val();
                    var absenPenguji = $("#absenPenguji").val();
                    var absenAnggota = $("#absenAnggota").val();
                    var konsentrasi = $("#konsentrasi").val();
                    var catatan = $("#catatan").val();
                    var nilai = $("#nilai").val();
                    // alert(date);
                    let fd = new FormData();
                    var json_pembimbing = JSON.stringify(pembimbing);
                    var json_absen =   JSON.stringify(absenPembimbing);
                    // console.log(absenPembimbing);
                    fd.append("pembimbing",json_pembimbing);
                    fd.append("absenPembimbing",json_absen);
                    fd.append("idMhs", idMhs);
                    fd.append("idPenguji", idPenguji);
                    fd.append("idAnggota", idAnggota);
                    fd.append("idAnggotaLama", idAnggotaLama);
            
                    fd.append("statusSidang", statusSidang);
                    
                    fd.append("konsentrasi", konsentrasi);
                    fd.append("catatan", catatan);
                    fd.append("nilai", nilai);
                    
                    fd.append("listTugas", arr);
                    fd.append("absenPenguji", absenPenguji);
                    fd.append("absenAnggota", absenAnggota);
                    
                    
                        
                    $.ajax({
                        url: "request/skripsi_action.php",
                        type: "POST",
                        data: fd,
                        processData: false,
                            contentType: false,
                        success: function (res){
                            // alert(res);
                            if(res == "ok" || res =="ok2"){
                                Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Berita Acara Berhasil Dibuat',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then((result) => {
                                        // if(result.isConfirmed){
                                            window.location.href= 'hasil.php?id='+idMhs;
                                        // }
                                    })
                                    
                            }
                            else{
                                Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Berita Acara Sudah Dibuat',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                            }
                            
                        },
                        error: function(){
                            alert("gagal");
                        }
                    });
                }
                else {
                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Mohon isi data dengan lengkap',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                }
                
               
                
                
                

                
                

                



            })
        })
        
    </script>
</body>
</html>