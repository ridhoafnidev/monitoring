<script src="../sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" href="../sweetalert/sweetalert.css">

<?php 
include 'db.php';

$id_proker=$_REQUEST['id_proker'];
$id_detail=$_REQUEST['id_detail'];

$sql = "delete from detail_proker where id_detail='$id_detail' and id_proker='$id_proker'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

echo '<script type="text/javascript">';
echo 'setTimeout(function () { swal("Sukses!","Sub Kegiatan Berhasil Dihapus!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=detailproker.php?id_proker='.$id_proker.'">';
?>