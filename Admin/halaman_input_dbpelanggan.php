<?php include("inc_header.php"); ?>

<?php
$id_pelanggan = "";
$nama_pelanggan = "";
$alamat = "";
$error = "";
$success = "";

if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];
} else {
    $id_pelanggan = "";
}

if ($id_pelanggan != "") {
    $sql1 = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama_pelanggan = $r1['nama_pelanggan'];
    $alamat = $r1['alamat'];

    if ($nama_pelanggan == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];

    if ($nama_pelanggan == '' || $alamat == '') {
        $error = "Silahkan mengisi data yang kosong";
    }

    if (empty($error)) {
        if ($id_pelanggan != "") {
            $sql1 = "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat' WHERE id_pelanggan ='$id_pelanggan'";
        } else {
            $sql1 = "INSERT INTO pelanggan (nama_pelanggan,alamat) VALUES ('$nama_pelanggan','$alamat')";
        }

        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $success = "Berhasil memasukan data";
        } else {
            $error = "Gagal memasukan data";
        }
    }
}
?>

<h1>Halaman Input Data Pelanggan</h1>
<div class="mb-3 row">
    <a href="halaman_dbpelanggan.php"><< kembali ke halaman data pelanggan</a>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-primary" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3 row">
            <label for="id_pelanggan" class="col-sm-2 col-form-label">ID Pelanggan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_pelanggan" value="<?php echo htmlspecialchars($id_pelanggan); ?>" name="id_pelanggan" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_pelanggan" value="<?php echo htmlspecialchars($nama_pelanggan); ?>" name="nama_pelanggan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" value="<?php echo htmlspecialchars($alamat); ?>" name="alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            </div>
        </div>
    </form>

<?php include("inc_footer.php"); ?>
