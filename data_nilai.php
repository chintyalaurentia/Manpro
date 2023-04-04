<?php 

require_once "includes/connect.php";
require_once "includes/navbar.php";

$token = bin2hex(random_bytes(64));
$_SESSION["token"] = $token;
$_SESSION["id_dosen"] = 6;

$count = $con -> prepare("SELECT COUNT(*) FROM `mahasiswa`");
$count-> execute();
$count-> bind_result($result_count);
$count-> fetch();   
$count-> close();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="<?= $_SESSION["token"] ?>">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>Data Nilai</title>

    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>    
    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
    <style>
        .fa-xmark {
            color: red;
        }

        .fa-check {
            color: green;
        }
        .table tbody th, .table tbody td{

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

        table tr:first-child th:first-child {
            border-top-left-radius: 0.5rem !important;
        }
        table tr:first-child th:last-child {
            border-top-right-radius: 0.5rem !important;
        }
        table tr:last-child td:first-child {
            border-bottom-left-radius: 0.5rem !important;
        }
        table tr:last-child td:last-child {
            border-bottom-right-radius: 0.5rem !important;
        }

        table tr:first-child th:first-child {
            border-top-left-radius: 0.5rem !important;
        }
        table tr:first-child th:last-child {
            border-top-right-radius: 0.5rem !important;
        }
        table tr:last-child td:first-child {
            border-bottom-left-radius: 0.5rem !important;
        }
        table tr:last-child td:last-child {
            border-bottom-right-radius: 0.5rem !important;
        }

        .display {
            background-color: white;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #f57120;
            border-radius: 10px;
        }

        .title {
            color: #FB9A40;
            text-transform: uppercase;
            font-weight: 900;
            -webkit-text-fill-color: #fff;
            -webkit-text-stroke: 0.1px;
        }

        .row {
            background-color: #F1FFAB;
            border-radius: 15px;
        }

        .display {
            background-color: white;
        }

        table.dataTable {
            margin-top: 5%;
            overflow-x: scroll;
        }

        table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting_asc_disabled, table.dataTable thead > tr > th.sorting_desc_disabled, table.dataTable thead > tr > td.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting_asc_disabled, table.dataTable thead > tr > td.sorting_desc_disabled {
            background-color: #FB9A40;
            color: white;
        }
        
        table.dataTable thead th, table.dataTable thead td {
            border-bottom: 0px solid rgba(0, 0, 0, 0.3);
        }

        table.dataTable.display > tbody > tr.odd > .sorting_1, table.dataTable.order-column.stripe > tbody > tr.odd > .sorting_1 {
            box-shadow: inset 0 0 0 0px rgb(0 0 0 / 5%);
        }

        table.dataTable.display > tbody > tr.even > .sorting_1, table.dataTable.order-column.stripe > tbody > tr.even > .sorting_1 {
            box-shadow: inset 0 0 0 0px rgb(0 0 0 / 2%);
        }

        table.dataTable.order-column > tbody tr > .sorting_1, table.dataTable.order-column > tbody tr > .sorting_2, table.dataTable.order-column > tbody tr > .sorting_3, table.dataTable.display > tbody tr > .sorting_1, table.dataTable.display > tbody tr > .sorting_2, table.dataTable.display > tbody tr > .sorting_3 {
            box-shadow: inset 0 0 0 0px rgb(0 0 0 / 2%);
        }


        table.dataTable.stripe > tbody > tr.odd > *, table.dataTable.display > tbody > tr.odd > * {
            box-shadow: inset 0 0 0 0px rgb(0 0 0 / 2%);
        }

        table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
            border-top: 0px solid rgba(0, 0, 0, 0.15);
            border: solid 1px #FB9A40;
        }

        .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            color: #333;
            margin-top: 2%;
        }

        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter{
            color: #333;
            margin-bottom: 2%;
        }

        .dataTables_wrapper .dataTables_filter input {
            background-color: white;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: white;
        }

        :focus-visible {
            outline: -webkit-focus-ring-color auto 0px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 0px solid rgba(0, 0, 0, 0.3);
            background-color: rgba(230, 230, 230, 0.1);
            background: #FBD341 !important;
        } 
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #FB9A40 !important;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #FB9A40 !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 0px solid #111;
            background-color: #585858;
            background: #FB9A40 !important;
        }


    </style>
