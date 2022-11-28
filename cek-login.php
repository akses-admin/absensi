<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header('location:dasboard.php');
       
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!');
        document.location.href = 'index.php';
        </script>";
    }
}
