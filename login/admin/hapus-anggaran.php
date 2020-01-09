<?php 
include 'db.php';

$id_anggaran=$_REQUEST['id_anggaran'];

$sql = "delete from anggaran where id_anggaran='$id_anggaran'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:anggaranhimpunan.php");
?>