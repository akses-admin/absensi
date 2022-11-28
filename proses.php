<?php include 'config.php';
session_start(); ?>

<?php
// tambah data siswa
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tlp = $_POST['tlp'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($conn, "INSERT INTO tbl_siswa VALUES(null, '$nama', '$email', '$alamat', '$tlp')");
    if ($query) {
        $_SESSION['eksekusi'] = "Siswa berhasil ditambahkan";
        header('location:siswa.php');
    }
}
// hapus data siswa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($conn, "DELETE FROM tbl_siswa WHERE id_siswa = '$id';");
    if ($query) {
        $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
        header('location:siswa.php');
    }
}

// edit data siswa
if (isset($_POST['edit'])) {
    $id = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tlp = $_POST['tlp'];
    $alamat = $_POST['alamat'];

    $query2 = mysqli_query($conn, "UPDATE tbl_siswa SET nama='$nama', email='$email', no_telp='$tlp', alamat='$alamat' WHERE id_siswa='$id';");
    if ($query2) {
        $_SESSION['eksekusi'] = "Data Berhasil Diperbarui";
        header('location:siswa.php');
    }
}

// menambah absen

if (isset($_POST['tambah'])) {
    $siswa = $_POST['siswa'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $query = mysqli_query($conn, "INSERT INTO tbl_absensi VALUES(null, '$siswa', '$keterangan', '$tanggal')");
    if ($query) {
        $_SESSION['eksekusi'] = "Absen berhasil";
        header('location:absen.php');
        $_SESSION['info'] = "berhasil";
        header("Location: absen.php");
    }
}

// hapus data absen
if (isset($_GET['delete2'])) {
    $id = $_GET['delete2'];
    $query = mysqli_query($conn, "DELETE FROM tbl_absensi WHERE id_absen = '$id';");
    if ($query) {
        $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
        header('location:absen.php');
    }
}

// ubah data absen
if (isset($_POST['ubah'])) {

    $id = $_POST['id'];
    $siswa = $_POST['siswa'];
    $keterangan = $_POST['keterangan'];
    $ubah = mysqli_query($conn, "UPDATE tbl_absensi SET id_siswa='$siswa', keterangan='$keterangan' WHERE id_absen='$id';");
    if ($ubah) {
        $_SESSION['eksekusi'] = "Data Berhasil Diperbarui";
        header('location:absen.php');
    }
}





?>

