<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'absensi';

$conn = mysqli_connect($host, $user, $pass, $db) or die('connection failed');

mysqli_select_db($conn, $db);
if ($conn) {
   // echo "koneksi berhasil";
}
