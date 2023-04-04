

<?php 

require_once "includes/connect.php";
require_once "includes/navbar.php";

$token = bin2hex(random_bytes(64));
$_SESSION["token"] = $token;

$count = $con -> prepare("SELECT COUNT(*) FROM `dosen`");
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

    <title>Ganti Role</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
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

        .title {
            color: #FB9A40;
            text-transform: uppercase;
            font-weight: 900;
            -webkit-text-fill-color: #fff;
            -webkit-text-stroke: 0.1px;
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


        .row {
            background-color: #F1FFAB;
            border-radius: 15px;
        }

        .display {
            background-color: white;
        }

        .form-select {
            border: 1px solid #FB9A40;
        }

        .form-select:focus {
            border-color: #FB9A40;
            outline: 0;
            box-shadow: 0 0 0 0.25rem #fb9a403d;
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
        <h1 class="text-center title mt-4">Ganti Role Dosen</h1>

        <div class="row p-3 mt-3 mb-3">
            <div class="col-12 mt-3">
                    <?php
                        echo "<table id='table_id' class='display mt-4'>
                        <thead>
                            <tr>
                                <th class='text-center'>No.</th>
                                <th class='text-center'>Nama Dosen</th>
                                <th class='text-center'>Role</th>
                            </tr>
                        </thead>
                        <tbody>";

                        $i=0;    
                        if ($result_count > 0) {
                        
                            if ($get_data = $con->prepare("SELECT dosen.id, nama, role_website FROM `dosen` JOIN `role_website` ON dosen.role = role_website.id")) {
                            
                                /* execute statement */
                                $get_data->execute();
                            
                                /* bind result variables */
                                $get_data->bind_result($numbering, $name, $original_role);
                            
                                /* fetch values */
                                while ($get_data->fetch()) {
                                    $i++;
                                    $table = "
                                        <tr>
                                            <td class='text-center'>".$i."</td>
                                            <td class='text-center' id='name-".$i."'>".$name."</td>
                                            <td class='text-center'>
                                                <select name='role' id='role' class='role-".$i." form-select' data-scheme=".$numbering." data-compiled=".$i.">
                                                    <option value='null' selected disabled hidden>". $original_role."</option>
                                                    <option value='2'>Dosen</option>
                                                    <option value='3'>Koordinator</option>
                                                </select>
                                            </td>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    
    <!-- Sweet Alert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function loadDetails(){

        }

        $(document).ready(function() {
            $('#table_id').DataTable();
                $(document).on("click", "#role", function(){
                    find = $(this).data('compiled');
                    $(".role-" + find).change(function() {
                        const token = $('meta[name="token"]').attr('content');
                        var a = $(".role-" + find).val();
                        var b = $(this).data('scheme');
                        
                        var c = new FormData;
                        c.append("a", a);
                        c.append("b", b);

                        $.ajax({
                            url : 'request/ajax_role_change.php',
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
                                        
                                    }
                                }
                            )}
                        })
                    });
                });

            

           

        });
        
    </script>
</body>
</html>