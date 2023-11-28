<?php include("inc_header2.php") ?>

<style>
    button{
        margin-top: 15px;
    }
</style>

<?php
$username ="";
$password ="";
$error = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == '' || $password == ''){
        $error = "Silahkan Isi Bagian Yang Kosong";   
    }else{
        $sql1 = "select * from admin where username = '$username'";
        $q1 = mysqli_query($koneksi,$sql1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if($n1<1){
            $error = "Username Tidak Ditemukan";
        }elseif($r1['password'] != md5($password)){
            $error = "Password Tidak Sesuai";
        }else{
            $_SESSION['admin_username'] = $username;
            header("location:halaman.php");
            exit();
        }
    }
}
?>

<h1 margin="auto">Login Admin</h1>

<?php if($error): ?>
    <div class="alert alert-danger" role="alert">
        <?=$error?>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Masukan Username" value="<?= $username ?>">

        <label for="username">Password</label>
        <input type="text" name="password" id="password" class="form-control" placeholder="Masukan Password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>