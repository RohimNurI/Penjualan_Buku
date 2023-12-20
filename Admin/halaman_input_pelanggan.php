<?php include("inc_header.php"); ?>

<?php
$id_pelanggan   = "";
$nama           = "";
$alamat         = "";
$email          = "";
$nomertlp       = "";
$error          = "";
$success        = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {
    $id = mysqli_real_escape_string($koneksi, $id);
    $sql1 = "SELECT * FROM pelanggan WHERE ID_Pelanggan = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_pelanggan = $r1['ID_Pelanggan'];
    $nama = $r1['Nama'];
    $alamat = $r1['Alamat'];
    $email = $r1['Email'];
    $nomertlp = $r1['Nomor_Telepon'];

    if ($id_pelanggan == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama           = $_POST['Nama'];
    $alamat         = $_POST['Alamat'];
    $email          = $_POST['Email'];
    $nomertlp       = $_POST['Nomor_Telepon'];

    if ($nama == '' || $alamat == '' || $email == '' || $nomertlp == '') {
        $error = "Silahkan mengisi data yang kosong";
    }

    if (empty($error)) {
        if ($id != "") {
            $sql1 = "UPDATE pelanggan SET Nama='$nama', Alamat='$alamat', Email='$email', Nomor_Telepon='$nomertlp' WHERE ID_Pelanggan='$id'";
        } else {
            $sql1 = "INSERT INTO pelanggan (Nama, Alamat, Email, Nomor_Telepon) VALUES ('$nama','$alamat', '$email', '$nomertlp' )";
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

<h1>Halaman Input Data Pelanggan</h1>
<div class="mb-3 row">
    <a href="halaman_dbpelanggan.php"><< kembali ke halaman data pelanggan</a>

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
            <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Nama" value="<?php echo $nama ?>" name="Nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Alamat" value="<?php echo $alamat ?>" name="Alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Email" value="<?php echo $email ?>" name="Email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Nomor_Telepon" class="col-sm-2 col-form-label">Nomer Telepon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Nomor_Telepon" value="<?php echo $nomertlp ?>" name="Nomor_Telepon">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            </div>
        </div>
    </form>
    <?php include("inc_footer.php")?>
