<?php include("inc_header.php")?> 

<?php
    $sukses = "";
    $katakunci = (isset($_GET['katakunci']))?$_GET['katakunci']:"";
    if(isset($_GET['op'])){
        $op = $_GET['op'];
    }else{
        $op = "";
    }
    if($op == 'delete'){
        $id = $_GET['id'];
        $sql1 = "delete from detail_penjualan where ID_Detail = '$id'";
        $q1 = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "Berhasil menghapus";
        }
    }
?>

<h1>Halaman Detail Penjualan</h1>

<div class="container-fluid">

<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Input Data Baru"/>
    <a>
</p>

<?php if($sukses): ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php endif; ?>

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
            <th>ID Detail</th>
            <th>ID Penjualan</th>
            <th>ID Buku</th>
            <th>Jumlah Pembelian</th>
            <th>Total Harga</th>
            <th class="col-2"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 10;
        if($katakunci !=''){
            $array_katakunci = explode(" ", $katakunci);
            for($x=0;$x < count($array_katakunci);$x++){
                $sqlcari[] = "(ID_Detail like '%".$array_katakunci[$x]."%' || id_pelanggan like '%".$array_katakunci[$x]."%' || id_buku like '%".$array_katakunci[$x]."%')";
            }
            $sqltambahan = " where ".implode(" or ", $sqlcari);
        }
        $sql1 ="select * from detail_penjualan $sqltambahan";
        $page = isset($_GET['page'])?(int)$_GET['page']:1;
        $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $q1 = mysqli_query($koneksi,$sql1);
        $total = mysqli_num_rows($q1);
        $pages = ceil($total / $per_halaman);
        $nomer = $mulai + 1;
        $sql1 = $sql1."order by ID_Detail desc limit $mulai,$per_halaman";

        $q1 = mysqli_query($koneksi, $sql1);
        while($r1 = mysqli_fetch_array($q1)){
        ?>
            <tr>
            <td><?php echo $nomer++?></td>
            <td><?php echo $r1['ID_Detail']?></td>
            <td><?php echo $r1['ID_Penjualan']?></td>
            <td><?php echo $r1['ID_Buku']?></td>
            <td><?php echo $r1['Jumlah_Beli']?></td>
            <td><?php echo $r1['Subtotal_Harga']?></td>
            <td>
                <span class="badge text-bg-warning">
                <a href="halaman_input.php?id=<?= $r1['ID_Detail']?>"  class="text-decoration-none text-light" >
                        Edit
                </a>
                </span>

                <span class="badge text-bg-danger">
                <a href="halaman.php?op=delete&id=<?= $r1['ID_Detail']?>" onclick="return confirm('Konfirmasi penghapusan?')"  class="text-decoration-none text-light">
                        Delete
                    </a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<nav aria-label="Page Navigation Example">
    <ul class="pagination">
        <?php
        $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
        for ($i = 1; $i <= $pages; $i++) {
            ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="halaman.php?katakunci=<?= $katakunci ?>&cari=<?= $cari ?>&page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>

</div>
<?php include("inc_footer.php")?>