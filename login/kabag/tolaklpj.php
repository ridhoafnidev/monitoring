<script src="../sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../sweetalert/sweetalert.css">
<?php
include 'db.php';

$id=$_REQUEST['id_proker'];

$update = "update proker set status_lpj='Telah Ditolak' where id_proker='$id'";
$stmti = $db->prepare($update);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();


  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","LPJ Telah Ditolak!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=lpj.php">';

?>