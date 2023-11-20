<?php
$host       ="localhost";
$user       ="root";
$pass       ="";
$db         ="sbdtugasbesar1";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("gagal terhubung");
}
?>