<?php
$active = 'dashboard';
$title = 'Dashboard | Absensi';
include 'config.php';
include 'layout/header.php';

date_default_timezone_set('Asia/jakarta');
$today = date('Y-m-d');
session_start(); ?>


<div class="container  min_h">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h4>Absen Siswa</h4>
        </div>
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryAbsen = mysqli_query($conn, "SELECT * FROM tbl_absensi JOIN tbl_siswa ON tbl_siswa.id_siswa=tbl_absensi.id_siswa WHERE tbl_absensi.tanggal = '$today' ORDER BY nama ASC");
                    if (isset($queryAbsen)) :
                        $no = 1;
                        foreach ($queryAbsen as  $Absen) {
                            $siswa              = $Absen['nama'];
                            $id_siswa           = $Absen['id_siswa'];
                            $keterangan         = $Absen['keterangan'];


                            $keteranganwarna    = 'danger';

                            if ($keterangan        == 'Izin') {

                                $keteranganwarna  = 'info';
                            } else if ($keterangan == "Sakit") {

                                $keteranganwarna  = 'warning';
                            }

                            // var_dump($sql)
                    ?>

                            <tr class="text-center">
                                <td><?= $no++; ?></td>
                                <td><?= $Absen['nama'];    ?></td>
                                <td><span class="badge bg-<?= $keteranganwarna ?>"><?= $Absen['keterangan'] ?></span></td>
                                <td><?= $Absen['tanggal'] ?></td>
                            </tr>
                    <?php }
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("layout/footer.php") ?>