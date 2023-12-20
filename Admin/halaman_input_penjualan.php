<?php include("inc_header.php")?> 

<?php
 $id_penjualan      ="";
 $id_pelanggan      ="";
 $tanggal           ="";
 $tharga            ="";
 $error             ="";
 $succes            ="";

 if(isset($_GET['id'])){
    $id = $_GET['id'];
 }else{
    $id = "";
 }

 if($id !=""){
    $sql1 = "SELECT * FROM penjualan WHERE ID_Penjualan = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_penjualan = $r1['ID_Penjualan'];
    $id_pelanggan = $r1['ID_Pelanggan'];
    $tanggal = $r1['Tanggal_Penjualan'];
    $tharga = $r1['Total_Harga'];

    if($id_penjualan == ''){
        $error = "data tidak ditemukan";
    }
 }

if(isset($_POST['simpan'])){
    $id_pelanggan      =$_POST['ID_Pelanggan'];
    $tanggal           =$_POST['Tanggal_Penjualan'];
    $tharga            =$_POST['Total_Harga'];

    if($id_pelanggan == '' || $tharga == ''){
        $error = "Silahkan mengisi data yang kosong";
    }
    if(empty($error)){
        if($id != ""){
            $sql1 = "UPDATE penjualan SET ID_Pelanggan='$id_pelanggan', Tanggal_Penjualan='$tanggal', Total_Harga='$tharga' WHERE ID_Penjualan='$id'";
        }else{
            $sql1 ="INSERT INTO penjualan (ID_Pelanggan,Tanggal_Penjualan,Total_Harga ) values ('$id_pelanggan','$tanggal','$tharga')";
        }

        $q1 = mysqli_query($koneksi,$sql1);
        if($q1){
            $succes ="Berhasil memasukan data";
        }else{
            $error ="gagal memasukan data";
        }
    }
}
?>

<h1>Halaman Data Penjualan</h1> 
<div class="mb-3 row">
    <a href="halaman_dbpenjualan.php"><< kembali ke halaman admin</a> 

<?php if($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php endif; ?>
<?php if($succes): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $succes ?>
    </div>
<?php endif; ?>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="ID_Pelanggan" class="col-sm-2 col-form-label">ID Pelanggan</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="ID_Pelanggan" value="<?php echo $id_pelanggan?>" name="ID_Pelanggan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Tanggal_Penjualan" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
        <div class="col-sm-10">
        <input type="date" class="form-control" id="Tanggal_Penjualan" value="<?php echo $tanggal?>" name="Tanggal_Penjualan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Total_Harga" class="col-sm-2 col-form-label">Total Harga</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="Total_Harga" value="<?php echo $tharga?>" name="Total_Harga">
        </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
        <input type="submit" name="simpan" value="simpan data" class="btn btn-primary"/>
        </div>
    </div>
</form>
<?php include("inc_footer.php")?>