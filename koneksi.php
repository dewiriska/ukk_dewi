<?php
$koneksi = mysqli_connect("localhost","root","","ujikom_dewi");

if (mysqli_connect_errno()) {
	echo "koneksi database gagal : " . mysqli_connect_error();
}
?>