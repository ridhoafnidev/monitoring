<?php 
include 'db.php';

$id=$_REQUEST['id'];
$username = $_REQUEST['username'];

$sql = "delete from user where id='$id';
delete from himpunan where oleh='$username'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:userhimpunan.php");
?>