<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}

    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM user where keterangan='Sema & Dema'");
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

    <title>Kelola User Sema & Dema</title>

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

if(isset($_POST['send'])){

move_uploaded_file($_FILES["image"]["tmp_name"],"../images/" . $_FILES["image"]["name"]);
$location=$_FILES["image"]["name"];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$md5 = md5($password);
$nama=$_REQUEST['nama'];
$program_studi = $_REQUEST['program_studi'];


$insert = "insert into user values(' ','$nama', '$program_studi','$username','$md5','Tidak Ada','$location','Sema & Dema')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Sema Dema Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=usersemadema.php">';
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
                    <h2>Data User <strong>Sema & Dema</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Data Master</a>
                        </li>
                        <li class="active">
                            <strong>Sema & Dema</strong>
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
                            <h5>Data Himpunan</h5>

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
                                    <th>Nama Organisasi</th>
                                    <th>Program Studi</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Login Terakhir</th>
                                    <th>Logo Organisasi</th>
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
                    <td><?php echo $value['nama'] ?></td>
                    <td><?php echo $value['program_studi'] ?></td>
					<td><?php echo $value['username'] ?></td>
					<td><?php echo $value['password'] ?></td>
                    <td><?php if ($value['login_terakhir']=="0000-00-00 00:00:00"){
                        echo "Tidak Ada";
                        }else{
                            echo $value['login_terakhir'];
                            }  ?></td>
                    <td><img width="100"  src="../images/<?php echo $value['image']; ?>" /></td>


					<td>
						<a href="edithimpunan.php?id=<?php echo $value ['id'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="fa fa-pencil"></i>
							Edit
						</a>


						<a href="hapus-himpunan.php?id=<?php echo $value['id']?>" onclick="return hapus()" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="fa fa-trash"></i>
							Delete
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
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus" href="#modal-form">Tambah Sema & Dema</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
													<h3 class="m-t-none m-b">Tambah Sema & Dema</h3>

                                                   <form role="form" method="post" enctype="multipart/form-data" >
                                                        <div class="form-group"><label>Nama Organisasi</label> <input type="text" name="nama" placeholder="Masukkan Nama Organisasi" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Program Studi</label> <input type="text" name="program_studi" placeholder="Masukkan Program Studi" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Username</label> <input type="text" name="username" placeholder="Masukkan Username" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Password</label> <input type="password" name="password" placeholder="Password" class="form-control" required=""></div>

                                                        <div class="form-group"><label>Logo Sema Dema</label>
                                                         <input type="file" name="image" class="form-control" required></div>
                                                      
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
 tanya = confirm("Anda Yakin Menghapus Data User Ini ?");
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
