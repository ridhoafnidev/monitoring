<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    $id_detail = $_REQUEST ['id_detail'];
    $id_proker = $_REQUEST ['id_proker'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM detail_proker where id_proker='$id_proker' and id_detail='$id_detail'");
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

    <title>Edit Sub Kegiatan</title>

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

move_uploaded_file($_FILES["bukti"]["tmp_name"],"../images/" . $_FILES["bukti"]["name"]);
$location=$_FILES["bukti"]["name"];
$status=$_REQUEST['status'];

$update = "update detail_proker set bukti='$location',status='$status' where id_detail='$id_detail' and id_proker='$id_proker';";
$stmti = $db->prepare($update);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();


  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Sub Kegiatan Berhasil Di Edit!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=detailproker.php?id_proker='.$id_proker.'">';
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
                            <h5>Edit Sub Kegiatan</h5>
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
                        <form  method="post" class="form-horizontal" enctype="multipart/form-data">

                            <div class="form-group"><label class="col-sm-4 control-label">Nama Sub Kegiatan</label>

                            <div class="col-sm-3"><input type="text" value="<?php echo $value['nama_sub'] ?>" class="form-control" readonly></div>
                            </div>
          <div class="form-group"><label class="col-sm-4 control-label">Status Kegiatan</label>
                                        <div class="col-sm-3">
                                          <select class="form-control" name="status">
                                          <option value="">-Pilih Status Kegiatan-</option>
                                          <option>Belum Tercapai</option>
                                          <option>Telah Tercapai</option>
                                          </select>
                                        </div>
                                      </div>
                            <div class="form-group"><label class="col-sm-4 control-label">Upload Bukti</label>

                            <div class="col-sm-3"><input type="file" name="bukti" class="form-control" required></div>
                            </div>
            

                                    <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
                                    <a href="detailproker.php?id_proker=<?php echo $value['id_proker'] ?>" class="btn btn-sm btn-danger">Batal</a></div>
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
