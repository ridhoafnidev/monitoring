<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}
    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM user where username='$username'");
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
                        <h2>Profil Kabag</h2>
                        
                    </div>




            </div>
        
        
            <?php foreach ($data as $value) { ?>
    
            <div class="row">
                <div class="col-lg-4">
                        <div class="widget white-bg p-lg text-center">
                            
                            <img src="../images/<?php echo $value['image'] ?>" height="200" class="img-circle circle-border m-b-md" alt="profile">
                            
                        </div>
                        
                </div>
                <div class="col-lg-8">
                    <div class="widget white-bg p-md text-left">
                       <div class="form-group">
                        <label class="col-md-3 control-label">Nama Kabag</label>
                        <div class="col-md-6"><p class="form-control-static"><?php echo $value['nama'] ?></p></div>
                        </div>
                    </div>
                    <div class="widget white-bg p-md text-left">
                       <div class="form-group">
                        <label class="col-md-3 control-label">Nomor Induk Pegawai</label>
                        <div class="col-md-6"><p class="form-control-static"><?php echo $value['nip'] ?></p></div>
                        </div>
                    </div>
                    <div class="widget white-bg p-md text-left">
                       <div class="form-group">
                        <label class="col-md-3 control-label">Username</label>
                        <div class="col-md-6"><p class="form-control-static"><?php echo $value['username'] ?></p></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        
        <div class="row m-t-lg">
            <div class="col-lg-12">
                                <a href="editprofil.php?id=<?php echo $value['id'] ?>" class="btn btn-sm btn-primary">Edit Profil</a></span> 
                </div>
        </div>
        <?php include 'footer.php' ?>
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
