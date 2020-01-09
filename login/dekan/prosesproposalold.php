<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


	$id_proposal = $_REQUEST ['id_proposal'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proposal, proker where proker.id_proker=proposal.id_proker and id_proposal='$id_proposal'");
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

    <title>Proses Proposal</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<script src="../sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../sweetalert/sweetalert.css">
    <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>
<?php
include 'db.php';

if(isset($_POST['send'])){



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
                            <h5>Ceklis Kelengkapan Proposal</h5>
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

                            <div class="form-group"><label class="col-sm-4 control-label">Nama Kegiatan</label>

                                <div class="col-sm-3"><input type="text" class="form-control" value="<?php echo $value['nama_kegiatan'] ?>" readonly></div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">Nama Ketua Pelaksana</label>

                                <div class="col-sm-3"><input type="text" class="form-control" value="<?php echo $value['ketua_pelaksana'] ?>" readonly></div>
                            </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Checkboxes &amp; radios</label>
                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" name="a"> <i></i> Lengkap </label></div>
                                        <div class="i-checks"><label> <input type="radio" name="a"> <i></i> Tidak Lengkap </label></div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Checkboxes &amp; radios</label>
                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio"  name="b"> <i></i> Lengkap </label></div>
                                        <div class="i-checks"><label> <input type="radio" name="b"> <i></i> Tidak Lengkap </label></div>
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
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>



</body>
</html>
