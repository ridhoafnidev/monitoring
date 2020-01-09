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
                    <h2>Data <strong>Proposal</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Himpunan</a>
                        </li>
                        <li class="active">
                            <strong>Proposal</strong>
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
    $query = $db->prepare("SELECT * FROM proker, proposal, user where proker.oleh=user.username and proker.id_proker=proposal.id_proker and user.keterangan='Himpunan'");
    $query->execute();
    $data = $query->fetchAll();
    ?>
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Himpunan</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Sema & Dema</a></li>
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
                                    <th>Ketua</th>
                                    <th>Tgl Realisasi</th>
                                    <th>RAB</th>
                                    <th>Status</th>
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
                    <td><?php echo $value['tgl_realisasi'] ?></td>
                    <td><?php echo $value['rancangan_biaya'] ?></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_proposal'];
                    if($a=="Menunggu"){
                        echo "warning";
                    }elseif($a=="Telah Disetujui"){
                        echo "primary";
                        }
                        elseif($a=="Telah Ditolak"){
                            echo "danger";
                        }
                    ?>"><?php echo $value['status_proposal'] ?></span></p></td>
                    
                    <td>
                        <a href="download.php?file=<?php echo $value ['file_proposal'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Lihat
                            <br>Proposal
                        </a>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">Proses <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="setujuiproker.php?id_proker=<?php echo $value['id_proker'] ?> " onclick="return setujui()">Setujui</a></li>
                                <li><a href="tolakproker.php?id_proker=<?php echo $value['id_proker'] ?> " onclick="return tolak()">Tolak</a></li>
                            </ul>
                        </div>
                        
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
    $query = $db->prepare("SELECT * FROM proker, user where proker.oleh=user.username and user.keterangan='Sema & Dema'");
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
                                    <th>Ketua</th>
                                    <th>Tgl Realisasi</th>
                                    <th>RAB</th>
                                    <th>Status</th>
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
                    <td><?php echo $value['tgl_realisasi'] ?></td>
                    <td><?php echo $value['rancangan_biaya'] ?></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_proposal'];
                    if($a=="Menunggu"){
                        echo "warning";
                    }elseif($a=="Telah Disetujui"){
                        echo "primary";
                        }
                        elseif($a=="Telah Ditolak"){
                            echo "danger";
                        }
                    ?>"><?php echo $value['status_proposal'] ?></span></p></td>
                    
                    <td>
                        <a href="download.php?file=<?php echo $value ['file_proposal'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Lihat <br>Proposal
                        </a>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle">Proses <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="setujuiproker.php?id_proker=<?php echo $value['id_proker'] ?> " onclick="return setujui()">Setujui</a></li>
                                <li><a href="tolakproker.php?id_proker=<?php echo $value['id_proker'] ?> " onclick="return tolak()">Tolak</a></li>
                            </ul>
                        </div>
                        
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
 tanya = confirm("Anda Yakin Menyetujui Program Kerja Ini ?");
 if (tanya == true) return true;
 else return false;
 }</script>
 <script type="text/javascript" language="JavaScript">
 function tolak()
 {
 tanya = confirm("Anda Yakin Menolak Program Kerja Ini ?");
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
