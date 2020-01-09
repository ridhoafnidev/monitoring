	<script src="../sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../sweetalert/sweetalert.css">
<?php
include 'db.php';




$no_kontrak=$_REQUEST['no_kontrak'];

$update = "update proyek set status2='Selesai' where no_kontrak='$no_kontrak'";
$stmti = $db->prepare($update);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();


  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Project Telah Selesai!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=dataproyek.php">';

?>