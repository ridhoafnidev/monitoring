<?php
include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}

    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM kuesioner");
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

    <title>Kelola Kuesioner</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico" />
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

$user_id = $_SESSION["id"];
$jumlah_kue = $_REQUEST['kuesioner'];
$user_id = $_SESSION["id"];

    foreach($_POST['kuesioner'] as $option_num => $option_val){
        echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }

    }

    if ($stmti->rowCount() >= 1) {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Sukses!","Data Berhasil Di Simpan!","success");})</script>';
                echo '<meta http-equiv="Refresh" content="1; URL=home.php">';
            } else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Gagal!","Data yang ingin Anda inputkan tidak berhasil!","error");})</script>';
                echo '<meta http-equiv="Refresh" content="2; URL=kuesioner.php">';
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
                    <h2>Kelola Data <strong>Kuesioner</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Kelola Kuesioner</a>
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
                                <h5>Data Kuesioner</h5>

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
                            <form name="send" method="post" action="">
                                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                            foreach ($data as $value) {
										?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $value['pertanyaan'] ?></td>
                                            <td>
                                                <input type="hidden" name="jumlah_kue" value=<?=sizeof($data)?> required />
                                                <input 
                                                type="radio"
                                                name="kuesioner[<?=$value['id_kuesioner']?>]"
                                                value="5" required/> SB &nbsp;&nbsp;
                                                <input 
                                                type="radio"
                                                name="kuesioner[<?=$value['id_kuesioner']?>]"
                                                value="4" required/> B &nbsp;&nbsp;
                                                <input 
                                                type="radio"
                                                name="kuesioner[<?=$value['id_kuesioner']?>]"
                                                value="3" required/> C &nbsp;&nbsp;
                                                <input 
                                                type="radio"
                                                name="kuesioner[<?=$value['id_kuesioner']?>]"
                                                value="2" required/> K
                                            </td>
                                        </tr>
                                        <?php $no++; } 
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
                                <input type="submit" name="send" value="SIMPAN" />
                                </form>

                                <div class="ibox-content">
                                    <div class="text-left">
                                        <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus"
                                            href="#modal-form">Tambah Kuesioner</a>
                                    </div>
                                    <!-- <div id="modal-form" class="modal fade" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3 class="m-t-none m-b">Tambah Kuesioner</h3>

                                                            <form role="form" method="post"
                                                                enctype="multipart/form-data">

                                                                <div class="form-group">
                                                                <label>Pertanyaan</label>
                                                                <input row="4" name="pertanyaan"
                                                                        placeholder="Masukkan pertanyaan"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div>
                                                                    <input 
                                                                        class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                        type="radio"
                                                                        name="kuesioner"
                                                                        value="10"/>SB
                                                                        <input 
                                                                        class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                        type="radio"
                                                                        name="kuesioner"
                                                                        value="8"/>B
                                                                        <input 
                                                                        class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                        type="radio"
                                                                        name="kuesioner"
                                                                        value="6"/>C
                                                                        <input 
                                                                        class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                                                        type="radio"
                                                                        name="kuesioner"
                                                                        value="5"/>K
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
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
    function hapus() {
        tanya = confirm("Anda Yakin Menghapus Data User Ini ?");
        if (tanya == true) return true;
        else return false;
    }
    </script>

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