<?php 
include 'db.php';

$id_ps=$_REQUEST['id_ps'];

$sql = "delete from program_studi where id_ps='$id_ps'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:prodi.php");
?>