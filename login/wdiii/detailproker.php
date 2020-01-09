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

    <title>Detail Program Kerja</title>

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
<?php
include 'db.php';

if(isset($_POST['send'])){

$tgl_sub=$_REQUEST['tgl_sub'];
$nama_sub=$_REQUEST['nama_sub'];
$keterangan=$_REQUEST['keterangan'];


$insert = "insert into detail_proker values(' ','$id_proker', '$tgl_sub', '$nama_sub','$keterangan', '0', 'Belum Dikirim', 'Belum Tercapai')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Sub Kegiatan Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=detailproker.php?id_proker='.$id_proker.'">';
}
?>
<?php
include 'db.php';

if(isset($_POST['proposal'])){

move_uploaded_file($_FILES["file_proposal"]["tmp_name"],"../images/" . $_FILES["file_proposal"]["name"]);
$location=$_FILES["file_proposal"]["name"];


$insert = "insert into proposal values(' ','$id_proker', '$location', 'Menunggu',' ', ' ');
update proker set status_proposal='Menunggu' where id_proker='$id_proker'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Proposal Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=detailproker.php?id_proker='.$id_proker.'">';
}
?>
<body>

    <div id="wrapper">
     <?php include 'menu.php';

        ?>


        <div id="page-wrapper" class="gray-bg">
      <?php include 'header.php';
        ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Sub Kegiatan</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a href="proker.php">Program Kerja</a>
                        </li>
                        <li class="active">
                            <strong>Sub Kegiatan</strong>
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
                            <h5>Data Sub Kegiatan</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>


                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <?php 
 $id_proker=$_REQUEST['id_proker'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker,detail_proker where proker.id_proker=detail_proker.id_proker and proker.id_proker='$id_proker'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
                        ?>
                        <div class="ibox-content">
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Sub Kegiatan</th>
                                    <th>Keterangan</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Persentase</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                                <tr>
                    <td><?php echo $no ?></td>
                    <td style="text-align: center;"><?php $hari=date('d', strtotime($value['tgl_sub'])) ?>
                                                        <?php $bulan=date('m', strtotime($value['tgl_sub'])) ?>
                                                        <?php if($bulan=="01"){
                                                            $bulan="Januari";
                                                            }if ($bulan=="02") {
                                                                $bulan="Februari";
                                                            }if ($bulan=="03") {
                                                                $bulan="Maret";
                                                            }if ($bulan=="04") {
                                                                $bulan="April";
                                                            }if ($bulan=="05") {
                                                                $bulan="Mei";
                                                            }if ($bulan=="06"){
                                                                $bulan="Juni";
                                                            }if ($bulan=="07") {
                                                                $bulan="Juli";
                                                            }if ($bulan=="08") {
                                                                $bulan="Agustus";
                                                            }if ($bulan=="09") {
                                                                $bulan="September";
                                                            }if ($bulan=="10") {
                                                                $bulan="Oktober";
                                                            }if ($bulan=="11"){
                                                                $bulan="November";
                                                            }if ($bulan=="12") {
                                                                $bulan="Desember";
                                                            } ?>
                                                        <?php $tahun=date('Y', strtotime($value['tgl_sub'])) ?>
                                                        <?php echo "$hari $bulan $tahun"; ?>
                                                    </td>
                    <td><?php echo $value['nama_sub'] ?></td>
                    <td><?php echo $value['keterangan'] ?></td>
                    <td><?php if ($value['bukti']=="Belum Dikirim") { ?>
                        <p><span class="badge badge-warning"><?php echo $value['bukti'] ?></span></p></td>
                        <?php }else{ ?>
                        <a href="download.php?file=<?php echo $value['bukti'] ?>" class="btn btn-sm btn btn-primary" >Download PDF</a>
                        <?php } ?>
                    <td><p><span class="badge badge-<?php
                    $a = $value['status'];
                    if($a=="Belum Tercapai"){
                        echo "warning";
                    }elseif($a=="Telah Tercapai"){
                        echo "primary";
                        }
                    ?>"><?php echo $value['status'] ?></span></p></td>
                    
                    <td><?php if($value['status']=="Telah Tercapai"&&$value['bukti']!="Belum Dikirim"){ ?>
                        <?php echo $value['persentase'] ?>%
                        <?php }else{ ?>
                        0%
                            <?php } ?> </td>
                    
                </tr>
                <?php }
                 ?>
                 <tr>
                 <td>
                </td>
                 <td align="left">
                 Total Persentase
                 </td>
                 <td></td><td></td><td></td>
                 <td></td><td><?php
    $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
    $query->execute();
    $data2 = $query->fetchAll();
    ?>
    <?php 
                foreach ($data2 as $value2) {?> 
                <?php 
                $c = $value2['total'];
                echo "$c";
          ?>%</td><td></td> <?php } ?>
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
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Roadmap
                                        </div>
                                        <div class="panel-body">
                                            <p>Roadmap berisikan sub-sub kegiatan yang bertujuan untuk memetakan kegiatan dan memberikan titik fokus terhadap kegiatan kemahasiswaan agar dapat dimonitoring dengan tepat.</p>
                                        </div>

            </div>
            </div>
            <div class="col-lg-6">
                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Sub Kegiatan
                                        </div>
                                        <div class="panel-body">
                                            <p>Maksimal sub kegiatan pada roadmap dalam satu kegiatan adalah 5, dan total persentase kelima sub kegiatan tersebut adalah 100%.</p>
                                        </div>

            </div>
            </div>
        </div>
        <?php include 'footer.php';
        ?>

        </div>
        </div>

<script type="text/javascript" language="JavaScript">
 function hapus()
 {
 tanya = confirm("Anda Yakin Menghapus Data Proyek Ini ?");
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
