<?php 
    include "includes/connect_mysqli.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Berita Acara</title>

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

    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
    
	
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
        .container{
            margin: 100px auto;
            width: 100%; 
        }

        .title {
            color: #FB9A40;
            text-transform: uppercase;
            font-weight: 900;
            -webkit-text-fill-color: #fff;
            -webkit-text-stroke: 0.1px;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #f57120;
            border-radius: 10px;
        }
        #data-table th, #data-table td {
		  text-align: center;
		  padding: 12px;
		}
        /* .table thead th {
			padding: 30px;
			font-size: 16px;
			
		}
    	.table tbody tr {
        	margin-bottom: 10px; 
		}
        .table tbody th, .table tbody td {
			border: none;
			padding: 30px;
			font-size: 14px;
			background:  #f4fcac;
			vertical-align: middle;
			border-bottom: 2px solid #f8f9fd; 
		}
        .table thead tr{
            background-color: #f57120;
            color: #fff;
            vertical-align: middle;
        } */
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

        tbody, td, tfoot, th, thead, tr {
            border-color: #FB9A40;
            border-style: solid;
            border-width: 1px;
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

        .page-link {
            color: #FB9A40;            
            background-color: #FBD341;
        }
        .page-item.active .page-link {
            background-color: #FB9A40;
            border-color: #FB9A40;
        }

        .page-link:focus {
            box-shadow: 0 0 0 0.25rem rgb(251 154 64 / 56%)
        }
    </style>
</head>
<body>
<?php 
    include "includes/navbar.php";
?>
    <div class="container">
        <h1 class="text-center title">Generate Berita Acara</h1>
        <button type="button" class="btn btn-primary mt-2 mb-3" data-bs-toggle="modal" data-bs-target="#tabelDocs">Convert to PDF</button>
        <div style="">
            <table style="text-align: center;" class="table table-responsive table-hover text-center rounded" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="min-width: 5vw; max-width: 5vw">NRP</th>
                        <th scope="col" style="min-width: 10vw; max-width: 10vw">Nama</th>
                        <th scope="col" style="min-width: 5vw; max-width: 5vw">Jurusan</th>
                        <th scope="col" style="min-width: 10vw; max-width: 10vw">Tanggal Skripsi</th>
                        <th scope="col" style="min-width: 15vw; max-width: 15vw">Judul Skripsi</th>
                        <th scope="col" style="min-width: 5vw; max-width: 5vw">Ruangan Skripsi</th>
                        <th scope="col" style="min-width: 5vw; max-width: 5vw">Generate/ Open</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = mysqli_query($con,"SELECT status, nrp,  nama, m.id as id, tanggal_skripsi, judul_skripsi, ruangan_skripsi, jurusan FROM mahasiswa m JOIN jurusan j ON m.id_jurusan = j.id");
                    // echo "hi";
                    $no = 1;
                    while($row = mysqli_fetch_array($query))
                    { 
                        if($row[0] != NULL) {?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td class="kolomNrp"><?php echo $row['nrp']; ?></td>
                                <td data-target="nama_pendaftar"><?php echo $row['nama']; ?></td>
                                <td data-target="divisi1"><?php echo $row['jurusan']; ?></td>
                                <td data-target="divisi2"><?php echo $row['tanggal_skripsi']; ?></td>
                                <td data-target="divisi2"><?php echo $row['judul_skripsi']; ?></td>
                                <td data-target="divisi2"><?php echo $row['ruangan_skripsi']; ?></td>
                                <td><a href="hasil.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm text-white">Open</a></td>
                            </tr>
                        <?php }
                        else{ ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td class="kolomNrp"><?php echo $row['nrp']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jurusan']; ?></td>
                                <td><?php echo $row['tanggal_skripsi']; ?></td>
                                <td><?php echo $row['judul_skripsi']; ?></td>
                                <td><?php echo $row['ruangan_skripsi']; ?></td>
                                <td><a class="btn btn-primary btn-sm text-white" data-role="generate" id="generate" data-nrp="<?php echo $row['nrp']; ?>" >Generate</a></td>
                            </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tabelDocs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Convert</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="overflow-x: auto;">
                        <table style="text-align: center;" class="table table-responsive table-hover text-center rounded" id="docsTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="min-width: 5vw; max-width: 5vw">NRP</th>
                                    <th scope="col" style="min-width: 10vw; max-width: 10vw">Nama</th>
                                    <th scope="col" style="min-width: 5vw; max-width: 5vw">Dosen</th>
                                    <th scope="col" style="min-width: 10vw; max-width: 10vw">Jabatan</th>
                                    <th scope="col" style="min-width: 15vw; max-width: 15vw">Tanggal Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $queryTabel = mysqli_query($con,"SELECT tanggal_acc, m.nama as namaMhs,nrp,  d.nama as namaDosen, jabatan FROM mahasiswa m JOIN penguji p ON p.id_mahasiswa = m.id JOIN dosen d ON d.id = p.id_dosen JOIN jabatan j ON j.id = p.id_jabatan JOIN penilaian pe ON pe.id_mahasiswa = p.id_mahasiswa AND pe.id_penguji = p.id_dosen");
                                // echo "hi";
                                $no = 1;
                                while($rowTabel = mysqli_fetch_array($queryTabel))
                                { 
                                    if($rowTabel[0] != NULL) {?> 
                                    
                                    <tr>
                                        <td class="kolomNrp"><?php echo $rowTabel['nrp']; ?></td>
                                        <td data-target="nama_pendaftar"><?php echo $rowTabel['namaMhs']; ?></td>
                                        <td data-target="divisi1"><?php echo $rowTabel['namaDosen']; ?></td>
                                        <td data-target="divisi2"><?php echo $rowTabel['jabatan']; ?></td>
                                        <td data-target="divisi2"><?php echo $rowTabel['tanggal_acc']; ?></td>
                                    </tr>
                                    
                                <?php }
                                else{ ?>
                                    <tr>
                                        <td class="kolomNrp"><?php echo $rowTabel['nrp']; ?></td>
                                        <td data-target="nama_pendaftar"><?php echo $rowTabel['namaMhs']; ?></td>
                                        <td data-target="divisi1"><?php echo $rowTabel['namaDosen']; ?></td>
                                        <td data-target="divisi2"><?php echo $rowTabel['jabatan']; ?></td>
                                        <td data-target="divisi2">Belum dinilai</td>
                                    </tr>

                            <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
        </div>
    </div>

   
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable(); 

            $('#docsTable').DataTable({
            dom: "B<'row'<'col-sm-6'l><'col-sm-6'f>>tipr",
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                buttons: {
                    dom: {
                        button: {
                            tag: "button",
                            className: "btn btn-primary mb-3 mx-1 rounded p-2"
                        },
                        buttonLiner: {
                            tag: null
                        }
                    }
                },
                
        });
 
    

            // $('#docsTable').DataTable(); 

            $(document).on("click", "#generate", function(){
            
                // alert("helo");
                // var nrp = $(this).parent().parent().find(".kolomNrp").html();
                var nrp = $(this).data("nrp");
                // var json_nrp = JSON.stringify(nrp);
                // alert(json_nrp);
                // alert(nrp);
                // let fd = new FormData();
                // fd.append("nrp",nrp);
                // $.ajax({
                //     type: "POST",
                //     url: "skripsi_session.php",
                //     data: fd, 
                //     processData: false,
                //             contentType: false,
                //     success: function(res){
                //         alert(res);
                //     },
                //     error: function(){
                //         alert("gagal");
                //     }
                // });
                
                // $.ajax({
                //     url: "skripsi.php",
                //     method: "POST",
                //     data: nrp,
                //     processData: false,
                //                     contentType: false,
                //     success: function (res) {
                //         // alert("ok")
                //         window.location.href= 'skripsi.php';
                        
                //     },
                //     error: function () {
                //         alert("Gagal");
                //     } 
                // });
                // $("#generate").prop("href", "skripsi.php?nrp="+nrp);
                // window.location.href= 'skripsi_session.php?nrp='+nrp;
                window.open('http://localhost/Manpro/request/skripsi_session.php?nrp='+nrp, '_blank');
            })
            
        })
    </script>

    
</body>
</html>