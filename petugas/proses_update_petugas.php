<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$IDuser = $_POST['IDuser'];
$Nama = $_POST['Nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];
 
// update data ke database
if (!$password) {
	mysqli_query($koneksi,"update user set Nama='$Nama', username='$username', level='$level' where IDuser='$IDuser'");
} else {
	mysqli_query($koneksi,"update user set Nama='$Nama', username='$username', password='$password', level='$level' where IDuser='$IDuser'");
}
 
// mengalihkan halaman kembali ke index.php
header("location:data_pengguna.php?pesan=update");
 
?>