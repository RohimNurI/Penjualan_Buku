<?php include("inc_header.php")?> 

<?php
    $katakunci = (isset($_GET['katakunci']))?$_GET['katakunci']:"";
?>

<h1>Halaman Admin</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Buat Halaman Baru"/>
    <a>
</p>

<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukan Kata Kunci" name="katakunci" value="<?php echo $katakunci?>"/>
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" values="Cari Penjualan" class="btn btn-secondary"/>
    </div>
</form>


<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>ID Faktur</th>
            <th>ID Pelanggan</th>
            <th>ID Buku</th>
            <th>Tanggal Pembelian</th>
            <th class="col-2">aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        if($katakunci !=''){
            $array_katakunci = explode(" ", $katakunci);
            for($x=0;$x < count($array_katakunci);$x++){
                $sqlcari[] = "(id_faktur like '%".$array_katakunci[$x]."%' || id_pelanggan like '%".$array_katakunci[$x]."%' || id_buku like '%".$array_katakunci[$x]."%')";
            }
            $sqltambahan = " where ".implode(" or ", $sqlcari);
        }
        
        $sql1 ="select * from penjualan $sqltambahan order by id_faktur desc";
        $q1 = mysqli_query($koneksi, $sql1);
        $nomer = 1;
        while($r1 = mysqli_fetch_array($q1)){
        ?>
            <tr>
            <td><?php echo $nomer++?></td>
            <td><?php echo $r1['id_faktur']?></td>
            <td><?php echo $r1['id_pelanggan']?></td>
            <td><?php echo $r1['id_buku']?></td>
            <td><?php echo $r1['tgl_pembelian']?></td>
            <td>
                <span class="badge text-bg-warning">Edit</span>

                <a href="halaman.php?">
                <span class="badge text-bg-danger">Delate</span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php include("inc_footer.php")?>