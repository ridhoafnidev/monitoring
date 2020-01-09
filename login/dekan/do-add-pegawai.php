<?php
include 'db.php';

$nip=$_REQUEST['nip'];
$nama_peg=$_REQUEST['nama_peg'];
$pangkat=$_REQUEST['pangkat'];
$golongan=$_REQUEST['golongan'];
$jabatan=$_REQUEST['jabatan'];
$masa_kerja=$_REQUEST['masa_kerja'];
$honor_perbulan=$_REQUEST['honor_perbulan'];
$tempat_lahir=$_REQUEST['tempat_lahir'];
$tanggal_lahir=$_REQUEST['tanggal_lahir'];

	
$insert = "insert into pegawai values('$nip','$nama_peg','$pangkat','$golongan','$jabatan','$masa_kerja','$honor_perbulan','$tempat_lahir','$tanggal_lahir')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();

header("Location:datapegawai.php")
?>