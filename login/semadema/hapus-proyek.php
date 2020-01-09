<?php
include 'db.php';

$no_kontrak=$_REQUEST['no_kontrak'];

$sql = "delete from proyek where no_kontrak='$no_kontrak';
delete from progress where no_kontrak='$no_kontrak'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

header("Location:dataproyek.php");
?>
