<?php include("inc_header.php"); ?>

<?php
$id_buku    = "";
$judul      = "";
$penulis    = "";
$penerbit   = "";
$harga      = "";
$stok       = "";
$error      = "";
$success    = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {
    $id = mysqli_real_escape_string($koneksi, $id);
    $sql1 = "SELECT * FROM buku WHERE ID_Buku = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_buku = $r1['ID_Buku'];
    $judul = $r1['Judul'];
    $penulis = $r1['Penulis'];
    $penerbit = $r1['Penerbit'];
    $harga = $r1['Harga'];
    $stok = $r1['Stok'];

    if ($id_buku == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $judul      = $_POST['Judul'];
    $penulis    = $_POST['Penulis'];
    $penerbit   = $_POST['Penerbit'];
    $harga      = $_POST['Harga'];
    $stok       = $_POST['Stok'];

    if ($judul == '' || $penulis == '' || $penerbit == '' || $harga == '' || $stok == ''){
        $error = "Silahkan mengisi data yang kosong";
    }

    if (empty($error)) {
        if ($id != "") {
            $sql1 = "UPDATE buku SET Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', Harga='$harga', Stok='$stok' WHERE id ='$id'";
        } else {
            $sql1 = "INSERT INTO buku (Judul, Penulis, Penerbit, Harga, Stok) VALUES ('$judul','$penulis','$penerbit','$harga', '$stok')";
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
            <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Judul" value="<?php echo $judul ?>" name="Judul">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Penulis" class="col-sm-2 col-form-label">Penulis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Penulis" value="<?php echo $penulis ?>" name="Penulis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Penerbit" class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Penerbit" value="<?php echo $penerbit ?>" name="Penerbit">
            </div>
        </div>
        </div>
        <div class="mb-3 row">
            <label for="Harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Harga" value="<?php echo $harga ?>" name="Harga">
            </div>
        </div>
        </div>
        <div class="mb-3 row">
            <label for="Stok" class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Stok" value="<?php echo $stok ?>" name="Stok">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            </div>
        </div>
    </form>
    <?php include("inc_footer.php")?>
