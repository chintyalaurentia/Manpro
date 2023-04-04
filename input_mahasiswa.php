

<?php 

require_once "includes/connect.php";
require_once "includes/navbar.php";

$token = bin2hex(random_bytes(64));
$_SESSION["token"] = $token;

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

    <title>Upload Data Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
    <style>
        tfoot {
            display: table-header-group;
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


        .title {
            color: #FB9A40;
            text-transform: uppercase;
            font-weight: 900;
            -webkit-text-fill-color: #fff;
            -webkit-text-stroke: 0.1px;
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
    <div class="container">
        <h1 class="text-center title mt-4">Upload Data Mahasiswa</h1>

        <div class="row">
            <div class="col-12 mt-3">
                <label for="formFile" class="form-label" name="title">Upload File :</label>
                <input class="form-control" type="file" id="file_mahasiswa">
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-primary" id="upload">Upload</button>
            </div>

            <div class="col-12 mt-3">
                <?php
                    echo "<table id='table_id' class='display'>
                    <thead>
                        <tr>
                            <th class='text-center'>No.</th>
                            <th class='text-center'>Semester</th>
                            <th class='text-center'>Tahun Ajaran</th>
                            <th class='text-center'>NRP</th>
                            <th class='text-center'>Nama</th>
                            <th class='text-center'>Update Data</th>
                        </tr>
                    </thead>
                    <tbody>";

                    $i=0;    
                    if ($result_count > 0) {
                    
                        if ($get_data = $con->prepare("SELECT id, tahun_ajaran, semester, nrp, nama FROM `mahasiswa`")) {
                        
                            /* execute statement */
                            $get_data->execute();
                        
                            /* bind result variables */
                            $get_data->bind_result($numbering, $tahun_ajaran, $semester, $nrp, $name);
                        
                            /* fetch values */
                            while ($get_data->fetch()) {
                                $i++;
                                $table = "
                                    <tr>
                                        <td class='text-center'>".$i."</td>
                                        <td class='text-center'>".$semester."</td>
                                        <td class='text-center'>".$tahun_ajaran."</td>
                                        <td class='text-center'>".$nrp."</td>
                                        <td >".$name."</td>
                                        <td class='text-center'><button class='btn btn-primary' id='update' data-compiled=".$numbering." data-bs-toggle='modal' data-bs-target='#staticBackdrop'  value=".$i.">Update</button></td>
                                    </tr>";
                                echo $table;
                            }
                        
                            /* close statement */
                            $get_data->close();
                        }
                    

                    }

                    echo " </tbody>
                    <tfoot>
                        <tr>
                            <th class='text-center' style='visibility:hidden;'></th>
                            <th class='text-center'>Semester</th>
                            <th class='text-center'>Tahun Ajaran</th>
                        </tr>
                    </tfoot>

                    </table>";
                ?>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Data Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Data Table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    

    <!-- Sweet Alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function loadDetails(){

        }

        $(document).ready(function() {
            var table = $('#table_id').DataTable();

            $("#table_id tfoot th").each( function ( i ) {
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        table.column( i )
                            .search( $(this).val() )
                            .draw();
                    } );
         
                table.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                });
            });

            $( "#upload" ).click(function() {
                $('#upload').prop('disabled', true);
                const token = $('meta[name="token"]').attr('content');
                var a = $("#file_mahasiswa").prop("files")[0];
                var c = new FormData;
                c.append("file_mhs", a);
                $.ajax({
                    url : 'request/ajax_input.php',
                    headers: {"token": token},
                    type: 'POST',
                    data: c,
                    contentType: false, 
                    processData: false,
                    success: function(res) {
                        var transform = JSON.parse(res);
                        Swal.fire({
                            title: transform.title,
                            text: transform.text,
                            icon: transform.icon,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location.reload();
                            }
                        }
                    )}
                })
            });

            function loaddatamahasiswa(e) {
                const token = $('meta[name="token"]').attr('content');
                var e = new FormData;
                e.append("d", d);

                $.ajax({
                    url : 'request/ajax_mahasiswa_content.php',
                    headers: {"token": token},
                    type: 'POST',
                    data: e,
                    contentType: false, 
                    processData: false,
                    success: function(res) {
                        $("#modal-body").html(res);
                    }
                });
            }

            $(document).on("click", "#update-content", function(){
                i = $(this).data('search');
                j = $("#nama-mahasiswa").val();
                k = $("#nrp-mahasiswa").val();
                l = $("#jurusan").val();
                m = $("#tanggal_skripsi").val();
                n = $("#jam_skripsi").val();
                o = $("#judul_skripsi").val();
                p = $("#ruangan").val();
                q = $("#ketua").val();
                r = $("#anggota").val();
                s = $("#pembimbing-1").val();
                t = $("#pembimbing-2").val();
                const token = $('meta[name="token"]').attr('content');
                var u = new FormData;
                u.append("i", i);
                u.append("j", j);
                u.append("k", k);
                u.append("l", l);
                u.append("m", m);
                u.append("n", n);
                u.append("o", o);
                u.append("p", p);
                u.append("q", q);
                u.append("r", r);
                u.append("s", s);
                u.append("t", t);
                $.ajax({
                    url : 'request/ajax_update_mahasiswa.php',
                    headers: {"token": token},
                    type: 'POST',
                    data: u,
                    contentType: false, 
                    processData: false,
                    success: function(success) {
                        var change = JSON.parse(success);
                        Swal.fire({
                            title: change.title,
                            text: change.text,
                            icon: change.icon,
                            confirmButtonText: 'Ok'
                        })
                    }
                });

            });

            $( ".btn-close" ).click(function() {
                $(".modal-body").empty();
            });
            


            $(document).on("click", "#update", function(){
                const btn = $(this).val();
                d = $(this).data('compiled');
                const token = $('meta[name="token"]').attr('content');
                var e = new FormData;
                e.append("d", d);
                $.ajax({
                    url : 'request/ajax_mahasiswa_content.php',
                    headers: {"token": token},
                    type: 'POST',
                    data: e,
                    contentType: false, 
                    processData: false,
                    success: function(res) {
                        $(".modal-body").html(res);
                        $("#staticBackdrop").modal("show");
                    }
                });
            });

        });
        
    </script>
</body>
</html>