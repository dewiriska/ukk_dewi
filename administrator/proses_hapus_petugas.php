<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$IDuser = $_POST['IDuser'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from user where IDuser='$IDuser'");
 
// mengalihkan halaman kembali ke index.php
header("location:data_pengguna.php?pesan=hapus");
 
?>