</head>
<body>
<!--  -->
<div class="container">
        <h1 class="text-center title mt-4">Input Nilai</h1>

        <div class="row p-3 mt-3 mb-3">
            <div class="col-12 mt-3">
                <?php
                    echo "<table id='table_id' class='display'>
                    <thead>
                        <tr>
                            <th class='text-center'>No.</th>
                            <th class='text-center'>Tanggal Skripsi</th>
                            <th class='text-center'>Nama</th>
                            <th class='text-center'>Judul Skripsi</th>
                            <th class='text-center' style='min-width:125px;'>Input Nilai</th>
                            <th class='text-center'>Status Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>";

                    $i=0;    
                    if ($result_count > 0) {
                    
                        #coba tanya penilaian anggota juga atau ndak
                        if ($get_data = $con->prepare("SELECT mahasiswa.id, mahasiswa.nama, judul_skripsi, tanggal_skripsi, nilaiJudul, nilaiBab12, nilaiBuku, nilaiKonsentrasi, nilaiBab5, nilaiProgram, totalNilai FROM `penguji`
                        RIGHT JOIN `mahasiswa` ON penguji.id_mahasiswa = mahasiswa.id 
                        RIGHT JOIN `penilaian` ON mahasiswa.id = penilaian.id_mahasiswa
                        WHERE id_dosen = ? AND id_penguji = ? ORDER BY tanggal_skripsi")) {

                            $get_data->bind_param("ii",$_SESSION["id_dosen"],$_SESSION["id_dosen"]);

                            /* execute statement */
                            $get_data->execute();
                        
                            /* bind result variables */
                            $get_data->bind_result($numbering, $name, $thesis_title, $date, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6, $nilai7);

                            
                            /* fetch values */
                            while ($get_data->fetch()) {
                                $i++;
                                
                                $grade_total = $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6;
                                $checkGrade = $grade_total == 0 ? "<i class='fa-solid fa-xmark fa-2x'></i>" : "<i class='fa-solid fa-check fa-2x'></i>";
                                $checkGraded = $grade_total == 0 ? "<button class='btn btn-primary' id='grade' data-compiled=".$numbering." value=".$i.">Input Nilai</button>" : "<button class='btn btn-secondary'>Closed</button>";

                                $table = "
                                    <tr>
                                        <td class='text-center'>".$i."</td>
                                        <td id='tanggal-".$i."' class='text-center'>".$date."</td>
                                        <td id='nama-mahasiswa-".$i."' style='width:200px;'>".$name."</td>
                                        <td style='width:350px;'>".$thesis_title."</td>
                                        <td class='text-center' id='check-".$i."'>".$checkGraded."</td>
                                        <td class='text-center' id='grade_status-".$i."'>".$checkGrade."</td>
                                    </tr>";
                                echo $table;
                            }
                        
                            /* close statement */
                            $get_data->close();
                        }
                    

                    }

                    echo " </tbody>
                    </table>";
                ?>
            </div>


        </div>
    </div>
    

    

    
    
    <!-- Script -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Data Table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // function change_description($a, $e){
        //     $("#tanggal-" + $a ).closest("tr").find("td").eq(4).html($e);
        //     $("#check-" + $a).empty();
        //     $("#check-" + $a).append("<button class='btn btn-success'>Approved</button>");
        // }


        function approve_skripsi($b, $d, $f) {
            const token = $('meta[name="token"]').attr('content');
                var b = $b;
                var c = new FormData;
                c.append("b", b);

                $.ajax({
                    url : 'request/ajax_redirect.php',
                    headers: {"token": token},
                    type: 'POST',
                    data: c,
                    contentType: false, 
                    processData: false,
                    success: function(res) {
                        var transform = JSON.parse(res);
                        Swal.fire({
                            icon: transform.icon,
                            title: transform.title,
                            text: transform.text,
                            confirmButtonText: 'Ok',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.open('http://localhost/Manpro/input_nilai.php', '_blank');
                            }
                        }
                    )}
                })
        }
                    
        $(document).ready(function() {
            $('#table_id').DataTable();

            $(document).on("click", "#grade", function(){
                const btn = $(this).val();
                find = $(this).data('compiled');
                name = $("#nama-mahasiswa-" + btn).text();
                approve_skripsi(find, name, btn);                
            });

        });
        
    </script>
</body>
</html>