<?php
include 'config.php';
$date = date('y/m/d');
date_default_timezone_set("Asia/Jakarta")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/css.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/datatables/datatables.min.css">
    <title><?= $title ?></title>

    <style>
        @media print {

            .print,
            .navbar {
                display: none;
            }

            .container {
                width: 100%;
            }
        }

        .min_h {
            min-height: 410px;
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-md py-3">
        <div class="container">
            <a class="navbar-brand" href="dasboard.php">Absensi XII RPL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'dashboard' ? 'active' : '' ?>" aria-current="page" href="dasboard.php">Dasboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'siswa' ? 'active' : '' ?> " href="siswa.php">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'absen' ? 'active' : '' ?>" href="absen.php">Absen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active == 'laporan' ? 'active' : '' ?>" href="laporan.php">Laporan Absen</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="logout.php" onclick=" return confirm('Apakah anda yakin ingin logout???')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script defer src="assets/fontawesome/js/brands.js"></script>
    <script defer src="assets/fontawesome/js/solid.js"></script>
    <script defer src="assets/fontawesome/js/fontawesome.js"></script>