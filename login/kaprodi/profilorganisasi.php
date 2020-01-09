<?php
include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}
    $id = $_REQUEST['id'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM himpunan, user where himpunan.oleh=user.username and user.id='$id'");
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

    <title>Home</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include 'menu.php';

		?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include 'header.php';
		?>
                <div class="row  border-bottom white-bg dashboard-header">

                    <div class="col-lg-12-6">
                        <h2>Profil Himpunan</h2>
                        
                    </div>

            </div>
            <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
            <div class="row">
                <div class="col-lg-4">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                <?php echo $value['nama_himpunan']; ?>
                            </h2>
                                <small> Periode <?php echo $value['periode']; ?></small>
                            </div>
                            <img src="../images/<?php echo $value['logo_himpunan']; ?>" class="img-circle circle-border m-b-md" alt="profile">
                            <div>
                                <span><a href="download.php?file=<?php echo $value['pdf'] ?>" class="btn btn-primary btn-xs"  ><center><i class="fa fa-download"></i> Download</center></span></a>
                            </div>
                        </div>
                        
                </div>
                <div class="col-lg-8">
                    <div class="widget navy-bg p-lg text-left">
                        <div class="m-b-md">
                            
                            <h1 class="m-xs">Visi</h1>
                            
                            <small><?php echo $value['visi']; ?></small>
                        </div>
                    </div>
                    <div class="widget  navy-bg p-lg text-left">
                        <div class="m-b-md">
                            
                            <h1 class="m-xs">Misi</h1>
                            
                            <small><?php echo $value['misi']; ?></small>
                        </div>
                    </div>
                </div>
                
                
            </div>
        <div class="row m-t-sm">
            
            <div class="col-lg-12">
                
                <div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ibox-content text-center">
                                <h3>Ketua</h3>
                                <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="../img/profile_small.jpg" />
                                </div>
                                        <p class="font-bold"><?php echo $value['ketua']; ?></p>
                                        <p class="font-bold"><?php echo $value['nim_ketua']; ?></p>

                                
                            </div>


                        </div>
                        <div class="col-lg-3">
                            <div class="ibox-content text-center">
                                <h3>Wakil Ketua</h3>
                                <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="../img/profile_small.jpg" />
                                </div>
                                        <p class="font-bold"><?php echo $value['wakil_ketua']; ?></p>
                                        <p class="font-bold"><?php echo $value['nim_wk']; ?></p>

                                
                            </div>
                            

                        </div>
                        <div class="col-lg-3">
                            <div class="ibox-content text-center">
                                <h3>Sekretaris</h3>
                                <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="../img/profile_small.jpg" />
                                </div>
                                        <p class="font-bold"><?php echo $value['sekretaris']; ?></p>
                                        <p class="font-bold"><?php echo $value['nim_sekre']; ?></p>

                                
                            </div>
                            

                        </div>
                        <div class="col-lg-3">
                            <div class="ibox-content text-center">
                                <h3>Bendahara</h3>
                                <div class="m-b-sm">
                                        <img alt="image" class="img-circle" src="../img/profile_small.jpg" />
                                </div>
                                        <p class="font-bold"><?php echo $value['bendahara']; ?></p>
                                        <p class="font-bold"><?php echo $value['nim_bendahara']; ?></p>

                                
                            </div>

                        </div>
                        
                    </div>


                </div>
            </div>
        </div>
        <?php } ?>
        
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

    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Touch Punch - Touch Event Support for jQuery UI -->
    <script src="../js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>

    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>

    <!-- Jvectormap -->
    <script src="../js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>



    
    
</body>
</html>

