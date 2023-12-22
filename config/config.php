<?php 

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_kasir';

$koneksi = mysqli_connect($host,$user,$pass,$dbname);

// if (mysqli_connect_errno()) {
//     echo "gagal koneksi ke database";
//     exit();
// }else {
//     echo "berhasil Konek ke database";
// }

$main_url = 'http://localhost/Kasir/'

?>