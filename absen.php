<?php include 'config.php'; ?>
<?php include 'layout/header.php';

session_start(); ?>


<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center px-3 pt-1">
                <h4>DATA ABSEN SISWA</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus"></i>
                    Absen Siswa
                </button>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Absen Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama:</label>
                                <select class="form-control" name="siswa" id="" aria-label="Default select example" required>
                                    <option value=""> --Pilih Siswa-- </option>
                                    <!-- mengambil data di database -->
                                    <?php
                                    $now = date('Y-m-d');
                                    $sql = mysqli_query($conn, "SELECT * FROM tbl_siswa  WHERE id_siswa NOT IN (SELECT id_siswa FROM tbl_absensi WHERE tanggal = '" . $now . "
                                    ')  ORDER BY nama ASC") or die(mysqli_error($conn));
                                    while ($dt = mysqli_fetch_array($sql)) {
                                        $newid = $dt['id_siswa'];
                                        $nama = $dt['nama'];
                                    ?>

                                        <option value="<?php echo $newid ?>">
                                            <?php echo $nama; ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Keterangan:</label><br>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <span class="badge bg-info">Izin</span>
                                </label>
                                <input class="form-check-input" type="radio" name="keterangan" value="Izin" required>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <span class="badge bg-warning">Sakit</span>
                                </label>
                                <input class="form-check-input" type="radio" name="keterangan" value="Sakit" required>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    <span class="badge bg-danger">Alfa</span>
                                </label>
                                <input class="form-check-input" type="radio" name="keterangan" value="Alfa" required>

                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                <input class="form-control" id="recipient-name" name="tanggal" value="<?= $date ?>" readonly>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- session alert -->
        <?php if (isset($_SESSION['eksekusi'])) :
        ?>

            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" style="margin-left:20px ; margin-right:20px ;"><i class="bi bi-check2"></i>
                <a><?php echo $_SESSION['eksekusi']; ?></a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['eksekusi']);
        endif;

        ?>
        <!-- akhir -->
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = "SELECT * FROM tbl_absensi JOIN tbl_siswa ON tbl_siswa.id_siswa=tbl_absensi.id_siswa ORDER BY id_absen DESC";
                    $sql = mysqli_query($conn, $query);
                    if (isset($sql)) :

                        // var_dump($sql)
                    ?>
                        <?php
                        $no = 1;
                        foreach ($sql as  $result) {
                            $siswa = $result['nama'];
                            $id_siswa = $result['id_siswa'];
                            $keterangan = $result['keterangan'];
                            $keteranganwarna    = 'danger';

                            if ($keterangan == 'Izin') {
                                $keteranganwarna    = 'info';
                            } else if ($keterangan == "Sakit") {
                                $keteranganwarna    = 'warning';
                            }


                        ?>
                            <tr class="text-center">
                                <td><?= $no++; ?></td>

                                <td><?= $result['nama'];    ?></td>
                                <td><span class="badge bg-<?= $keteranganwarna ?>"><?= $result['keterangan'] ?></span></td>
                                <td><?= $result['tanggal'] ?></td>
                                <td>
                                    <a href="" type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $no; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a href="proses.php?delete2=<?= $result['id_absen'] ?>" type="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus???')"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                                <div class="modal fade" id="staticBackdrop<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Data Absen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="proses.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $result['id_absen']; ?>">
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Nama:</label>
                                                        <select class="form-control" name="siswa" id="" aria-label="Default select example" required>
                                                            <?php if ($siswa) {
                                                                echo "<option value='$id_siswa' selected> $siswa </option> ";
                                                            }  ?>
                                                            <?php

                                                            $sql = mysqli_query($conn, "SELECT * FROM tbl_siswa ORDER BY nama ASC") or die(mysqli_error($conn));
                                                            while ($tampil = mysqli_fetch_array($sql)) {

                                                            ?>
                                                                <?php if ($tampil['id_siswa'] != $id_siswa) : ?>
                                                                    <option value="<?php echo $tampil['id_siswa'] ?>">
                                                                        <?php echo $tampil['nama'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php } ?>
                                                        </select>
                                                        <?php if ($keterangan == "Izin") {

                                                            $checkedIzin = 'checked="checked"';
                                                            $checkedSakit = '';
                                                            $checkedAlpa = '';
                                                        } else if ($keterangan == "Sakit") {

                                                            $checkedIzin = '';
                                                            $checkedSakit = 'checked="checked"';
                                                            $checkedAlpa = '';
                                                        } else {
                                                            $checkedIzin = '';
                                                            $checkedSakit = '';
                                                            $checkedAlpa = 'checked="checked"';
                                                        }

                                                        ?>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Keterangan:</label><br>

                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <span class="badge bg-info">Izin</span>
                                                        </label>
                                                        <input class="form-check-input" type="radio" name="keterangan" value="Izin" <?= $checkedIzin ?>>

                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <span class="badge bg-warning">Sakit</span>
                                                        </label>
                                                        <input class="form-check-input" type="radio" name="keterangan" value="Sakit" <?= $checkedSakit ?>>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            <span class="badge bg-danger">Alpa</span>
                                                        </label>
                                                        <input class="form-check-input" type="radio" name="keterangan" value="Alfa" <?= $checkedAlpa ?>>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                                                        <input class="form-control" id="recipient-name" name="tanggal" value="<?= $date ?>" readonly>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name="ubah" onclick=" return confirm('Simpan Perubahan???')">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            </form>
                        <?php } ?>
                        </tr>
                    <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("layout/footer.php") ?>