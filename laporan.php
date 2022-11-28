<?php
$active = 'laporan';
$title = 'Laporan Siswa | Admin';
include("config.php");
include("layout/header.php");


date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d");

$queryRow = mysqli_query($conn, "SELECT * FROM tbl_absensi JOIN tbl_siswa ON tbl_siswa.id_siswa = tbl_absensi.id_siswa WHERE tanggal = $today");

$row = mysqli_num_rows($queryRow);
?>

<div class="container">
    <center>
        <h1 class="mt-5">LAPORAN SISWA</h1>
    </center>
    <br>
    <form method="POST">
        <div class="d-flex align-items-center">
            <div class="me-2 print">
                <label>Dari Tanggal : </label>
                <input type="date" class="form-control print" name="dari_tgl" required="required">
            </div>
            <div class="me-2 print">
                <label> Sampai Tanggal : </label>
                <input type="date" class="form-control print" name="sampai_tgl" required="required">
            </div>
            <div class="me-2 print">
                <input href="" type="submit" name="filter" value="Filter" class="btn btn-primary btn-fill pull-right mt-4 me-2 print">
            </div>
            <div class="ms-auto mt-5 print">
                <a href="" class="btn btn-success mb-2 print" onclick="window.print()">PRINT LAPORAN</a><br>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alfa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $filter = "";
            if (isset($_POST['filter'])) {
                $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                $filter = "AND tanggal >= '$dari_tgl'  AND tanggal <= '" . $sampai_tgl . "'";
                // die($filter);
            }
            $querySiswa = mysqli_query($conn, " SELECT *,
                                                    (SELECT COUNT(*) FROM tbl_absensi a WHERE a.id_siswa  = tbl_siswa.id_siswa AND keterangan = 'Izin' " . $filter . ") AS count_izin,
                                                    (SELECT COUNT(*) FROM tbl_absensi b WHERE b.id_siswa  = tbl_siswa.id_siswa AND keterangan = 'Sakit'" . $filter . ") AS count_sakit,
                                                    (SELECT COUNT(*) FROM tbl_absensi c WHERE c.id_siswa  = tbl_siswa.id_siswa AND keterangan = 'Alfa' " . $filter . ") AS count_alfa  
                                                FROM tbl_siswa");

            foreach ($querySiswa as $absensi) { ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $absensi['nama'] ?></td>
                    <td><?= $absensi['count_izin'] ?></td>
                    <td><?= $absensi['count_sakit'] ?></td>
                    <td><?= $absensi['count_alfa'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/script/jquery.js"></script>

    <script src="assets/datatables/datatables.min.js"></script>

    <script src="assets/script/custom.js"></script>

    <script src="assets/js/sweetalert.js"></script>

    <script src="assets/script/alert.js"></script>

    </body>

    </html>