<?php 
include 'db.php';

$id=$_REQUEST['id'];

$sql = "delete from user where id='$id'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:userpimpinan.php");
?>