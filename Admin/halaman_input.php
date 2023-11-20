<?php include("inc_header.php")?> 

<?php
 $id_pelanggan      ="";
 $id_buku           ="";
 $error             ="";
 $succes            ="";

if(isset($_POST['simpan'])){
    $id_pelanggan      =$_POST['id_pelanggan'];
    $id_buku           =$_POST['id_buku'];

    if($id_pelanggan == '' or $id_buku == ''){
        $error = "Silahkan mengisi data yang kosong";
    }
    if(empty($error)){
        $sql1 ="insert into penjualan (id_pelanggan,id_buku) values ('$id_pelanggan','$id_buku')";
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

<?php
if($error):
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
endif;
?>
<?php
if($succes):
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $succes ?>
    </div>
<?php
endif;
?>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="id_pelanggan" class="col-sm-2 col-form-label">ID Pelanggan</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="id_pelanggan" value="<?php echo $id_pelanggan?>" name="id_pelanggan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="id_buku" class="col-sm-2 col-form-label">ID_Buku</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="id_buku" value="<?php echo $id_buku?>" name="id_buku">
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10">
        <input type="submit" name="simpan" value="simpan data" class="btn btn-primary"/>
        </div>
    </div>
</form>
<?php include("inc_footer.php")?>