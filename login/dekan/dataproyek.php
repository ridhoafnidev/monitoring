<?php
    include 'db.php';



include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proyek");
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

    <title>Data Proyek</title>

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
                    <h2>Data Proyek</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Proyek</a>
                        </li>
                        <li class="active">
                            <strong>Rincian Proyek</strong>
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
                            <h5>Data Proyek</h5>

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
                            <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Contract Number</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Rentang Waktu</th>
                                    <th>Waktu Tersisa</th>
                                    <th>Team</th>
                                    <th>Project Control</th>
                                    <th>Tempat</th>
                                    <th>Nilai</th>
                                    <th>Status Progress</th>
                                    <th >Aksi</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0;
				foreach ($data as $value) {
					$no++;
											 ?>
                                <tr>
					<td><?php echo $no ?></td>
					<td><?php echo $value['nama_proyek'] ?></td>
					<td style="text-align: center;"><?php echo date('d F Y', strtotime($value['waktu'])) ?></td>
                    <td style="text-align: center;"><?php echo date('d F Y', strtotime($value['waktu_berjalan'])) ?></td>
                    <td><?php 
                    $awal=new DateTime($value['waktu']);
                    $akhir=new DateTime($value['waktu_berjalan']);
                    $jml=$akhir->diff($awal)->format("%a")+1;
                    echo "$jml hari" ?></td>
                    <td><?php 

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

                 ?></td>
                    <td><?php echo $value['team'] ?></td>
                    <td><?php echo $value['pc'] ?></td>
                    <td><?php echo $value['tempat'] ?></td>
                    <td><?php 
					$total = $value['nilai'];
					echo "Rp. ". number_format($total, 0, ".", ".")."";
					?></td>
                    <td>  <p><span class="badge badge-<?php
            if($value['status2']=="Tidak Ada Progress"){
              echo "danger";
            }elseif ($value['status2']=="Belum Selesai"){
              echo "warning";
              }else{
                echo "primary";
              }
            ?>"><?php echo $value['status2'] ?></span></p></td>
                    
					<td>
						<a href="editproyek.php?no_kontrak=<?php echo $value ['no_kontrak'] ?>" title="Edit"class="btn btn-default btn-xs btn-icon icon-left">
							<i class="fa fa-pencil"></i>

						</a>
            <a href="lihat-detail.php?no_kontrak=<?php echo $value ['no_kontrak'] ?>" title="Lihat" class="btn btn-warning btn-xs btn-icon icon-left">
							<i class="fa fa-eye"></i>
						</a>
						<a href="hapus-proyek.php?no_kontrak=<?php echo $value['no_kontrak']?>" onclick="return hapus()" title="Hapus"class="btn btn-danger btn-xs btn-icon icon-left">
							<i class="fa fa-trash"></i>

						</a>
						<a href="add-progress.php?no_kontrak=<?php echo $value['no_kontrak']?>" title="Tambah Proyek" class="btn btn-primary btn-xs btn-icon icon-left">
							<i class="fa fa-plus"></i>
              Progress
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



                        <a href="add-proyek.php" class="btn btn-primary"> Tambah </a>


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
