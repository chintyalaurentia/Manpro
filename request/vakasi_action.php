<?php
require_once "../includes/connect.php";

$id = $_POST['id'];
$output = '';

$queryRincian = mysqli_query($con,"SELECT nrp, nama, k.status as statusKehadiran, jabatan FROM `mahasiswa` m JOIN penguji p ON 
p.id_mahasiswa = m.id JOIN kehadiran k ON k.id = p.id_kehadiran JOIN jabatan j ON j.id=p.id_jabatan WHERE p.id_dosen = '$id'");
$no = 1;
while($rowRincian = mysqli_fetch_array($queryRincian)){
    $output .= '
    <tr>
        <td>'.$no++.'</td>
        <td>'.$rowRincian['nrp'].'</td>
        <td>'.$rowRincian['nama'].'</td>
        <td>'.$rowRincian['jabatan'].'</td>
        <td>'.$rowRincian['statusKehadiran'].'</td>
    </tr>';
}
echo $output;
?>