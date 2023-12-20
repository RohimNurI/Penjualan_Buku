<?php
$host       ="localhost";
$user       ="root";
$pass       ="";
$db         ="tokobuku";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("gagal terhubung");
}
?>