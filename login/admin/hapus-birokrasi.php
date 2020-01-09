<?php 
include 'db.php';

$id_birokrasi=$_REQUEST['id_birokrasi'];

$sql = "delete from birokrasi where id_birokrasi='$id_birokrasi'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:birokrasi.php");
?>