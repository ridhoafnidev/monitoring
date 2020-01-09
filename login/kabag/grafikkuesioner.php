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

                                <html>
                                <?php
                                
                                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5");
                                $query_per1_sb->execute();
                                $data_per1_sb = $query_per1_sb->fetchAll();

                                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4");
                                $query_per1_b->execute();
                                $data_per1_b = $query_per1_b->fetchAll();

                                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=3");
                                $query_per1_c->execute();
                                $data_per1_c = $query_per1_c->fetchAll();

                                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=2");
                                $query_per1_k->execute();
                                $data_per1_k = $query_per1_k->fetchAll();

                                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5");
                                $query_per2_sb->execute();
                                $data_per2_sb = $query_per2_sb->fetchAll();

                                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4");
                                $query_per2_b->execute();
                                $data_per2_b = $query_per2_b->fetchAll();

                                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=3");
                                $query_per2_c->execute();
                                $data_per2_c = $query_per2_c->fetchAll();

                                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=2");
                                $query_per2_k->execute();
                                $data_per2_k = $query_per2_k->fetchAll();


                                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5");
                                $query_per3_sb->execute();
                                $data_per3_sb = $query_per3_sb->fetchAll();

                                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4");
                                $query_per3_b->execute();
                                $data_per3_b = $query_per3_b->fetchAll();

                                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=3");
                                $query_per3_c->execute();
                                $data_per3_c = $query_per3_c->fetchAll();

                                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=2");
                                $query_per3_k->execute();
                                $data_per3_k = $query_per3_k->fetchAll();

                                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5");
                                $query_per4_sb->execute();
                                $data_per4_sb = $query_per4_sb->fetchAll();

                                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4");
                                $query_per4_b->execute();
                                $data_per4_b = $query_per4_b->fetchAll();

                                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=3");
                                $query_per4_c->execute();
                                $data_per4_c = $query_per4_c->fetchAll();

                                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=2");
                                $query_per4_k->execute();
                                $data_per4_k = $query_per4_k->fetchAll();

                                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5");
                                $query_per8_sb->execute();
                                $data_per8_sb = $query_per8_sb->fetchAll();

                                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4");
                                $query_per8_b->execute();
                                $data_per8_b = $query_per8_b->fetchAll();

                                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=3");
                                $query_per8_c->execute();
                                $data_per8_c = $query_per8_c->fetchAll();

                                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=2");
                                $query_per8_k->execute();
                                $data_per8_k = $query_per8_k->fetchAll();

                                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5");
                                $query_per5_sb->execute();
                                $data_per5_sb = $query_per5_sb->fetchAll();

                                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4");
                                $query_per5_b->execute();
                                $data_per5_b = $query_per5_b->fetchAll();

                                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=3");
                                $query_per5_c->execute();
                                $data_per5_c = $query_per5_c->fetchAll();

                                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=2");
                                $query_per5_k->execute();
                                $data_per5_k = $query_per5_k->fetchAll();

                                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5");
                                $query_per6_sb->execute();
                                $data_per6_sb = $query_per6_sb->fetchAll();

                                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4");
                                $query_per6_b->execute();
                                $data_per6_b = $query_per6_b->fetchAll();

                                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=3");
                                $query_per6_c->execute();
                                $data_per6_c = $query_per6_c->fetchAll();

                                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=2");
                                $query_per6_k->execute();
                                $data_per6_k = $query_per6_k->fetchAll();

                                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5");
                                $query_per7_sb->execute();
                                $data_per7_sb = $query_per7_sb->fetchAll();

                                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4");
                                $query_per7_b->execute();
                                $data_per7_b = $query_per7_b->fetchAll();

                                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=3");
                                $query_per7_c->execute();
                                $data_per7_c = $query_per7_c->fetchAll();

                                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=2");
                                $query_per7_k->execute();
                                $data_per7_k = $query_per7_k->fetchAll();
                                

                                $kue_per1_sb = sizeof($data_per1_sb);
                                $kue_per1_b = sizeof($data_per1_b);
                                $kue_per1_c = sizeof($data_per1_c);
                                $kue_per1_k = sizeof($data_per1_k);

                                $kali_per1_sb = $kue_per1_sb * 5;
                                $kali_per1_b = $kue_per1_sb * 4;
                                $kali_per1_c = $kue_per1_sb * 3;
                                $kali_per1_k = $kue_per1_sb * 2;

                                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kue_per1_c + $kue_per1_k;
                                $hasil_persen_1  = $hasil_1 / 5;

                                $kue_per2_sb = sizeof($data_per2_sb);
                                $kue_per2_b = sizeof($data_per2_b);
                                $kue_per2_c = sizeof($data_per2_c);
                                $kue_per2_k = sizeof($data_per2_k);

                                $kali_per2_sb = $kue_per2_sb * 5;
                                $kali_per2_b = $kue_per2_sb * 4;
                                $kali_per2_c = $kue_per2_sb * 3;
                                $kali_per2_k = $kue_per2_sb * 2;

                                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kue_per2_c + $kue_per2_k;
                                $hasil_persen_2  = $hasil_2 / 5;
                                //echo $hasil_2;

                                $kue_per3_sb = sizeof($data_per3_sb);
                                $kue_per3_b = sizeof($data_per3_b);
                                $kue_per3_c = sizeof($data_per3_c);
                                $kue_per3_k = sizeof($data_per3_k);

                                $kali_per3_sb = $kue_per3_sb * 5;
                                $kali_per3_b = $kue_per3_sb * 4;
                                $kali_per3_c = $kue_per3_sb * 3;
                                $kali_per3_k = $kue_per3_sb * 2;

                                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kue_per3_c + $kue_per3_k;
                                $hasil_persen_3  = $hasil_3 / 5;
                                //echo $hasil_3;

                                $kue_per4_sb = sizeof($data_per4_sb);
                                $kue_per4_b = sizeof($data_per4_b);
                                $kue_per4_c = sizeof($data_per4_c);
                                $kue_per4_k = sizeof($data_per4_k);

                                $kali_per4_sb = $kue_per4_sb * 5;
                                $kali_per4_b = $kue_per4_sb * 4;
                                $kali_per4_c = $kue_per4_sb * 3;
                                $kali_per4_k = $kue_per4_sb * 2;

                                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kue_per4_c + $kue_per4_k;
                                $hasil_persen_4  = $hasil_4 / 5;
                                //echo $hasil_4;

                                $kue_per5_sb = sizeof($data_per5_sb);
                                $kue_per5_b = sizeof($data_per5_b);
                                $kue_per5_c = sizeof($data_per5_c);
                                $kue_per5_k = sizeof($data_per5_k);

                                $kali_per5_sb = $kue_per5_sb * 5;
                                $kali_per5_b = $kue_per5_sb * 4;
                                $kali_per5_c = $kue_per5_sb * 3;
                                $kali_per5_k = $kue_per5_sb * 2;

                                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kue_per5_c + $kue_per5_k;
                                $hasil_persen_5  = $hasil_5 / 5;
                                // echo $kali_per5_c;

                                $kue_per6_sb = sizeof($data_per6_sb);
                                $kue_per6_b = sizeof($data_per6_b);
                                $kue_per6_c = sizeof($data_per6_c);
                                $kue_per6_k = sizeof($data_per6_k);

                                $kali_per6_sb = $kue_per6_sb * 5;
                                $kali_per6_b = $kue_per6_sb * 4;
                                $kali_per6_c = $kue_per6_sb * 3;
                                $kali_per6_k = $kue_per6_sb * 2;

                                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kue_per6_c + $kue_per6_k;
                                $hasil_persen_6  = $hasil_6 / 5;
                                //echo $hasil_6;

                                $kue_per7_sb = sizeof($data_per7_sb);
                                $kue_per7_b = sizeof($data_per7_b);
                                $kue_per7_c = sizeof($data_per7_c);
                                $kue_per7_k = sizeof($data_per7_k);

                                $kali_per7_sb = $kue_per7_sb * 5;
                                $kali_per7_b = $kue_per7_sb * 4;
                                $kali_per7_c = $kue_per7_sb * 3;
                                $kali_per7_k = $kue_per7_sb * 2;

                                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kue_per7_c + $kue_per7_k;
                                $hasil_persen_7  = $hasil_7 / 5;
                                //echo $hasil_7;

                                $kue_per8_sb = sizeof($data_per8_sb);
                                $kue_per8_b = sizeof($data_per8_b);
                                $kue_per8_c = sizeof($data_per8_c);
                                $kue_per8_k = sizeof($data_per8_k);

                                $kali_per8_sb = $kue_per8_sb * 5;
                                $kali_per8_b = $kue_per8_sb * 4;
                                $kali_per8_c = $kue_per8_sb * 3;
                                $kali_per8_k = $kue_per8_sb * 2;

                                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kue_per8_c + $kue_per8_k;
                                $hasil_persen_8  = $hasil_8 / 5;
                                echo $hasil_persen_3;

                                ?>

                                </html>


                                <html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Pertanyaan', 'Sangat Baik (SB)', 'Baik (B)', 'Cukup (C)', 'Kurang (K)', 'Persentase'],
                ['Pertama', <?php echo ($kue_per1_sb == 0) ? 0.1 : $kue_per1_sb; ?>,<?= ($kue_per1_b == 0) ? 0.1 : $kue_per1_b ?>, <?= ($kue_per1_c == 0) ? 0.1 : $kue_per1_c ?>, <?= ($kue_per1_k == 0) ? 0.1 : $kue_per1_k ?>, <?= ($hasil_persen_1 == 0) ? 0.1 : $hasil_persen_1 ?>],
                ['Kedua', <?php echo ($kue_per2_sb == 0) ? 0.1 : $kue_per2_sb; ?>, <?= ($kue_per2_b == 0) ? 0.1 : $kue_per2_b ?>, <?= ($kue_per2_c == 0) ? 0.1 : $kue_per2_c ?>, <?= ($kue_per2_k == 0) ? 0.1 : $kue_per2_k ?>,  <?= ($hasil_persen_2 == 0) ? 0.1 : $hasil_persen_2 ?>],
                ['Ketiga', <?php echo ($kue_per3_sb == 0) ? 0.1 : $kue_per3_sb; ?>,<?= ($kue_per3_b == 0) ? 0.1 : $kue_per3_b ?>, <?= ($kue_per3_c == 0) ? 0.1 : $kue_per3_c ?>, <?= ($kue_per3_k == 0) ? 0.1 : $kue_per3_k ?>,  <?= ($hasil_persen_3 == 0) ? 0.1 : $hasil_persen_3 ?>],
                ['Keempat', <?php echo ($kue_per4_sb == 0) ? 0.1 : $kue_per4_sb; ?>,<?= ($kue_per4_b == 0) ? 0.1 : $kue_per4_b ?>, <?= ($kue_per4_c == 0) ? 0.1 : $kue_per4_c ?>, <?= ($kue_per4_k == 0) ? 0.1 : $kue_per4_k ?>,  <?= ($hasil_persen_4 == 0) ? 0.1 : $hasil_persen_4 ?>],
                ['Kelima', <?php echo ($kue_per8_sb == 0) ? 0.1 : $kue_per8_sb;; ?>, <?= ($kue_per8_b == 0) ? 0.1 : $kue_per8_b ?>, <?= ($kue_per8_c == 0) ? 0.1 : $kue_per8_c ?>, <?= ($kue_per8_k == 0) ? 0.1 : $kue_per8_k ?>,  <?= ($hasil_persen_8 == 0) ? 0.1 : $hasil_persen_8 ?>],
                ['Keenam', <?php echo ($kue_per5_sb == 0) ? 0.1 : $kue_per5_sb; ?>, <?= ($kue_per5_b == 0) ? 0.1 : $kue_per5_b ?>, <?= ($kue_per5_c == 0) ? 0.1 : $kue_per5_c ?>, <?= ($kue_per5_k == 0) ? 0.1 : $kue_per5_k ?>,  <?= ($hasil_persen_5 == 0) ? 0.1 : $hasil_persen_5 ?>],
                ['Ketujuh', <?php echo ($kue_per6_sb == 0) ? 0.1 : $kue_per6_sb; ?>, <?= ($kue_per6_b == 0) ? 0.1 : $kue_per6_b ?>, <?= ($kue_per6_c == 0) ? 0.1 : $kue_per6_c ?>, <?= ($kue_per6_k == 0) ? 0.1 : $kue_per6_k ?>,  <?= ($hasil_persen_6 == 0) ? 0.1 : $hasil_persen_6 ?>],
                ['Kedelapan', <?php echo ($kue_per7_sb == 0) ? 0.1 : $kue_per7_sb; ?>, <?= ($kue_per7_b == 0) ? 0.1 : $kue_per7_b ?>, <?= ($kue_per7_c == 0) ? 0.1 : $kue_per7_c ?>, <?= ($kue_per7_k == 0) ? 0.1 : $kue_per7_k ?>,  <?= ($hasil_persen_7 == 0) ? 0.1 : $hasil_persen_7 ?>]
            ]);

            var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script>
    </head>
    <body>
        <div id="columnchart_material" style="width: 1100px; height: 500px;"></div>
    </body>
    </html>



                            </div>
                            <div class="ibox-content">
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