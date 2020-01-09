<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}
    $id_proker = $_REQUEST['id_proker'];
    $nama = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker,detail_proker, proposal,lpj,user where proposal.id_proker=proker.id_proker and lpj.id_proker=proker.id_proker and proker.id_proker=detail_proker.id_proker and user.username=proker.oleh and user.username='$nama' and proker.id_proker='$id_proker' group by proker.nama_kegiatan");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:25:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Himpunan</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <?php include 'menu.php'; ?>

        <div id="page-wrapper" class="gray-bg">
        <?php include 'header.php'; ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Laporan</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>
                            <a>Himpunan</a>
                        </li>
                        <li class="active">
                            <strong>Laporan</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-7">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Detail Laporan</h5>
                            
                        </div>
                        <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                
                                <div class="form-group"><label class="col-lg-4 control-label">Nama Kegiatan</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $value['nama_kegiatan'] ?> </p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Tahun Anggaran</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $value['tahun_anggaran'] ?></p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Ketua Pelaksana</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $value['ketua_pelaksana'] ?></p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Tanggal Realisasi Anggaran</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $value['tgl_realisasi'] ?></p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Rancangan Anggaran Biaya(RAB)</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php $d = $value['rancangan_biaya'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Bantuan Dana Awal</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php $d = $value['bantuan_awal'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></p></div>
                                </div>
                                <div class="form-group"><label class="col-lg-4 control-label">Realisasi Anggaran Bantuan Dana</label>

                                    <div class="col-lg-8"><p class="form-control-static"><?php $d = $value['realisasi_bantuan'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></p></div>
                                </div>
                                
                                
                               
                            </form>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Download Laporan</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <a href="download.php?file=<?php echo $value['file'] ?>" class="btn-sm btn-primary btn-icon icon-left">
                            <i class="fa fa-eye"></i> Lihat Proker</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <a href="download.php?file=<?php echo $value['file_proposal'] ?>" class="btn-sm btn-primary btn-icon icon-left">
                            <i class="fa fa-eye"></i> Lihat Proposal</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <a href="download.php?file=<?php echo $value['file_lpj'] ?>" class="btn-sm btn-primary btn-icon icon-left">
                            <i class="fa fa-eye"></i> Lihat LPJ</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <a href="cetak1.php?id_proker=<?php echo $value['id_proker'] ?>" class="btn-sm btn-primary btn-icon icon-left">
                            <i class="fa fa-eye"></i> Cetak Kwitansi Bantuan (Tahap 1)</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <a href="cetak1.php?id_proker=<?php echo $value['id_proker'] ?>" class="btn-sm btn-primary btn-icon icon-left">
                            <i class="fa fa-eye"></i> Cetak File Kwitansi Bantuan (Tahap 2)</a>
                                    </div>
                                </div>
                            </form>
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
