<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


	$id_detail = $_REQUEST ['id_detail'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM progress where id_detail='$id_detail'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Progress Proyek</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="..//font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<script src="../sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>
<?php
include 'db.php';

if(isset($_POST['send'])){


  $id_detail=$_REQUEST['id_detail'];
  $minggu_ke=$_REQUEST['minggu_ke'];
  $uraian_pekerjaan=$_REQUEST['uraian_pekerjaan'];
  $bobot=$_REQUEST['bobot'];
  $tahap_satu=$_REQUEST['tahap_satu'];
  $tahap_semua=$_REQUEST['tahap_semua'];
  $tingkat_semua=$_REQUEST['tingkat_semua'];
  $kemajuan=$_REQUEST['kemajuan'];
  $progress=$_REQUEST['progress'];
  $rencana=$_REQUEST['rencana'];
  $keterangan=$_REQUEST['keterangan'];

$update = "update progress set minggu_ke='$minggu_ke',uraian_pekerjaan='$uraian_pekerjaan',bobot='$bobot',tahap_satu='$tahap_satu',tahap_semua='$tahap_semua',tingkat_semua='$tingkat_semua',
kemajuan='$kemajuan', progress='$progress',rencana='$rencana', keterangan='$keterangan' where id_detail='$id_detail'";
$stmti = $db->prepare($update);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Progress Berhasil Di Edit!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=progresproyek.php">';
}
?>
<body>
    <div id="wrapper">
        <?php include 'menu.php';

		?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include 'header.php';
		?>
                <div class="row  border-bottom white-bg dashboard-header">
<?php $no = 0;
				foreach ($data as $value) {
					$no++;
											 ?>
											 <?php }
				 ?>
                    <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Progress Proyek</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                        <form  method="post" class="form-horizontal">

                            <div class="form-group"><label class="col-sm-4 control-label">No Kontrak</label>

                                <div class="col-sm-3"><input type="text" name="no_kontrak" value="<?php echo $value['no_kontrak'] ?>" class="form-control" readonly></div>
                            </div>
          <div class="form-group"><label class="col-sm-4 control-label">Minggu Ke</label>
                                        <div class="col-sm-3">
                                          <select class="form-control" name="minggu_ke">
                                          <option value="">-Pilih Minggu Ke Berapa-</option>

                                          <option>Minggu ke-1</option>
                                          <option>Minggu ke-2</option>
                                          <option>Minggu ke-3</option>
                                          <option>Minggu ke-4</option>

                                          </select>
                                        </div>
                                      </div>
            <div class="form-group"><label class="col-sm-4 control-label">Uraian Pekerjaan</label>

                                <div class="col-sm-3"><input type="text" value="<?php echo $value['uraian_pekerjaan'] ?>" name="uraian_pekerjaan" class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Bobot</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['bobot'] ?>" name="bobot" class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Tahap Penyelesaian</label>

                                <div class="col-sm-3"><input type="number"  value="<?php echo $value['tahap_satu'] ?>" name="tahap_satu"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Tahap Penyelesaian Seluruh Pekerjaan</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['tahap_semua'] ?>" name="tahap_semua"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Tahap Penyelesaian Hingga Minggu Lalu</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['tingkat_semua'] ?>" name="tingkat_semua"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Kemajuan Perminggu</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['kemajuan'] ?>" name="kemajuan"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Progress Mingguan</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['progress'] ?>" name="progress"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Rencana Progress MIngguan</label>

                                <div class="col-sm-3"><input type="number" value="<?php echo $value['rencana'] ?>" name="rencana"  class="form-control"></div>
                            </div>
            <div class="form-group"><label class="col-sm-4 control-label">Status</label>
                                          <div class="col-sm-3">
                                            <select class="form-control" name="keterangan">
                                            <option value="">-Pilih Status-</option>
                                            <option >Delay <10%</option>
                                           <option >Delay >10%</option>
                                           <option >In Progress</option>
                                            </select>
                                          </div>
                                        </div>

									<div class="form-group">
									<div class="col-md-4 col-md-offset-4"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
									<a href="dataproyek.php" class="btn btn-sm btn-danger">Batal</a></div>
									</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">




                        </div>
                </div>

            </div>
			<?php
				include 'footer.php'
				?>
        </div>

        </div>





                </div>




        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="../js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../js/plugins/toastr/toastr.min.js"></script>



</body>
</html>
