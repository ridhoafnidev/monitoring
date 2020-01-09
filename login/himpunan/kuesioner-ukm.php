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

    $query = $db->prepare("SELECT * FROM masa_jabatan where status='aktif'");
    $query->execute();
    $masa_jabatan = "";
    $data_mj = $query->fetchAll();
    foreach($data_mj as $data_m){
        $masa_jabatan = $data_m['tgl_akhir_priode'];
    }
    $tahun_ex = explode("-", $masa_jabatan);
    $tahun = $tahun_ex['0'];
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
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>
<?php

    include 'db.php';

    if(isset($_POST['send'])){

    $username = $_SESSION["username"];
    $workshop = $_REQUEST['nama_workshop'];
    $nama_workshop = $_REQUEST['workshop'];
    $seminar = $_REQUEST['seminar'];
    $nama_seminar = $_REQUEST['nama_seminar'];
    $pelatihan = $_REQUEST['pelatihan'];
    $nama_pelatihan = $_REQUEST['nama_pelatihan'];
    $kti = $_REQUEST['kti'];
    $nama_kti = $_REQUEST['nama_kti'];
    $lomba = $_REQUEST['lomba'];
    $nama_lomba = $_REQUEST['nama_lomba'];
    $masyarakat = $_REQUEST['masyarakat'];
    $nama_masyarakat = $_REQUEST['nama_masyarakat'];

    $insert = "insert into kuesioner_ukm values(' ','$username', '$workshop', '$nama_workshop', '$seminar', '$nama_seminar', '$pelatihan', '$nama_pelatihan', '$kti', '$nama_kti', '$lomba', '$nama_lomba', '$masyarakat', '$nama_masyarakat', '$tahun' )";
    $stmti = $db->prepare($insert);
    $stmti->setFetchMode(PDO::FETCH_OBJ);   
    $stmti->execute();  

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
                        <h5>Kuesioner <small>Perspektif pertumbuhan dan pembelajaran</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                                <p>Perspektif pertumbuhan dan pembelajaran.</p>
                                <form name="send" method="post" action="">
                                    <div class="form-group"><label>1. Berapa banyak tahun ini melaksanakan/mengikuti kegiatan yang berhubungan dengan pendidikan?</label><br>
                                    <table style="width:100%">
                                        <tr>
                                            <td width="15%">A. Workshop</td>
                                            <td  width="10%"><input type="number" name="workshop" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_workshop" placeholder="Nama Kegiatan" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td width="15%">B. Seminar</td>
                                            <td  width="10%"><input type="number" name="seminar" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_seminar" placeholder="Nama Seminar" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td width="15%">B. Pelatihan</td>
                                            <td  width="10%"><input type="number" name="pelatihan" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_pelatihan" placeholder="Nama Pelatihan" class="form-control"></td>
                                        </tr>
                                    </table> 
                                    <br>
                                    <div class="form-group"><label>2. Berapa banyak tahun ini melaksanakan/mengikuti kegiatan yang berhubungan dengan penelitian?</label><br>
                                    <table style="width:100%">
                                        <tr>
                                            <td width="15%">A. Karya tulis ilmiah</td>
                                            <td  width="10%"><input type="number" name="kti" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_kti" placeholder="Nama karya tulis ilmiah" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td width="15%">B. Lomba</td>
                                            <td  width="10%"><input type="number" name="lomba" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_lomba" placeholder="Nama lomba" class="form-control"></td>
                                        </tr>
                                    </table> 
                                    <br>
                                    <div class="form-group"><label>3. Berapa banyak tahun ini melaksanakan/mengikuti kegiatan yang berhubungan dengan pengabdian masyarakat?</label><br>
                                    <table style="width:100%">
                                        <tr>
                                            <td width="15%"></td>
                                            <td  width="10%"><input type="number" name="masyarakat" placeholder="Jumlah" class="form-control" style="width: 100px"></td>
                                            <td><input type="text" name="nama_masyarakat" placeholder="Nama Seminar" class="form-control"></td>
                                        </tr>
                                    </table> 
                                    </div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" name="send" type="submit"><strong>Simpan</strong></button>
                                    </div>
                                </form>
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
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FooTable -->
    <script src="../js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="../js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="../js/plugins/validate/jquery.validate.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });
    </script>

    <script>
    $(document).ready(function() {
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function(event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function(event, currentIndex) {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });
    </script>

</body>

</html>