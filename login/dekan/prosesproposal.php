<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    $id_proker = $_REQUEST ['id_proker'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proposal, proker where proker.id_proker=proposal.id_proker and proposal.id_proker='$id_proker'");
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

    <title>Proses Proposal</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">

    <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>
<?php

if(isset($_POST['send'])){

$surat=$_REQUEST['surat'];
$lembaran=$_REQUEST['lembaran'];
$kelengkapan=$_REQUEST['kelengkapan'];
$rancangan = $_REQUEST['rancangan'];
$lampiran = $_REQUEST['lampiran'];


$insert = "update syarat set surat='$surat',lembaran='$lembaran',kelengkapan='$kelengkapan',rancangan='$rancangan',lampiran='$lampiran' where id_proker='$id_proker'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();


  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Kelengkapan Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=proposal.php">';
}
?>
<body>

    <div id="wrapper">

    <?php include 'menu.php' ?>

        <div id="page-wrapper" class="gray-bg">
        <?php include 'header.php'; ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Kelengkapan Proposal</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>
                            <a>Proposal</a>
                        </li>
                        <li class="active">
                            <strong>Ceklis Kelengkapan Proposal</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Detail Proposal Kegiatan</h5>
                            
                        </div>
                        <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                                             
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal">
                                
                                <div class="form-group"><label class="col-sm-4 control-label">Lihat Proposal</label>

                                <div class="col-sm-3"><a href="download.php?file=<?php echo $value['file_proposal'] ?>" class="btn-sm btn-primary">Download Proposal Disini</a></div>
                            </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Nama Kegiatan</label>

                                <div class="col-sm-3"><input type="text" class="form-control" value="<?php echo $value['nama_kegiatan'] ?>" readonly></div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label">Nama Ketua Pelaksana</label>

                                <div class="col-sm-3"><input type="text" class="form-control" value="<?php echo $value['ketua_pelaksana'] ?>" readonly></div>
                            </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Surat Keterangan (SK) Kepengurusan Himpunan <br/></label>

                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="surat"> <i></i> Lengkap </label> <label><input type="radio" value="0" name="surat"> <i></i> Tidak Lengkap </label></div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Lembaran Pengesahan Proposal<br/></label>

                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="lembaran"> <i></i> Lengkap </label><label> <input type="radio" value="0" name="lembaran"> <i></i> Tidak Lengkap </label></div>
                                        
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Kelengkapan Isi Proposal <br/></label>

                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="kelengkapan"> <i></i> Lengkap </label><label> <input type="radio" value="0" name="kelengkapan"> <i></i> Tidak Lengkap </label></div>
                                        
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Rancangan Anggaran Biaya (RAB) <br/></label>

                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="rancangan"> <i></i> Lengkap </label><label> <input type="radio" value="0" name="rancangan"> <i></i> Tidak Lengkap </label></div>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group"><label class="col-sm-4 control-label">Lampiran Struktur Kepanitiaan <br/></label>

                                    <div class="col-sm-3">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="lampiran"> <i></i> Lengkap </label><label> <input type="radio" value="0" name="lampiran"> <i></i> Tidak Lengkap </label></div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
                                    <a href="proposal.php" class="btn btn-sm btn-danger">Batal</a></div>
                                    </div>
                                
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>

        </div>
        </div>


    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:25:46 GMT -->
</html>
