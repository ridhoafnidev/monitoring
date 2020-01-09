<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

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
                        <h2>Selamat Datang, <strong><?php $nama = $_SESSION['nama'];
                        echo "$nama"; ?>! </strong></h2>
                        <h3>di Sistem Informasi Monitoring Unit Kegiatan Mahasiswa Fakultas Sains & Teknologi UIN SUSKA Riau</h3>
                    </div>




            </div>
            <br>

        <div class="row">
            <?php 
              $query = $db->prepare("SELECT * FROM masa_jabatan where status='aktif'");
              $query->execute();
              $masa_jabatan = "";
              $data_mj = $query->fetchAll();
              foreach($data_mj as $data_m){
                  $masa_jabatan = $data_m['tgl_akhir_priode'];
              }
              $tahun_ex = explode("-", $masa_jabatan);
              $tahun = $tahun_ex['0'];
            $username = $_SESSION['username'];
            $query = $db->prepare("SELECT sum(anggaran.anggaran_tersedia) as total_himpunan FROM anggaran, user where user.program_studi=anggaran.program_studi and anggaran.keterangan='Himpunan' and tahun_anggaran='$tahun' and user.username='$username'");
            $query->execute();
            $data = $query->fetchAll();
            ?>

            <div class="col-lg-12">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-1">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <?php $no=0;
                        foreach ($data as $value) {
                        ?>
                        
                        <div class="col-xs-8 text-left">
                            <span> Sisa Anggaran Himpunan Program Studi 
                            <?php 
                            $username = $_SESSION['username'];
                            $query = $db->prepare("SELECT * FROM user where username='$username'");
                            $query->execute();
                            $user = $query->fetchAll();
                            ?>
                            <?php foreach ($user as $y) {
                                $z = $y['program_studi'];
                                echo "$z";
                            } ?>
                            2019 </span>
                            <h2 class="font-bold"><?php $d = $value['total_himpunan'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></h2>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">
                            <div class="col-lg-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <i class="fa fa-bell fa-1x"></i> Status Program Kerja
                                        </div>
                                        <div class="panel-body">
                                             <div>
                                                <table class="table">
                                                    <tbody>
                                                     <tr>
                                                        <td >
                                                            <center><a href="proker.php" class="btn btn-warning m-r-sm"><i class="fa fa-spinner"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proker_tunggu from proker,user where proker.oleh=user.username and status_proker='Menunggu' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proker_tunggu'] ?> </a><?php } ?>
                                                            <br><b>Menunggu K.Prodi</b></center>
                                                        </td>
                                                        <td >
                                                            <center><a href="proker.php" class="btn btn-danger m-r-sm"><i class="fa fa-times"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proker_tolak from proker,user where proker.oleh=user.username and status_proker='Telah Ditolak' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proker_tolak'] ?> </a><?php } ?>
                                                            <br><b>Ditolak K.Prodi</b></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <center><a href="proker.php" class="btn btn-primary m-r-sm"><i class="fa fa-check"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proker_setuju from proker,user where proker.oleh=user.username and status_proker='Telah Disetujui' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proker_setuju'] ?> </a><?php } ?>
                                                            <br><b>Telah Disetujui K.Prodi</b></center>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <i class="fa fa-bell fa-1x"></i> Status Proposal
                                        </div>
                                        <div class="panel-body">
                                            <div>
                                                <table class="table">
                                                    <tbody>
                                                  <tr>
                                                        <td >
                                                            <center><a href="proposal.php" class="btn btn-warning m-r-sm"><i class="fa fa-spinner"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proposal_tunggu from proker,user where proker.oleh=user.username and status_proposal='Menunggu' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proposal_tunggu'] ?> </a><?php } ?>
                                                            <br><b>Menunggu Persetujuan WR</b></center>
                                                        </td>
                                                        <td >
                                                            <center><a href="proposal.php" class="btn btn-danger m-r-sm"><i class="fa fa-times"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proposal_tolak from proker,user where proker.oleh=user.username and status_proposal='Telah Ditolak' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proposal_tolak'] ?> </a><?php } ?>
                                                            <br><b>Ditolak WR</b></center>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <center><a href="proposal.php" class="btn btn-primary m-r-sm"><i class="fa fa-check"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as proposal_setuju from proker,user where proker.oleh=user.username and status_proposal='Telah Disetujui' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['proposal_setuju'] ?> </a><?php } ?>
                                                            <br><b> Telah Disetujui WR</b></center>
                                                        </td>
                                                        
                                                    </tr>
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <i class="fa fa-bell fa-1x"></i> Status LPJ
                                        </div>
                                        <div class="panel-body">
                                            <div>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td >
                                                            <center><a href="datalpj.php" class="btn btn-warning m-r-sm"><i class="fa fa-spinner"></i><?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as lpj_tunggu from proker,user where proker.oleh=user.username and status_lpj='Menunggu' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['lpj_tunggu'] ?> </a><?php } ?>
                                                            <br><b>Menunggu Kabag</b></center>
                                                        </td>
                                                        <td >
                                                            <center><a href="datalpj.php" class="btn btn-danger m-r-sm"><i class="fa fa-times"></i> <?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as lpj_tolak from proker,user where proker.oleh=user.username and status_lpj='Telah Ditolak' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['lpj_tolak'] ?> </a><?php } ?>
                                                            <br><b>Ditolak Kabag</b></center>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <center><a href="datalpj.php" class="btn btn-primary m-r-sm"><i class="fa fa-check"></i> <?php
    include 'db.php';

    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT count(*) as lpj_setuju from proker,user where proker.oleh=user.username and status_lpj='Telah Disetujui' and username='$username'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                        <?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?> <?php echo $value['lpj_setuju'] ?> </a><?php } ?>
                                                            <br><b>Telah Disetujui Kabag</b></center>
                                                        </td>
                                                    </tr>
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>


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

    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Touch Punch - Touch Event Support for jQuery UI -->
    <script src="../js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>

    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>

    <!-- Jvectormap -->
    <script src="../js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>



    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Selamat Datang Di Sistem Informasi Monitoring Unit Kegiatan Mahasiswa Fakultas Sains & Teknologi UIN SUSKA Riau', 'Assalamualaikum..');

            }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 50,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 100,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var doughnutOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 45, // This is 0 for Pie charts
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

            var polarData = [
                {
                    value: 300,
                    color: "#a3e1d4",
                    highlight: "#1ab394",
                    label: "App"
                },
                {
                    value: 140,
                    color: "#dedede",
                    highlight: "#1ab394",
                    label: "Software"
                },
                {
                    value: 200,
                    color: "#A4CEE8",
                    highlight: "#1ab394",
                    label: "Laptop"
                }
            ];

            var polarOptions = {
                scaleShowLabelBackdrop: true,
                scaleBackdropColor: "rgba(255,255,255,0.75)",
                scaleBeginAtZero: true,
                scaleBackdropPaddingY: 1,
                scaleBackdropPaddingX: 1,
                scaleShowLine: true,
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false
            };
            var ctx = document.getElementById("polarChart").getContext("2d");
            var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

        });
    </script>
    
</body>
</html>
