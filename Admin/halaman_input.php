<?php include("inc_header.php")?> 

<?php
 $id_detail         ="";
 $id_penjualan      ="";
 $id_buku           ="";
 $jumlah            ="";
 $tharga            ="";
 $error             ="";
 $succes            ="";

 if(isset($_GET['id'])){
    $id = $_GET['id'];
 }else{
    $id = "";
 }

 if($id !=""){
    $sql1 = "select * from detail_penjualan where ID_Detail = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_detail = $r1['ID_Detail'];
    $id_penjualan = $r1['ID_Penjualan'];
    $id_buku = $r1['ID_Buku'];
    $jumlah = $r1['Jumlah_Beli'];
    $tharga = $r1['Subtotal_Harga'];

    if($id_detail == ''){
        $error = "data tidak ditemukan";
    }
 }

if(isset($_POST['simpan'])){
    $id_penjualan      =$_POST['ID_Penjualan'];
    $id_buku           =$_POST['ID_Buku'];
    $jumlah            =$_POST['Jumlah_Beli'];
    $tharga            =$_POST['Subtotal_Harga'];

    if($id_penjualan == '' || $id_buku == '' || $jumlah == '' || $tharga == ''){
        $error = "Silahkan mengisi data yang kosong";
    }
    if(empty($error)){
        if($id != ""){
            $sql1 = "UPDATE detail_penjualan SET ID_Penjualan='$id_penjualan', ID_Buku='$id_buku', Jumlah_Beli='$jumlah', Subtotal_Harga='$tharga' WHERE ID_Detail='$id'";
        }else{
            $sql1 ="INSERT INTO detail_penjualan (ID_Penjualan,ID_Buku,Jumlah_Beli,Subtotal_Harga ) values ('$id_penjualan','$id_buku','$jumlah','$tharga')";
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

<h1>Halaman Input Data</h1> 
<div class="mb-3 row">
    <a href="halaman.php"><< kembali ke halaman admin</a> 

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
        <label for="ID_Penjualan" class="col-sm-2 col-form-label">ID Penjualan</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="ID_Penjualan" value="<?php echo $id_penjualan?>" name="ID_Penjualan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="ID_Buku" class="col-sm-2 col-form-label">ID Buku</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="ID_Buku" value="<?php echo $id_buku?>" name="ID_Buku">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Jumlah_Beli" class="col-sm-2 col-form-label">Jumlah Pembelian</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="Jumlah_Beli" value="<?php echo $jumlah?>" name="Jumlah_Beli">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Subtotal_Harga" class="col-sm-2 col-form-label">Total Harga</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="Subtotal_Harga" value="<?php echo $tharga?>" name="Subtotal_Harga">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
        <input type="submit" name="simpan" value="simpan data" class="btn btn-primary"/>
        </div>
    </div>
</form>
<?php include("inc_footer.php")?>