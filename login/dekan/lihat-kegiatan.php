<?php
    include 'db.php';



include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    $id_detail=$_REQUEST['id_detail'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM progress,kegiatan where progress.id_detail=kegiatan.id_detail and progress.id_detail='$id_detail'");
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
<?php
include 'db.php';

if(isset($_POST['send'])){

$nama_kegiatan=$_REQUEST['nama_kegiatan'];
$id_detail=$_REQUEST['id_detail'];
$status=$_REQUEST['status'];


$insert = "insert into kegiatan values(' ','$id_detail','$nama_kegiatan','$status')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Kegiatan Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=lihat-kegiatan.php?id_detail='.$id_detail.'">';
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
                    <h2>Data Kegiatan Proyek</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Proyek</a>
                        </li>
                        <li class="active">
                            <strong>Kegiatan Proyek</strong>
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
                            <h5>Data Kegiatan</h5>

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

                            <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th width="50%">Bobot</th>
                                    <th>Status Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $value['kegiatan'] ?></td>
                    
                    <td><div class="progress progress-striped active">
                                <div style="width: <?php echo $value['status'] ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $value['status'] ?>" role="progressbar" class="progress-bar progress-bar-<?php
            if($value['status']<10){
              echo "danger";
            }elseif ($value['status']<100){
              echo "warning";
              }elseif ($value['status']==100){
                echo "primary";
              }
            ?>">
                                <?php echo $value['status'] ?>%</div></td>
                    <td>  <p><button class="btn btn-<?php
            if($value['status']<10){
              echo "danger";
            }elseif ($value['status']<100){
              echo "warning";
              }elseif ($value['status']==100){
                echo "primary";
              }
            ?> btn-circle" type="button"><i class="fa fa-<?php
            if($value['status']<10){
              echo "exclamation";
            }elseif ($value['status']<100){
              echo "clock-o";
              }elseif ($value['status']==100){
                echo "check";
              }
            ?>"></i>
                            </button></p></td>
                    
                    
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


<?php
    include 'db.php';


    $id_detail=$_REQUEST['id_detail'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM progress,proyek where progress.no_kontrak=proyek.no_kontrak and progress.id_detail='$id_detail'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data2 = $query->fetchAll();
?>
                       <div class="ibox-content">
                            <div class="text-left">
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus"href="#modal-form">Tambah Kegiatan</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="m-t-none m-b">Tambah Kegiatan</h3>


<?php $no = 0;
                foreach ($data2 as $value) {
                    $no++;
                                             ?>
                                                   <form role="form" method="post" >
                                                    <input type="hidden" name="id_detail" value="<?php echo $value['id_detail']; ?>">
                                                    <div class="form-group"><label>Nomor Kontrak</label> <input type="text" name="no_kontrak" value="<?php echo $value['no_kontrak']; ?>" class="form-control" required="" readonly></div>
                                                    <div class="form-group"><label>Nama Proyek</label> <input type="text" name="nama_proyek" value="<?php echo $value['nama_proyek']; ?>" class="form-control" required="" readonly></div>
                                                        <div class="form-group"><label>Nama Kegiatan</label> <input type="text" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Bobot</label> <input type="number" name="status" placeholder="Masukkan Progress Kegiatan" class="form-control" required=""></div>
                                                        
                                                        
                                                        <div>
                                                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="send"><strong>Submit</strong></button>
                                                            <button class="btn btn-sm btn-warning pull-right m-t-n-xs" type="reset"><strong>Reset</strong></button>
                                                        </div>
                                                    </form>
                                                <?php } ?>
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
