<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}

    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM user where keterangan='Himpunan'");
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

    <title>Data User</title>

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

move_uploaded_file($_FILES["image"]["tmp_name"],"../images/" . $_FILES["image"]["name"]);
$location=$_FILES["image"]["name"];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$md5 = md5($password);
$nama=$_REQUEST['nama'];
$program_studi = $_REQUEST['program_studi'];




   
$insert = "SELECT nama from user where nama='$nama' and keterangan='Himpunan'";
$rule = $db->prepare($insert);
$rule->setFetchMode(PDO::FETCH_OBJ);
$rule->execute();

$insert = "SELECT program_studi from user where program_studi='$program_studi' and keterangan='Himpunan'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();
        
//Row will return false if there was no value
        if ($rule->rowCount() == 0 && $stmti->rowCount() == 0) {
            //insert new data
            $insert = "insert into user values(' ','$nama', '$program_studi',' ','$username','$md5','Tidak Ada','$location','Himpunan');
insert into himpunan values(' ','$nama', '$location','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','Belum Diisi','$username')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();


  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Himpunan Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=userhimpunan.php">';
        } elseif($rule->rowCount() > 0) {
           echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Gagal!","Nama himpunan telah ada!","warning");})</script>';
echo '<meta http-equiv="Refresh" content="2; URL=userhimpunan.php">';
        } else {
            echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Gagal!","Tidak boleh lebih dari 1 himpunan pada program studi yang sama!","error");})</script>';
echo '<meta http-equiv="Refresh" content="2; URL=userhimpunan.php">';
        }

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
                    <h2>Data User <strong>Himpunan</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Data Master</a>
                        </li>
                        <li class="active">
                            <strong>Himpunan</strong>
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
                    
                    <td><img width="100"  src="../images/<?php echo $value['image']; ?>" /></td>


					<td>
						<a href="edithimpunan.php?id=<?php echo $value ['id'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="fa fa-pencil"></i>
							Edit
						</a>


						<a href="hapus-himpunan.php?id=<?php echo $value['id']?>&username=<?php echo $value['username']; ?>" onclick="return hapus()" class="btn btn-danger btn-sm btn-icon icon-left">
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
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus" href="#modal-form">Tambah Himpunan</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
													<h3 class="m-t-none m-b">Tambah Himpunan</h3>

                                                   <form role="form" method="post" enctype="multipart/form-data" >
                                                        <div class="form-group"><label>Nama Organisasi</label> <input type="text" name="nama" placeholder="Masukkan Nama Organisasi" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Program Studi</label>
                                                            <div class="form-group">
                                                                <select class="form-control" name="program_studi">
                                                                <option value="">--Pilih Program Studi--</option>
                                                   <?php
                                        include 'db.php';

                                        
                                        $query = $db->prepare("SELECT * from program_studi");
                                        $query->execute();
                                        $sql = $query->fetchAll();
                                        foreach ($sql as $value) {
                                        ?>

                                        <option value="<?php echo $value['program_studi'] ?>"><?php echo $value['program_studi'] ?> </option>
                                        <?php }
                                        ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label>Username</label> <input type="text" name="username" placeholder="Masukkan Username" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Password</label> <input type="password" name="password" placeholder="Password" class="form-control" required=""></div>

                                                        <div class="form-group"><label>Logo Himpunan</label>
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
