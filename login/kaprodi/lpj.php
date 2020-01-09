<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}
    $username = $_SESSION['username'];
    $query = $db->prepare("SELECT * FROM user where username='$username'");
    $query->execute();
    $data2 = $query->fetchAll();

    foreach ($data2 as $value) {
       $z = $value['program_studi'];
    }
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker, user, lpj where lpj.id_proker=proker.id_proker and proker.oleh=user.username and user.program_studi='$z'");
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

    <title>Data Program Kerja</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="../css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>

<body>

    <div id="wrapper">
     <?php include 'menu.php';

        ?>


        <div id="page-wrapper" class="gray-bg">
      <?php include 'header.php';
        ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data <strong>Laporan</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        
                        <li class="active">
                            <strong>LPJ</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
<?php 
        $username = $_SESSION['username'];
        $query = $db->prepare("SELECT * FROM user where username='$username'");
    $query->execute();
    $data2 = $query->fetchAll();

    foreach ($data2 as $value) {
       $z = $value['program_studi'];
    }
    $query = $db->prepare("SELECT * FROM proker, user, lpj where lpj.id_proker=proker.id_proker and proker.oleh=user.username and user.keterangan='Himpunan' and user.program_studi='$z'");
    $query->execute();
    $data = $query->fetchAll();
    ?>
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Himpunan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>RAB</th>
                                    <th>Status LPJ</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $value['nama_kegiatan'] ?></td>
                    <td><?php echo $value['tahun_anggaran'] ?></td>
                    <td><?php echo $value['ketua_pelaksana'] ?></td>
                    <td><?php $d = $value['rancangan_biaya'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_lpj'];
                    if($a=="Menunggu"){
                        echo "warning";
                    }elseif($a=="Telah Disetujui"){
                        echo "primary";
                        }
                        elseif($a=="Telah Ditolak"){
                            echo "danger";
                        }
                    ?>"><?php echo $value['status_lpj'] ?></span></p></td>
                    
                    
                    <td>
                        <a href="download.php?file=<?php echo $value ['file_lpj'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Lihat
                            <br>LPJ
                        </a>
                        
                        
                    </td>
                </tr>
                <?php }
                 ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                                </div>
                            </div>
                            <?php 
        $username = $_SESSION['username'];
    $query = $db->prepare("SELECT * FROM proker, user, lpj where proker.id_proker=lpj.id_proker and proker.oleh=user.username and user.keterangan='Sema & Dema'");
    $query->execute();
    $data = $query->fetchAll();
    ?>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>RAB</th>
                                    <th>Status LPJ</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $value['nama_kegiatan'] ?></td>
                    <td><?php echo $value['tahun_anggaran'] ?></td>
                    <td><?php echo $value['ketua_pelaksana'] ?></td>
                    <td><?php $d = $value['rancangan_biaya'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_lpj'];
                    if($a=="Menunggu"){
                        echo "warning";
                    }elseif($a=="Telah Disetujui"){
                        echo "primary";
                        }
                        elseif($a=="Telah Ditolak"){
                            echo "danger";
                        }
                    ?>"><?php echo $value['status_lpj'] ?></span></p></td>
                    
                    
                    <td>
                        <a href="download.php?file=<?php echo $value ['file_lpj'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Lihat
                            <br>Proposal
                        </a>
                        
                        
                    </td>
                </tr>
                <?php }
                 ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                
            </div>
            
        </div>
        <?php include 'footer.php';
        ?>

        </div>
        </div>

<script type="text/javascript" language="JavaScript">
 function setujui()
 {
 tanya = confirm("Anda Yakin Menyetujui Proposal Ini ?");
 if (tanya == true) return true;
 else return false;
 }</script>
 <script type="text/javascript" language="JavaScript">
 function tolak()
 {
 tanya = confirm("Anda Yakin Menolak Proposal Ini ?");
 if (tanya == true) return true;
 else return false;
 }</script>

    <!-- Mainly scripts -->
    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FooTable -->
    <script src="../js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    </script>

</body>

</html>
