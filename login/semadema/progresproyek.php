<?php
    include 'db.php';



include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM progress");
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

    <title>Data Progress Proyek</title>

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
$no_sr=$_REQUEST['no_sr'];
$nama_proyek=$_REQUEST['nama_proyek'];
$team=$_REQUEST['team'];
$pelaksana=$_REQUEST['pelaksana'];
$waktu=$_REQUEST['waktu'];
$waktu_berjalan=$_REQUEST['waktu_berjalan'];
$pc=$_REQUEST['pc'];
$tempat=$_REQUEST['tempat'];
$bobot=$_REQUEST['bobot'];


$insert = "insert into proyek values('$no_kontrak','$no_sr','$nama_proyek','$team','$pelaksana','$waktu','$waktu_berjalan','$pc','$tempat','$bobot')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Proyek Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=dataproyek.php">';
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
                            <strong>Progress Proyek</strong>
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
                                   placeholder="Pencarian...">

                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>

                                    <th>No Kontrak</th>
                                    <th>Minggu Ke</th>
                                    <th>Uraian Pekerjaan</th>
                                    <th>Bobot</th>
                                    <th>Tahap Penyelesaian</th>
                                    <th>Tahap Keseluruhan</th>

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
					<td><?php echo $value['no_kontrak'] ?></td>
          	<td><?php echo $value['minggu_ke'] ?></td>
					<td><?php echo $value['uraian_pekerjaan'] ?></td>
                    <td><?php echo $value['bobot'] ?></td>
                    <td><?php echo $value['tahap_satu'] ?></td>
                    <td><?php echo $value['tahap_semua'] ?></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['keterangan'];
                    if($a=="Delay <10%"){
                        echo "danger";
                    }elseif($a=="Delay >10%"){
                        echo "warning";
                        }
                        elseif($a=="In Progress"){
                            echo "primary";
                        }
                    ?>"><?php echo $value['keterangan'] ?></span></p></td>

					<td>
						<a href="edit-progress.php?id_detail=<?php echo $value ['id_detail'] ?>" title="Edit" class="btn btn-default btn-xs btn-icon icon-left">
							<i class="fa fa-pencil"></i>

						</a>


						<a href="hapus-progress.php?id_detail=<?php echo $value['id_detail']?>" onclick="return hapus()" title="Hapus"class="btn btn-danger btn-xs btn-icon icon-left">
							<i class="fa fa-trash"></i>

						</a>
						<a href="lihat-detail.php?no_kontrak=<?php echo $value['no_kontrak']?>" title="Lihat Rincian"class="btn btn-primary btn-xs btn-icon icon-left">
							<i class="fa fa-eye"></i>

						</a>
            <a href="cetak.php?no_kontrak=<?php echo $value['no_kontrak']?>" title="Cetak"class="btn btn-warning btn-xs btn-icon icon-left">
              <i class="fa fa-print"></i>

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
