<?php include("inc_header.php"); ?>

<?php
$id_buku = "";
$nama_buku = "";
$kategori_buku = "";
$harga = "";
$error = "";
$success = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {
    $id = mysqli_real_escape_string($koneksi, $id);
    $sql1 = "SELECT * FROM buku WHERE id_buku = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_buku = $r1['id_buku'];
    $nama_buku = $r1['nama_buku'];
    $kategori_buku = $r1['kategori_buku'];
    $harga = $r1['harga'];

    if ($id_buku == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $id_buku = $_POST['id_buku'];
    $nama_buku = $_POST['nama_buku'];
    $kategori_buku = $_POST['kategori_buku'];
    $harga = $_POST['harga'];

    if ($id_buku == '' || $nama_buku == '' || $kategori_buku == '' || $harga == ''){
        $error = "Silahkan mengisi data yang kosong";
    }

    if (empty($error)) {
        if ($id != "") {
            $sql1 = "UPDATE buku SET id_buku='$id_buku', nama_buku='$nama_buku', kategori_buku='$kategori_buku', harga='$harga' WHERE id ='$id'";
        } else {
            $sql1 = "INSERT INTO buku (id_buku, nama_buku, kategori_buku, harga) VALUES ('$id_buku','$nama_buku','$kategori_buku','$harga')";
        }

        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $success = "Berhasil memasukkan data";
        } else {
            $error = "Gagal memasukkan data";
        }
    }
}
?>

<h1>Halaman Input Data</h1>
<div class="mb-3 row">
    <a href="halaman_dbbuku.php"><< kembali ke halaman data buku</a>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-primary" role="alert">
            <?php echo $success ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3 row">
            <label for="id_buku" class="col-sm-2 col-form-label">ID Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="id_buku" value="<?php echo $id_buku ?>" name="id_buku">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_buku" class="col-sm-2 col-form-label">Nama Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_buku" value="<?php echo $nama_buku ?>" name="nama_buku">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kategori_buku" class="col-sm-2 col-form-label">Kategori Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kategori_buku" value="<?php echo $kategori_buku ?>" name="kategori_buku">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="harga" value="<?php echo $harga ?>" name="harga">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            </div>
        </div>
    </form>
    <?php include("inc_footer.php")?>
