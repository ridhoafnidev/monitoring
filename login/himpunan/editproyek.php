<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


	$no_kontrak = $_REQUEST ['no_kontrak'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proyek where no_kontrak='$no_kontrak'");
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

    <title>Edit Proyek</title>

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


$no_kontrak=$_REQUEST['no_kontrak'];
$no_sr=$_REQUEST['no_sr'];
$nama_proyek=$_REQUEST['nama_proyek'];
$team=$_REQUEST['team'];
$pelaksana=$_REQUEST['pelaksana'];
$waktu=$_REQUEST['waktu'];
$waktu_berjalan=$_REQUEST['waktu_berjalan'];
$pc=$_REQUEST['pc'];
$tempat=$_REQUEST['tempat'];

$update = "update proyek set no_sr='$no_sr',nama_proyek='$nama_proyek',team='$team',pelaksana='$pelaksana',waktu='$waktu',waktu_berjalan='$waktu_berjalan',pc='$pc',tempat='$tempat' where no_kontrak='$no_kontrak'";
$stmti = $db->prepare($update);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data User Berhasil Di Edit!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=dataproyek.php">';
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
                            <h5>Edit User</h5>
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
								<input type="hidden" name="no_kontrak" value="<?php echo $value['no_kontrak'] ?>">
										<div class="form-group"><label class="col-sm-2 control-label">Nomor SR</label>
											<div class="col-sm-3"><input type="text" name="no_sr" value="<?php echo $value['no_sr'] ?>" class="form-control" ></div>
										</div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Nama Proyek</label>
											<div class="col-sm-3"><input type="text" name="nama_proyek" value="<?php echo $value['nama_proyek'] ?>" class="form-control" ></div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Team</label>
                                            <div class="col-sm-3"><input type="text" name="team" value="<?php echo $value['team'] ?>" class="form-control" ></div>
                                        </div>
										<div class="form-group"><label class="col-sm-2 control-label">Pelaksana</label>
											<div class="col-sm-3"><input type="text" name="pelaksana" value="<?php echo $value['pelaksana'] ?>" class="form-control" ></div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Jangka Waktu</label>
											<div class="col-sm-3"><input type="text" name="waktu" value="<?php echo $value['waktu'] ?>" class="form-control" ></div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Waktu Berjalan</label>
											<div class="col-sm-3"><input type="text" name="waktu_berjalan" value="<?php echo $value['waktu_berjalan'] ?>" class="form-control" ></div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Project Control</label>
											<div class="col-sm-3"><input type="text" name="pc" value="<?php echo $value['pc'] ?>" class="form-control" ></div>
										</div>
										<div class="form-group"><label class="col-sm-2 control-label">Tempat</label>
											<div class="col-sm-3"><input type="text" name="tempat" value="<?php echo $value['tempat'] ?>" class="form-control" ></div>
										</div>
										

									<div class="form-group">
									<div class="col-md-3 col-md-offset-2"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
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
