<?php

require_once "includes/connect.php";

$token = bin2hex(random_bytes(64));
$_SESSION["token"] = $token;
// $_SESSION["id_dosen"] = 6;

$id_mahasiswa = $_SESSION["id_mahasiswa"];
$id_dosen = $_SESSION["id_dosen"];

$get_data = $con->prepare("SELECT mahasiswa.id, mahasiswa.nrp, mahasiswa.nama, jurusan, judul_skripsi, tanggal_skripsi, nilaiJudul, nilaiBab12, nilaiBuku, nilaiKonsentrasi, nilaiBab5, nilaiProgram, totalNilai FROM `mahasiswa` JOIN `penilaian` ON mahasiswa.id = penilaian.id_mahasiswa LEFT JOIN `jurusan` ON mahasiswa.id_jurusan = jurusan.id WHERE mahasiswa.id = ? AND id_penguji = ?");

$get_data->bind_param("ii", $id_mahasiswa, $_SESSION["id_dosen"]);

$get_data->execute();

$get_data->bind_result($numbering, $nrp, $name, $jurusan, $thesis_title, $date, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6, $nilai7);

$get_data->fetch();

$get_data->close();


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="<?= $_SESSION["token"] ?>">
    <title>Input Nilai</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        .row {
            background-color: white;
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

        /* .display {
            background-color: white;
        } */

        *{
            font-family: 'Poppins';
        }
    </style>
        
</head>
<body>
    <div class="container">
        <div class="row mt-5 p-3">
            <div class="col-12 mt-3 mb-5 text-center">
                <h3>Penilaian Skripsi</h3>
            </div>

            <div class="col-3 mb-3">
                <label for="nrp_mahasiswa">NRP</label>
            </div>

            <div class="col-9 mb-3">
                <input id="nrp_mahasiswa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled></input>
            </div>

            <div class="col-3 mb-3">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
            </div>

            <div class="col-9 mb-3">
                <input id="nama_mahasiswa" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled></input>
            </div>

            <div class="col-3 mb-3">
                <label for="jurusan">Jurusan</label>
            </div>

            <div class="col-9 mb-3">
                <input id="jurusan" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled></input>
            </div>
            
            <!-- pengecekan buat penilaian jurusan -->

            <div class="col-3 mb-3">
                <label for="judul_skripsi">Judul Skripsi</label>
            </div>

            <div class="col-9 mb-3">
                <textarea id="judul_skripsi" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled></textarea>
            </div>

            <!-- CPL 9 -->
            <div class="col-12 mb-2 mt-5">
                <label><b>CPL 9 - Menganalisis data secara logis, kritis, sistematis, dan inovatif</b></label>
            </div>

            <div class="col-3 my-2">
                <label for="nilaiJudul">JUDUL, ABSTRAK dan BAB 1-2</label>
            </div>
            <div class="col-9 my-2">
                <input id="nilaiJudul" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>

            <div class="col-12 my-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Memenuhi 3 kriteria metode, tujuan, obyek, dapat menyebutkan yang mana masing2. abstrak berisi  rangkuman problem, solusi dan kesimpulan</textarea>
            </div>

            <div class="col-3 my-2">
                <label for="nilaiBab12">BAB 1-2</label>
            </div>
            <div class="col-9 my-2">
                <input id="nilaiBab12" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>

            <div class="col-12 my-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Latar belakang berisi detail problem, review singkat solusi dari peneliti sebelumnya, apa yang dikerjakan di skripsi ini; perumusan masalah berisi hipotesis; ruang lingkup selain apa yang dikerjakan, rencana pengujian terkait perumusan masalah; tinjauan pustaka berisi teori/informasi terkait judul; tinjauan studi berisi penelitian terkait yang telah diteliti sebelumnya.</textarea>
            </div>

            <div class="col-3 my-2">
                <label for="nilaiBuku">BUKU</label>
            </div>
            <div class="col-9 my-2">
                <input id="nilaiBuku" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>

            <div class="col-12 my-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Penulisan buku laporan yang runut dan lengkap. Tata bahasa baku dengan gaya bahasa laporan ilmiah. Sejauh mana daftar pustaka sudah dicek bahwa semua item benar2 dikutip di bab2 sebelumnya, bukan sekedar cara penulisannya sudah benar</textarea>
            </div>

            <?php 
                if($jurusan == 'Informatika'){
            ?>

            <div class="col-12 mb-2 mt-5">
                <label for="nilaiKonsentrasi"><b>CPL 4 - Mengkonstruksi algoritma dan/atau program yang efektif untuk menyelesaikan masalah</b></label>
            </div>

            <div class="col-3 mb-2">
                <label for="nilaiKonsentrasi">BAB 3 dan BAB 4</label>
            </div>
            <div class="col-9 mb-2">
                <input id="nilaiKonsentrasi" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. penjabaran solusi yang diusulkan dan penjelasan mengapa solusi tersebut dianggap dapat menyelesaikan masalah. Bagaimana mengatur TIK pendukung sehingga mencapai tujuan skripsi</textarea>
            </div>

            <?php }
            else if($jurusan == 'Sistem Informasi Bisnis'){
            ?>

            <div class="col-12 mb-2 mt-5">
                <label for="nilaiKonsentrasi"><b>CPL 7 - Membangun sistem informasi atau aplikasi bisnis untuk mendukung tercapainya tujuan organisasi</b></label>
            </div>

            <div class="col-3 mb-2">
                <label for="nilaiKonsentrasi">BAB 3 dan BAB 4</label>
            </div>
            <div class="col-9 mb-2">
                <input id="nilaiKonsentrasi" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. Rancangan solusi dalam bentuk desain. Kesesuaian desain dengan kebutuhan proses bisnis yang nyata</textarea>
            </div>

            <?php }
            else if($jurusan == 'Data Science and Analytics'){?>

            <div class="col-12 mb-2 mt-5">
                <label for="nilaiKonsentrasi"><b>CPL 8 - Memastikan penyimpanan, pengamanan, dan penemuan kembali data kajian saintifik, serta memanfaatkannya dalam laporan saintifik</b></label>
            </div>

            <div class="col-3 mb-2">
                <label for="nilaiKonsentrasi">BAB 3 dan BAB 4</label>
            </div>
            <div class="col-9 mb-2">
                <input id="nilaiKonsentrasi" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. Bagaimana proses pengumpulan data, mengorganisasinya serta menganalisa sedemikian rupa sehingga menjadi informasi yang bermanfaat</textarea>
            </div>
            <?php }?>

            <!-- CPL 8 -->
            <div class="col-12 mb-2 mt-5">
                <label for="nilaiBab5"><b>CPL 8 - Menganalisis data secara logis, kritis, sistematis, dan inovatif</b></label>
            </div>

            <div class="col-3 mb-2">
                <label for="nilaiBab5">BAB 5 dan KESIMPULAN</label>
            </div>
            <div class="col-9 mb-2">
                <input id="nilaiBab5" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>- Merancang pengujian (bab 5). apakah langkah-langkah pengujian sistem serta hasil pengujian telah dijabarkan secara jelas lengkap (bilamana perlu dilengkapi dengan grafik, tabel, pembuktian. apakah langkah-langkah implementasi sistem telah dijabarkan secara jelas lengkap (bilamana perlu dilengkapi dengan gambar). apakah ada discussion dari hasil pengujian, mengenai analisis ketercapaian perumusan masalah, kendala dsb 
- Sejauh mana ada kesimpulan yang menjawab perumusan masalah, dan bukan sekedar menyimpulkan bahwa program yang dibuat sudah dapat berfungsi dan bukan menjelaskan desain</textarea>
            </div>

            <!-- CPL 5 -->
            <div class="col-12 mb-2 mt-5">
                <label for="nilaiProgram"><b>CPL 5 - Menentukan metodologi pengembangan perangkat lunak yang sesuai konteks keadaan dan kebutuhan</b></label>
            </div>

            <div class="col-3 mb-2">
                <label for="nilaiProgram">PROGRAM</label>
            </div>
            <div class="col-9 mb-2">
                <input id="nilaiProgram" onkeyup="hitungNilai()" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>Efisiensi program, kesesuaian program dengan rumus/ protocol/ alur bisnis? Apakah rancangan program sudah sesuai teori? Flowchart jelas dan detil? Efisiensi desain DFD/ ERD/ UML</textarea>
            </div>

            <div class="col-3 mb-2 mt-3">
                <label for="totalNilai"><b>Total Nilai</b></label>
            </div>
            <div class="col-9 mb-2 mt-3">
                <input id="totalNilai" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled></input>
            </div>

            
<!-- 
            <div class="col-9 mb-3">
                <input id="nilai_cpl2" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>

            <div class="col-3 mb-3">
                <label for="nilai_cpl3">Nilai CPL 3</label>
            </div>

            <div class="col-9 mb-3">
                <input id="nilai_cpl3" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div>

            <div class="col-3 mb-3">
                <label for="nilai_cpl4">Nilai CPL 4</label>
            </div>

            <div class="col-9 mb-3">
                <input id="nilai_cpl4" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></input>
            </div> -->

            <div class="col-12 text-center mt-3">
                <button class='btn btn-primary' id="input_nilai">Input</button>
            </div>

        </div>    
    </div>


    <!-- Script -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Sweet Alert 2 -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function hitungNilai() {
            var a = document.getElementById("nilaiJudul").value;
            var b = document.getElementById("nilaiBab12").value;
            var c = document.getElementById("nilaiBuku").value;
            var d = document.getElementById("nilaiKonsentrasi").value;
            var e = document.getElementById("nilaiBab5").value;
            var f = document.getElementById("nilaiProgram").value;

            var hitungA = a*0.05;
            var hitungB = b*0.1;
            var hitungC = c*0.1;
            var hitungD = d*0.25;
            var hitungE = e*0.25;
            var hitungF = f*0.25;

            var total = hitungA+hitungB+hitungC+hitungD+hitungE+hitungF;
            document.getElementById("totalNilai").value = total;
        }

        $("#nrp_mahasiswa").val("<?php echo $nrp; ?>");
        $("#nama_mahasiswa").val("<?php echo $name; ?>");
        $("#jurusan").val("<?php echo $jurusan; ?>");
        $("#judul_skripsi").val("<?php echo $thesis_title; ?>");


        $(document).ready(function() {
            $(document).on("click", "#input_nilai", function(){
                // const abc = $("#nilai_cpl1").val();
                // const def = $("#nilai_cpl2").val();
                // const ghi = $("#nilai_cpl3").val();
                // const jkl = $("#nilai_cpl4").val();
                // insert_grade(abc, def, ghi, jkl); 
                
                Swal.fire({
                title: 'Are you sure?',
                text: "Grade will be inputted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var a = $("#nilaiJudul").val();
                        var b = $("#nilaiBab12").val();
                        var c = $("#nilaiBuku").val();
                        var d = $("#nilaiKonsentrasi").val();
                        var e = $("#nilaiBab5").val();
                        var f = $("#nilaiProgram").val();
                        var g = $("#totalNilai").val();
                        var idDosen = "<?php echo $id_dosen; ?>"
                        var idMhs = "<?php echo $id_mahasiswa; ?>"
                        let fd = new FormData;
                        fd.append("a", a);
                        fd.append("b", b);
                        fd.append("c", c);
                        fd.append("d", d);
                        fd.append("e", e);
                        fd.append("f", f);
                        fd.append("g", g);
                        fd.append("idDosen", idDosen);
                        fd.append("idMhs", idMhs);

                        $.ajax({
                            url : 'request/ajax_input_nilai.php',
                            // headers: {"token": token},
                            type: 'POST',
                            data: fd,
                            contentType: false, 
                            processData: false,
                            success: function(res){
                                // alert(res)
                                if(res == 'berhasil 2' || res == 'berhasil 1'){
                                    Swal.fire(
                                    'Nilai berhasil diinput',
                                    'You clicked the button!',
                                    'success'
                                    )
                                }
                                else if(res == 'not numeric'){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Mohon isikan nilai angka',
                                    })
                                }
                                else if(res == 'gaada'){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Dosen dan mahasiswa tidak sesuai',
                                    })
                                }
                                else if(res == 'sdh dinilai'){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Nilai untuk mahasiswa ini sudah diinput',
                                    })
                                }
                                else if(res == 'length > 100'){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Mohon isikan nilai 1-100',
                                    })
                                }
                            },
                            error: function(){
                                alert("gagal");
                            }

                        })
                    }

                    //     $.ajax({
                    //         url : 'ajax_input_nilai.php',
                    //         headers: {"token": token},
                    //         type: 'POST',
                    //         data: fd,
                    //         contentType: false, 
                    //         processData: false,
                    //         success: function(res) {
                    //             var transform = JSON.parse(res);
                    //             Swal.fire({
                    //                 title: transform.title,
                    //                 text: transform.text,
                    //                 icon: transform.icon,
                    //                 confirmButtonText: 'Ok'
                    //             })
                    //         )}
                    //     })
                    // }

                    })
                
                
            });

        });

    </script>
</body>
</html>