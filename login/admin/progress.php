<?php
    include 'db.php';



include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}
	$no_kontrak = $_REQUEST ['no_kontrak'];

    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proyek where no_kontrak='$no_kontrak'");
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

    <title>Progress Proyek | Admin</title>

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


$insert = "insert into progress values('$no_kontrak','$no_sr','$nama_proyek','$team','$pelaksana','$waktu','$waktu_berjalan','$pc','$tempat','$bobot')";
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
                                    <th>No Kontrak</th>
                                    <th>No SR</th>
                                    <th>Nama Proyek</th>
                                    <th>Team</th>
                                    <th>Pelaksana</th>
                                    <th>Waktu</th>
                                    <th>Waktu Berjalan</th>
                                    <th>PC</th>
                                    <th>Tempat</th>
                                    <th>Bobot</th>
                                    <th width="20%">Aksi</th>

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
					<td><?php echo $value['no_sr'] ?></td>
                    <td><?php echo $value['nama_proyek'] ?></td>
                    <td><?php echo $value['team'] ?></td>
                    <td><?php echo $value['pelaksana'] ?></td>
                    <td><?php echo $value['waktu'] ?></td>
                    <td><?php echo $value['waktu_berjalan'] ?></td>
                    <td><?php echo $value['pc'] ?></td>
                    <td><?php echo $value['tempat'] ?></td>
                    <td><?php echo $value['bobot'] ?></td>
					<td>
						<a href="editproyek.php?no_kontrak=<?php echo $value ['no_kontrak'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="fa fa-pencil"></i>
							Edit
						</a>


						<a href="hapus-proyek.php?no_kontrak=<?php echo $value['no_kontrak']?>" onclick="return hapus()" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="fa fa-trash"></i>
							Delete
						</a>
						<a href="add-progress.php?no_kontrak=<?php echo $value['no_kontrak']?>" class="btn btn-primary btn-sm btn-icon icon-left">
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



                        <div class="ibox-content">
                            <div class="text-left">
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus"href="#modal-form">Tambah Proyek</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
													<h3 class="m-t-none m-b">Tambah Proyek</h3>

                                                   <form role="form" method="post" >
                                                        <div class="form-group"><label>Nomor Kontrak</label> <input type="text" name="no_kontrak" placeholder="Masukkan Nomor Kontrak" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Nomor SR</label> <input type="text" name="no_sr" placeholder="Masukkan Nomor SR" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Nama Proyek</label> <input type="text" name="nama_proyek" placeholder="Nama Proyek" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Team</label>
															<div class="form-group">
																<select class="form-control" name="team">
																<option value="">-Pilih Team-</option>
																<option value="1">Team 1</option>
																<option value="2">Team 2</option>
																<option value="3">Team 3</option>
																</select>
															</div>
														</div>
														<div class="form-group"><label>Pelaksana</label> <input type="text" name="pelaksana" placeholder="Nama Pelaksana" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Waktu</label> <input type="text" name="waktu" placeholder="Waktu" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Waktu Berjalan</label> <input type="text" name="waktu_berjalan" placeholder="Waktu Berjalan" class="form-control" required=""></div>
                                                        <div class="form-group"><label>PC</label> <input type="text" name="pc" placeholder="PC" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Tempat</label> <input type="text" name="tempat" placeholder="Nama Tempat" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Bobot</label> <input type="text" name="bobot" placeholder="Isi Bobot" class="form-control" required=""></div>

														<div>
                                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="send"><strong>Submit</strong></button>
                                                            <button class="btn btn-sm btn-warning pull-right m-t-n-xs" type="reset"><strong>Reset</strong></button>
                                                        </div>
                                                    </form>
                                                </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
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
