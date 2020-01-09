<?php
    include 'db.php';



include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}

  $no_kontrak = $_REQUEST ['no_kontrak'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    //$query = $db->prepare("SELECT * FROM progress,proyek,kegiatan where progress.no_kontrak=proyek.no_kontrak and kegiatan.no_kontrak=progress.no_kontrak and progress.no_kontrak='$no_kontrak' GROUP BY kegiatan.kegiatan;");
    // Jalankan perintah SQL
    $query = $db->prepare("SELECT * FROM proyek where no_kontrak='$no_kontrak'");
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kegiatan Proyek</title>

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

$no_kontrak=$_REQUEST['no_kontrak'];
$kegiatan=$_REQUEST['kegiatan'];
$status=$_REQUEST['status'];

$insert = "insert into kegiatan values(' ','$no_kontrak','$kegiatan','$status')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Kegiatan Berhasil Di Tambah!","success");})</script>';
echo '<meta http-equiv="Refresh" content="0.5; URL=lihat-detail.php?no_kontrak='.$no_kontrak.'">';
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
                    <h2>Data Progress Proyek</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Proyek</a>
                        </li>
                        <li class="active">
                            <strong>Detail Progress Proyek</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="ibox float-e-margins">
                               
                <div class="col-lg-4"><a href="dataproyek.php" class="btn btn-default"><i class="fa fa-reply"></i> Kembali</a>
                        <a href="cetak.php?no_kontrak=<?php echo $no_kontrak ?>" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a></div>
                    </div>
            </div>
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        
                        <div class="ibox-title">
                            <h5>Detail Progress Data Proyek dengan No Kontrak : <?php echo $no_kontrak ?></h5>

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
                            

                            <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                
                                <tbody>
                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++; 
                                             ?>
                                <tr>
                                <td width="50%">NOMOR KONTRAK</td> <td><?php echo $value['no_kontrak'] ?></td>
                                </tr>
                                <tr>
                                <td>NOMOR SR</td><td><?php echo $value['no_sr'] ?></td></tr>
                                
                                <tr>
                                <td>NAMA PROYEK</td><td><?php echo $value['nama_proyek'] ?></td></tr>
                                <tr>
                                <td>PELAKSANA</td><td><?php echo $value['pelaksana'] ?></td></tr>
                                <tr>
                                <td>TANGGAL MULAI PROYEK </td><td><?php echo date('d F Y', strtotime($value['waktu'])) ?></td></tr>
                                <tr>
                                <td>TANGGAL BERAKHIR PROYEK</td><td><?php echo date('d F Y', strtotime($value['waktu_berjalan'])) ?></td></tr>
                                <tr>
                                <td>WAKTU TERSISA</td><td><?php 

                    $tgl=getdate();
                    $tanggal=$tgl['year'].'-'.$tgl['mon'].'-'.$tgl['mday'];
                    $sisa = new DateTime($tanggal);
                    $akhir=new DateTime($value['waktu_berjalan']);
                    $jml2=$akhir->diff($sisa)->format("%a");

                    if($sisa < $akhir){
                        echo "$jml2 hari";
                    }else{
                        echo "Masa Proyek Telah Habis";
                    }

                 ?></td></tr>
                                <tr>
                                <td>PROJECT CONTROL</td><td><?php echo $value['pc'] ?></td></tr>
								<tr>
                                <td>NILAI PROYEK</td><td><?php 
					$total = $value['nilai'];
					echo "Rp. ". number_format($total, 0, ".", ".")."";
					?></td></tr>
                                <tr>
                                <td>TEMPAT</td><td><?php echo $value['tempat'] ?></td></tr>
                                
                <?php }
                 ?>
                                </tbody>
                                
                            </table>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox-title">

                            <h5>Gambar Proyek</h5>

                            <div class="ibox-tools">

                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>


                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                                <div align="center"><img width="500"  src="../images/<?php echo $value['images']; ?>" />
                            </div>
                        </div>
                </div>
            </div>
            <?php
    

  $no_kontrak = $_REQUEST ['no_kontrak'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM progress,proyek where progress.no_kontrak=proyek.no_kontrak and progress.no_kontrak='$no_kontrak' order by progress.minggu_ke");
    // Jalankan perintah SQL
   
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();

?>
<?php foreach ($data2 as $value){
                                $a = $value['minggu_ke'];
                               
                             ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Progress Proyek Minggu Ke : <?php echo $a ?> </h5>

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
                            

                            <table class="footable table table-stripped" data-page-size="12" data-filter=#filter>
                                
                                <tbody>
                                
                                                                                              
                                <tr>
                                <td>URAIAN PEKERJAAN</td><td width="65%"><?php echo $value['uraian_pekerjaan'] ?></td><td></td></tr>
                                <tr>
                                <td>BOBOT</td><td><div class="progress progress-striped active">
                                <div style="width: <?php echo $value['bobot'] ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $value['bobot'] ?>" role="progressbar" class="progress-bar progress-bar-primary">
                
                            <?php echo $value['bobot'] ?>%</div></td></tr>
                                
                                
                                <tr>
                                <td>PROGRESS MINGGU INI</td><td><div class="progress progress-striped active">
                                <div style="width: <?php echo $value['progress'] ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $value['progress'] ?>" role="progressbar" class="progress-bar progress-bar-primary">
                                <?php echo $value['progress'] ?>%</div></td>
                                </tr>
                               <tr>
                                <td>RENCANA MINGGU DEPAN</td><td><div class="progress progress-striped active">
                                <div style="width: <?php echo $value['rencana'] ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $value['rencana'] ?>" role="progressbar" class="progress-bar progress-bar-primary">
                                <?php echo $value['rencana'] ?>%</div></td>
                                </tr> 
                                
                                
                                </tbody>
                                
                            </table>
                           

                        </div>

                    </div>
                      <?php }
                 ?>
                 <?php 
                 foreach ($data as $value) {
                    $a = $value['status2'];
                 
                 
                if($value['status2']=="Belum Selesai"){ ?>
                 <div class="ibox float-e-margins">
                 <a href="udah.php?no_kontrak=<?php echo $value['no_kontrak'] ?>" class="btn btn-primary" onclick="return udah()"><i class="fa fa-check"></i>Project Selesai?</a>
                 <?php }elseif ($value['status2']=="Selesai") { ?>
                     <div class="ibox float-e-margins">
                        <span class="badge badge-plain"><h2>Project Ini Telah Selesai</h2></span>
                    </div>
                <?php }else { ?>
                    <div class="ibox float-e-margins">
                        <span class="badge badge-plain"><h2>Belum Ada Progress</h2></span>
                    </div>
                
                 
             <?php }
             } ?>
             </div>
                </div>

            </div>
            
            
            
        </div>
       

        </div>

        </div>

<script type="text/javascript" language="JavaScript">
 function udah()
 {
 tanya = confirm("Apakah Anda Yakin Mengubah Status Project Menjadi Selesai ?");
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
