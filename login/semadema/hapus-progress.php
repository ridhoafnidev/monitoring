<?php
include 'db.php';

$id_detail=$_REQUEST['id_detail'];

$sql = "delete from progress where id_detail='$id_detail'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:progresproyek.php");
?>
