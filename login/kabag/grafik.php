<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Home</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico" />
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include 'menu.php';

		?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php include 'header.php';
		?>
            <div class="row  border-bottom white-bg dashboard-header">

                <div class="col-lg-12-6">
                    <h2>Selamat Datang, <strong><?php echo $value['nama'] ?>!</strong></h2>
                    <h3>di Sistem Informasi Monitoring Unit Kegiatan Mahasiswa Fakultas Sains & Teknologi UIN SUSKA Riau
                    </h3>
                </div>

            </div>
            <br>

            <div class="row">
                <?php 
                $tanggal = date('Y-m-d H:i:s', (time() + 18000));
                $tahun = date('Y', strtotime($tanggal));
                $query = $db->prepare("SELECT sum(total_anggaran) as total_himpunan FROM anggaran where keterangan='Himpunan' and tahun_anggaran='$tahun'");
                $query->execute();
                $data = $query->fetchAll();
                ?>

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Grafik</h5>
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
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Grafik Anggaran #1</a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <body>  
                                                    <!-- Menampilkan dalam bentuk chart dengan ukuran yang telah disesuaikan -->
                                                    <div id="tampil_chart"></div>
                                                </body>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Grafik Program Kerja #2</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                            <body>
                                                <!-- Menampilkan dalam bentuk chart dengan ukuran yang telah disesuaikan -->
                                                <div id="chart_proker"></div>
                                            </body>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Grafik Kuesioner #3</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                            <body>
                                                <div id="columnchart_material"></div>
                                            </body>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Grafik Kuesioner #4</a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                            <body>
                                                <div id="columnchart_values"></div>
                                            </body>
                                            
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-6">
                    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <!-- Mengembed Jquery -->
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                    <script type="text/javascript">
                        // Meload paket API dari Google Chart
                        google.load('visualization', '1', {'packages':['bar']});
                        // Membuat Callback yang meload API visualisasi Google Chart
                        google.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var json = $.ajax({
                                    url: 'json.php', // file json hasil query database
                                    dataType: 'json',
                                    async: false
                                }).responseText;
                                
                                // Mengambil nilai JSON
                                var data = new google.visualization.DataTable(json);
                                var options = {
                                    chart: {
                                        title: 'Grafik Anggaran',
                                        subtitle: 'Tahun: <?= $tahun ?>',
                                    },
                                    bars: 'vertical',
                                    vAxis: {format: 'decimal'},
                                    height: 300,
                                    width: 950,
                                    colors: ['#1b9e77', '#d95f02', '#7570b3']
                                };
                                // API Chart yang akan menampilkan ke dalam div id
                                var chart = new google.charts.Bar(document.getElementById('tampil_chart'));
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>  
                </head>
                </div>
             
                <div class="col-lg-6">

                        <!-- Meng-embed Google API -->
                        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                        <!-- Mengembed Jquery -->
                        <script type="text/javascript"
                            src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

                        <script type="text/javascript">
                        // Meload paket API dari Google Chart
                        google.load('visualization', '1', {
                            'packages': ['bar']
                        });
                        // Membuat Callback yang meload API visualisasi Google Chart
                        google.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var jsons = $.ajax({
                                url: 'jsonproker.php', // file json hasil query database
                                dataType: 'json',
                                async: false
                            }).responseText;

                            // Mengambil nilai JSON
                            var datas = new google.visualization.DataTable(jsons);
                            var optionss = {
                                chart: {
                                    title: 'Grafik Program Kerja',
                                    subtitle: 'Tahun: <?= $tahun ?>',
                                },
                                bars: 'vertical',
                                vAxis: {
                                    format: 'decimal'
                                },
                                height: 350,
                                width: 950,
                                colors: ['#1b9e77', '#d95f02', '#7570b3']
                            };
                            // API Chart yang akan menampilkan ke dalam div id
                            var charts = new google.charts.Bar(document.getElementById('chart_proker'));
                            charts.draw(datas, google.charts.Bar.convertOptions(optionss));
                        }
                        </script>
                        </head>
                    </div>
            </div>

            <!-- Coding dataset grafik kuesioner -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='himasi' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='himasi' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='himasi' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='himasi' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='himasi' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='himasi' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='himasi' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='himasi' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='himasi' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='himasi' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='himasi' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='himasi' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='himasi' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='himasi' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='himasi' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='himasi' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='himasi' and tahun = '$tahun'");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='himasi' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='himasi' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='himasi' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='himasi' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='himasi' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_himasi = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <!-- Himatif -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='himatif' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='himatif' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='himatif' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='himatif' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='himatif' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='himatif' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='himatif' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='himatif' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='himatif' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='himatif' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='himatif' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='himatif' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='himatif' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='himatif' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='himatif' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='himatif' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='himatif' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='himatif' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='himatif' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='himatif' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='himatif' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='himatif' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_himatif = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <!-- Himate -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='himate' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='himate' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='himate' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='himate' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='himate' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='himate' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='himate' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='himate' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='himate' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='himate' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='himate' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='himate' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='himate' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='himate' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='himate' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='himate' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='himate' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='himate' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='himate' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='himate' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='himate' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_himate = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <!-- Hmjmt -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='hmjmt' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='hmjmt' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='hmjmt' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='hmjmt' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='hmjmt' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='hmjmt' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='hmjmt' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='hmjmt' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='hmjmt' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='hmjmt' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='hmjmt' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='hmjmt' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='hmjmt' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='hmjmt' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='hmjmt' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='hmjmt' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='hmjmt' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='hmjmt' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='hmjmt' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='hmjmt' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='hmjmt' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='hmjmt' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_hmjmt = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <!-- Hmjti -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='hmjti' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='hmjti' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='hmjti' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='hmjti' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='hmjti' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='hmjti' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='hmjti' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='hmjti' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='hmjti' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='hmjti' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='hmjti' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='hmjti' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='hmjti' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='hmjti' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='hmjti' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='hmjti' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='hmjti' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='himate' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='hmjti' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='hmjti' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='hmjti' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='hmjti' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='hmjti' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='hmjti' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='hmjti' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='hmjti' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='hmjti' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_hmjti = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <!-- Sema -->
            <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='sema' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='sema' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='sema' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='sema' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='sema' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='sema' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='sema' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='sema' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='sema' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='sema' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='sema' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='sema' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='sema' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='sema' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='sema' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='sema' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='sema' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='sema' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='sema' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='sema' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='sema' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='sema' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_sema = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

             <!-- Dema -->
             <?php               
                $query_per1_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and SB=5 and user='dema' and tahun = '$tahun' " );
                $query_per1_sb->execute();
                $data_per1_sb = $query_per1_sb->fetchAll();
            
                $query_per1_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per1_b->execute();
                $data_per1_b = $query_per1_b->fetchAll();
            
                $query_per1_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per1_c->execute();
                $data_per1_c = $query_per1_c->fetchAll();
            
                $query_per1_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=5 and K=2 and user='dema' and tahun = '$tahun' ");
                $query_per1_k->execute();
                $data_per1_k = $query_per1_k->fetchAll();
            
                $query_per2_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and SB=5 and user='dema' and tahun = '$tahun' ");
                $query_per2_sb->execute();
                $data_per2_sb = $query_per2_sb->fetchAll();
            
                $query_per2_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per2_b->execute();
                $data_per2_b = $query_per2_b->fetchAll();
            
                $query_per2_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per2_c->execute();
                $data_per2_c = $query_per2_c->fetchAll();
            
                $query_per2_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=6 and K=2 and user='dema' and tahun = '$tahun' ");
                $query_per2_k->execute();
                $data_per2_k = $query_per2_k->fetchAll();
            
                $query_per3_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and SB=5 and user='dema' and tahun = '$tahun' ");
                $query_per3_sb->execute();
                $data_per3_sb = $query_per3_sb->fetchAll();
            
                $query_per3_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per3_b->execute();
                $data_per3_b = $query_per3_b->fetchAll();
            
                $query_per3_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per3_c->execute();
                $data_per3_c = $query_per3_c->fetchAll();
            
                $query_per3_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=7 and K=2 and user='dema' and tahun = '$tahun' ");
                $query_per3_k->execute();
                $data_per3_k = $query_per3_k->fetchAll();
            
                $query_per4_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and SB=5 and user='dema' and tahun = '$tahun' ");
                $query_per4_sb->execute();
                $data_per4_sb = $query_per4_sb->fetchAll();
            
                $query_per4_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per4_b->execute();
                $data_per4_b = $query_per4_b->fetchAll();
            
                $query_per4_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per4_c->execute();
                $data_per4_c = $query_per4_c->fetchAll();
            
                $query_per4_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=8 and K=2 and user='dema' and tahun = '$tahun' ");
                $query_per4_k->execute();
                $data_per4_k = $query_per4_k->fetchAll();
            
                $query_per8_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and SB=5 and user='dema' and tahun = '$tahun' ");
                $query_per8_sb->execute();
                $data_per8_sb = $query_per8_sb->fetchAll();
            
                $query_per8_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per8_b->execute();
                $data_per8_b = $query_per8_b->fetchAll();
            
                $query_per8_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per8_c->execute();
                $data_per8_c = $query_per8_c->fetchAll();
            
                $query_per8_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=9 and K=2 and user='dema' and tahun = '$tahun' ");
                $query_per8_k->execute();
                $data_per8_k = $query_per8_k->fetchAll();
            
                $query_per5_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and SB=5 and user='dema' and tahun = '$tahun' ");
                $query_per5_sb->execute();
                $data_per5_sb = $query_per5_sb->fetchAll();
            
                $query_per5_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and B=4 and user='dema' and tahun = '$tahun' ");
                $query_per5_b->execute();
                $data_per5_b = $query_per5_b->fetchAll();
            
                $query_per5_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and C=3 and user='dema' and tahun = '$tahun' ");
                $query_per5_c->execute();
                $data_per5_c = $query_per5_c->fetchAll();
            
                $query_per5_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=10 and K=2  and user='dema' and tahun = '$tahun' ");
                $query_per5_k->execute();
                $data_per5_k = $query_per5_k->fetchAll();
            
                $query_per6_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and SB=5  and user='dema' and tahun = '$tahun' ");
                $query_per6_sb->execute();
                $data_per6_sb = $query_per6_sb->fetchAll();
            
                $query_per6_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and B=4  and user='dema' and tahun = '$tahun' ");
                $query_per6_b->execute();
                $data_per6_b = $query_per6_b->fetchAll();
            
                $query_per6_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and C=3  and user='dema' and tahun = '$tahun' ");
                $query_per6_c->execute();
                $data_per6_c = $query_per6_c->fetchAll();
            
                $query_per6_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=11 and K=2  and user='dema' and tahun = '$tahun' ");
                $query_per6_k->execute();
                $data_per6_k = $query_per6_k->fetchAll();
            
                $query_per7_sb = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and SB=5  and user='dema' and tahun = '$tahun' ");
                $query_per7_sb->execute();
                $data_per7_sb = $query_per7_sb->fetchAll();
            
                $query_per7_b = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and B=4  and user='dema' and tahun = '$tahun' ");
                $query_per7_b->execute();
                $data_per7_b = $query_per7_b->fetchAll();
            
                $query_per7_c = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and C=3  and user='dema' and tahun = '$tahun' ");
                $query_per7_c->execute();
                $data_per7_c = $query_per7_c->fetchAll();
            
                $query_per7_k = $db->prepare("SELECT * FROM kuesioner_detail where kuesioner_id=12 and K=2  and user='sema' and tahun = '$tahun' ");
                $query_per7_k->execute();
                $data_per7_k = $query_per7_k->fetchAll();
                
            
                $kue_per1_sb = sizeof($data_per1_sb);
                $kue_per1_b = sizeof($data_per1_b);
                $kue_per1_c = sizeof($data_per1_c);
                $kue_per1_k = sizeof($data_per1_k);

                $kali_per1_sb = $kue_per1_sb * 5;
                $kali_per1_b = $kue_per1_b * 4;
                $kali_per1_c = $kue_per1_c * 3;
                $kali_per1_k = $kue_per1_k * 2;
            
                $hasil_1 = $kali_per1_sb + $kali_per1_b + $kali_per1_c + $kali_per1_k;
                $hasil_persen_1  = $hasil_1 / 3;
                $hasils_1 =  round($hasil_persen_1, 2) / 4 * 100;
                // $hasils_1 = $hasil_persen_1 / 4 * 100;

                //echo $hasils_1;
            
                $kue_per2_sb = sizeof($data_per2_sb);
                $kue_per2_b = sizeof($data_per2_b);
                $kue_per2_c = sizeof($data_per2_c);
                $kue_per2_k = sizeof($data_per2_k);
            
                $kali_per2_sb = $kue_per2_sb * 5;
                $kali_per2_b = $kue_per2_b * 4;
                $kali_per2_c = $kue_per2_c * 3;
                $kali_per2_k = $kue_per2_k * 2;
            
                $hasil_2 = $kali_per2_sb + $kali_per2_b + $kali_per2_c + $kali_per2_k;
                $hasil_persen_2  = $hasil_2 / 3;
                $hasils_2 =  round($hasil_persen_2, 2) / 4 * 100;

                // echo  round($hasil_persen_2, 2);
            
                $kue_per3_sb = sizeof($data_per3_sb);
                $kue_per3_b = sizeof($data_per3_b);
                $kue_per3_c = sizeof($data_per3_c);
                $kue_per3_k = sizeof($data_per3_k);
            
                $kali_per3_sb = $kue_per3_sb * 5;
                $kali_per3_b = $kue_per3_b * 4;
                $kali_per3_c = $kue_per3_c * 3;
                $kali_per3_k = $kue_per3_k * 2;

                $hasil_3 = $kali_per3_sb + $kali_per3_b + $kali_per3_c + $kali_per3_k;
                $hasil_persen_3  = $hasil_3 / 3;
                $hasils_3 = round($hasil_persen_3, 2) / 4 * 100;

                // echo  $hasils_3;
            
                $kue_per4_sb = sizeof($data_per4_sb);
                $kue_per4_b = sizeof($data_per4_b);
                $kue_per4_c = sizeof($data_per4_c);
                $kue_per4_k = sizeof($data_per4_k);
            
                $kali_per4_sb = $kue_per4_sb * 5;
                $kali_per4_b = $kue_per4_b * 4;
                $kali_per4_c = $kue_per4_c * 3;
                $kali_per4_k = $kue_per4_k * 2;
            
                $hasil_4 = $kali_per4_sb + $kali_per4_b + $kali_per4_c + $kali_per4_k;
                $hasil_persen_4  = $hasil_4 / 3;
                $hasils_4 = round($hasil_persen_4, 2) / 4 * 100;

                //echo $hasils_4;
            
                $kue_per5_sb = sizeof($data_per5_sb);
                $kue_per5_b = sizeof($data_per5_b);
                $kue_per5_c = sizeof($data_per5_c);
                $kue_per5_k = sizeof($data_per5_k);
            
                $kali_per5_sb = $kue_per5_sb * 5;
                $kali_per5_b = $kue_per5_b * 4;
                $kali_per5_c = $kue_per5_c * 3;
                $kali_per5_k = $kue_per5_k * 2;
            
                $hasil_5 = $kali_per5_sb + $kali_per5_b + $kali_per5_c + $kali_per5_k;
                $hasil_persen_5  = $hasil_5 / 3;
                $hasils_5 = round($hasil_persen_5, 2) / 4 * 100;

                // echo $hasils_5;
            
                $kue_per6_sb = sizeof($data_per6_sb);
                $kue_per6_b = sizeof($data_per6_b);
                $kue_per6_c = sizeof($data_per6_c);
                $kue_per6_k = sizeof($data_per6_k);
            
                $kali_per6_sb = $kue_per6_sb * 5;
                $kali_per6_b = $kue_per6_b * 4;
                $kali_per6_c = $kue_per6_c * 3;
                $kali_per6_k = $kue_per6_k * 2;
            
                $hasil_6 = $kali_per6_sb + $kali_per6_b + $kali_per6_c + $kali_per6_k;
                $hasil_persen_6  = round($hasil_6, 2) / 3;
                $hasils_6 = round($hasil_persen_6, 2) / 4 * 100;

                // echo $hasils_6; 
            
                $kue_per7_sb = sizeof($data_per7_sb);
                $kue_per7_b = sizeof($data_per7_b);
                $kue_per7_c = sizeof($data_per7_c);
                $kue_per7_k = sizeof($data_per7_k);
            
                $kali_per7_sb = $kue_per7_sb * 5;
                $kali_per7_b = $kue_per7_b * 4;
                $kali_per7_c = $kue_per7_c * 3;
                $kali_per7_k = $kue_per7_k * 2;
            
                $hasil_7 = $kali_per7_sb + $kali_per7_b + $kali_per7_c + $kali_per7_k;
                $hasil_persen_7  = $hasil_7 / 3;
                $hasils_7 = round($hasil_persen_7, 2) / 4 * 100;

                //echo $hasil_7;
            
                $kue_per8_sb = sizeof($data_per8_sb);
                $kue_per8_b = sizeof($data_per8_b);
                $kue_per8_c = sizeof($data_per8_c);
                $kue_per8_k = sizeof($data_per8_k);
            
                $kali_per8_sb = $kue_per8_sb * 5;
                $kali_per8_b = $kue_per8_b * 4;
                $kali_per8_c = $kue_per8_c * 3;
                $kali_per8_k = $kue_per8_k * 2;
            
                $hasil_8 = $kali_per8_sb + $kali_per8_b + $kali_per8_c + $kali_per8_k;
                $hasil_persen_8  = $hasil_8 / 3;
                $hasils_8 = round($hasil_persen_8, 2) / 4 * 100;

                $x = $hasils_1 + $hasils_2 + $hasils_3 + $hasils_4 + $hasils_5 + $hasils_6 + $hasils_7 + $hasils_8;
                $x_bagi = $x / 8 ;
                $hasil_dema = round($x_bagi, 2);

                // echo $hasils_1;

            ?>

            <?php
                // himasi
                $query_himasi = $db->prepare("SELECT * FROM kuesioner_ukm where username='himasi' and tahun='$tahun' " );
                $query_himasi->execute();
                $query_himasi = $query_himasi->fetchAll();
                $himasi_ws;
                $himasi_seminar;
                $himasi_pelatihan;
                $himasi_kti;
                $himasi_lomba;
                $himasi_pengabdian;
                foreach($query_himasi as $himasi){
                    $himasi_ws = $himasi['workshop'];
                    $himasi_seminar = $himasi['seminar'];
                    $himasi_pelatihan = $himasi['pelatihan'];
                    $himasi_kti = $himasi['karya_tulis_ilmiah'];
                    $himasi_lomba = $himasi['lomba'];
                    $himasi_pengabdian = $himasi['pengabdian_masyarakat'];
                }
                
                // himatif
                $query_himatif = $db->prepare("SELECT * FROM kuesioner_ukm where username='himatif' and tahun='$tahun' " );
                $query_himatif->execute();
                $query_himatif = $query_himatif->fetchAll();
                $himatif_ws;
                $himatif_seminar;
                $himatif_pelatihan;
                $himatif_kti;
                $himatif_lomba;
                $himatif_pengabdian;
                foreach($query_himatif as $himatif){
                    $himatif_ws = $himatif['workshop'];
                    $himatif_seminar = $himasi['seminar'];
                    $himatif_pelatihan = $himatif['pelatihan'];
                    $himatif_kti = $himatif['karya_tulis_ilmiah'];
                    $himatif_lomba = $himatif['lomba'];
                    $himatif_pengabdian = $himatif['pengabdian_masyarakat'];
                }

                 // himate
                 $query_himate = $db->prepare("SELECT * FROM kuesioner_ukm where username='himate' and tahun='$tahun' " );
                 $query_himate->execute();
                 $query_himate = $query_himate->fetchAll();
                 $himate_ws;
                 $himate_seminar;
                 $himate_pelatihan;
                 $himate_kti;
                 $himate_lomba;
                 $himate_pengabdian;
                 foreach($query_himate as $himate){
                     $himate_ws = $himate['workshop'];
                     $himate_seminar = $himate['seminar'];
                     $himate_pelatihan = $himate['pelatihan'];
                     $himate_kti = $himate['karya_tulis_ilmiah'];
                     $himate_lomba = $himate['lomba'];
                     $himate_pengabdian = $himate['pengabdian_masyarakat'];
                 }

                 // hmjmt
                 $query_hmjmt = $db->prepare("SELECT * FROM kuesioner_ukm where username='hmjmt' and tahun='$tahun' " );
                 $query_hmjmt->execute();
                 $query_hmjmt = $query_hmjmt->fetchAll();
                 $hmjmt_ws;
                 $hmjmt_seminar;
                 $hmjmt_pelatihan;
                 $hmjmt_kti;
                 $hmjmt_lomba;
                 $hmjmt_pengabdian;
                 foreach($query_hmjmt as $hmjmt){
                     $hmjmt_ws = $hmjmt['workshop'];
                     $hmjmt_seminar = $hmjmt['seminar'];
                     $hmjmt_pelatihan = $hmjmt['pelatihan'];
                     $hmjmt_kti = $hmjmt['karya_tulis_ilmiah'];
                     $hmjmt_lomba = $hmjmt['lomba'];
                     $hmjmt_pengabdian = $hmjmt['pengabdian_masyarakat'];
                 }

                  // hmjti
                  $query_hmjti = $db->prepare("SELECT * FROM kuesioner_ukm where username='hmjti' and tahun='$tahun' " );
                  $query_hmjti->execute();
                  $query_hmjti = $query_hmjti->fetchAll();
                  $hmjti_ws;
                  $hmjti_seminar;
                  $hmjti_pelatihan;
                  $hmjti_kti;
                  $hmjti_lomba;
                  $hmjti_pengabdian;
                  foreach($query_hmjti as $hmjti){
                      $hmjti_ws = $hmjti['workshop'];
                      $hmjti_seminar = $hmjti['seminar'];
                      $hmjti_pelatihan = $hmjti['pelatihan'];
                      $hmjti_kti = $hmjti['karya_tulis_ilmiah'];
                      $hmjti_lomba = $hmjti['lomba'];
                      $hmjti_pengabdian = $hmjti['pengabdian_masyarakat'];
                  }

                   // sema
                   $query_sema = $db->prepare("SELECT * FROM kuesioner_ukm where username='sema' and tahun='$tahun' " );
                   $query_sema->execute();
                   $query_sema = $query_sema->fetchAll();
                   $sema_ws;
                   $sema_seminar;
                   $sema_pelatihan;
                   $sema_kti;
                   $sema_lomba;
                   $sema_pengabdian;
                   foreach($query_sema as $sema){
                       $sema_ws = $sema['workshop'];
                       $sema_seminar = $sema['seminar'];
                       $sema_pelatihan = $sema['pelatihan'];
                       $sema_kti = $sema['karya_tulis_ilmiah'];
                       $sema_lomba = $sema['lomba'];
                       $sema_pengabdian = $sema['pengabdian_masyarakat'];
                   }

                    // dema
                    $query_dema = $db->prepare("SELECT * FROM kuesioner_ukm where username='dema' and tahun='$tahun' " );
                    $query_dema->execute();
                    $query_dema = $query_dema->fetchAll();
                    $dema_ws;
                    $dema_seminar;
                    $dema_pelatihan;
                    $dema_kti;
                    $dema_lomba;
                    $dema_pengabdian;
                    foreach($query_dema as $dema){
                        $dema_ws = $sema['workshop'];
                        $dema_seminar = $dema['seminar'];
                        $dema_pelatihan = $dema['pelatihan'];
                        $dema_kti = $dema['karya_tulis_ilmiah'];
                        $dema_lomba = $dema['lomba'];
                        $dema_pengabdian = $dema['pengabdian_masyarakat'];
                    }
            
            ?>

            <div class="row">
                <div class="col-lg-6">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChartKuesioner);

                            function drawChartKuesioner() {

                                var datar = google.visualization.arrayToDataTable([
                                    ['Kuesioner', 'Workshop', 'Seminar', 'Pelatihan', 'KTI', 'Lomba', 'Pengabdian'],
                                    ['Himasi', <?php echo ($himasi_ws == 0) ? 0.1 : $himasi_ws; ?>, <?php echo ($himasi_seminar == 0) ? 0.1 : $himasi_seminar; ?>, <?php echo ($himasi_pelatihan == 0) ? 0.1 : $himasi_pelatihan; ?>, <?php echo ($himasi_kti == 0) ? 0.1 : $himasi_kti; ?>, <?php echo ($himasi_lomba == 0) ? 0.1 : $himasi_lomba; ?>,  <?php echo ($himasi_pengabdian == 0) ? 0.1 : $himasi_pengabdian ; ?>],
                                    ['Himatif',<?php echo ($himatif_ws == 0) ? 0.1 : $himatif_ws; ?>, <?php echo ($himatif_seminar == 0) ? 0.1 : $himatif_seminar; ?>, <?php echo ($himatif_pelatihan == 0) ? 0.1 : $himatif_pelatihan; ?>, <?php echo ($himatif_kti == 0) ? 0.1 : $himatif_kti; ?>, <?php echo ($himatif_lomba == 0) ? 0.1 : $himatif_lomba; ?>,  <?php echo ($himatif_pengabdian == 0) ? 0.1 : $himatif_pengabdian ; ?>],
                                    ['Himate', <?php echo ($himate_ws == 0) ? 0.1 : $himate_ws; ?>, <?php echo ($himate_seminar == 0) ? 0.1 : $himate_seminar; ?>, <?php echo ($himate_pelatihan == 0) ? 0.1 : $himate_pelatihan; ?>, <?php echo ($himate_kti == 0) ? 0.1 : $himate_kti; ?>, <?php echo ($himate_lomba == 0) ? 0.1 : $himate_lomba; ?>,  <?php echo ($himate_pengabdian == 0) ? 0.1 : $himate_pengabdian ; ?>],
                                    ['Hmj MT ', <?php echo ($hmjmt_ws == 0) ? 0.1 : $hmjmt_ws; ?>, <?php echo ($hmjmt_seminar == 0) ? 0.1 : $hmjmt_seminar; ?>, <?php echo ($hmjmt_pelatihan == 0) ? 0.1 : $hmjmt_pelatihan; ?>, <?php echo ($hmjmt_kti == 0) ? 0.1 : $hmjmt_kti; ?>, <?php echo ($hmjmt_lomba == 0) ? 0.1 : $hmjmt_lomba; ?>,  <?php echo ($hmjti_pengabdian == 0) ? 0.1 : $hmjmt_pengabdian ; ?>],
                                    ['Hmj TI', <?php echo ($hmjti_ws == 0) ? 0.1 : $sema_ws; ?>, <?php echo ($sema_seminar == 0) ? 0.1 : $sema_seminar; ?>, <?php echo ($sema_pelatihan == 0) ? 0.1 : $sema_pelatihan; ?>, <?php echo ($sema_kti == 0) ? 0.1 : $sema_kti; ?>, <?php echo ($sema_lomba == 0) ? 0.1 : $sema_lomba; ?>,  <?php echo ($sema_pengabdian == 0) ? 0.1 : $sema_pengabdian ; ?>],
                                    ['Sema', <?php echo ($sema_ws == 0) ? 0.1 : $sema_ws; ?>, <?php echo ($sema_seminar == 0) ? 0.1 : $sema_seminar; ?>, <?php echo ($sema_pelatihan == 0) ? 0.1 : $sema_pelatihan; ?>, <?php echo ($sema_kti == 0) ? 0.1 : $sema_kti; ?>, <?php echo ($sema_lomba == 0) ? 0.1 : $sema_lomba; ?>,  <?php echo ($sema_pengabdian == 0) ? 0.1 : $sema_pengabdian ; ?>],
                                    ['Dema', <?php echo ($dema_ws == 0) ? 0.1 : $dema_ws; ?>, <?php echo ($dema_seminar == 0) ? 0.1 : $dema_seminar; ?>, <?php echo ($dema_pelatihan == 0) ? 0.1 : $dema_pelatihan; ?>, <?php echo ($dema_kti == 0) ? 0.1 : $dema_kti; ?>, <?php echo ($dema_lomba == 0) ? 0.1 : $dema_lomba; ?>,  <?php echo ($dema_pengabdian == 0) ? 0.1 : $dema_pengabdian ; ?>],
                                ]);

                                var optionss = {
                                chart: {
                                    title: 'Grafik Kuesioner Pembelajaran & Perkembangan',
                                    subtitle: 'Tahun : <?= $tahun ?>',
                                },
                                bars: 'vertical',
                                    vAxis: {
                                        format: 'decimal'
                                    },
                                    height: 350,
                                    width: 950,
                                    colors: ['#1b9e77', '#d95f02', '#7570b3']
                            };
                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                            chart.draw(datar, google.charts.Bar.convertOptions(optionss));
                            }
                            </script>
                        </head>
                        
                </div>

                <div class="col-lg-6">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Kuesioner", "Persentase", { role: "style" } ],
                            ['Himasi', <?php echo ($hasil_himasi == 0) ? 0.1 : $hasil_himasi; ?>, "#b87333"],
                            ['Himatif', <?php echo ($hasil_himatif == 0) ? 0.1 : $hasil_himatif; ?>, "silver"],
                            ['Himate', <?php echo ($hasil_himate == 0) ? 0.1 : $hasil_himate; ?>,  "gold"],
                            ['Hmj MT ', <?php echo ($hasil_hmjmt == 0) ? 0.1 : $hasil_hmjmt; ?>, "color: #e5e4e2"],
                            ['Hmj TI', <?php echo ($hasil_hmjti == 0) ? 0.1 : $hasil_hmjti; ?>, "red"],
                            ['Sema', <?php echo ($hasil_sema == 0) ? 0.1 : $hasil_sema; ?>,  "blue"],
                            ['Dema', <?php echo ($hasil_dema == 0) ? 0.1 : $hasil_dema; ?>,  "green"],
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                        { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                        2]);

                        var options = {
                            title: "Grafik Kuesioner Pelanggan tahun     <?= $tahun ?>",
                            width: 900,
                            height: 300,
                            bar: {groupWidth: "70%"},
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                    }
                    </script>
                    
                </div>


            <br>
            <br>
        </div>

    </div>
    </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="../js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../js/plugins/toastr/toastr.min.js"></script>

    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Touch Punch - Touch Event Support for jQuery UI -->
    <script src="../js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>

    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>

    <!-- Jvectormap -->
    <script src="../js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>



    <script>
    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success(
                'Selamat Datang Di Sistem Informasi Monitoring Unit Kegiatan Mahasiswa Fakultas Sains & Teknologi UIN SUSKA Riau',
                'Assalamualaikum..');

        }, 1300);


        var data1 = [
            [0, 4],
            [1, 8],
            [2, 5],
            [3, 10],
            [4, 4],
            [5, 16],
            [6, 5],
            [7, 11],
            [8, 6],
            [9, 11],
            [10, 30],
            [11, 10],
            [12, 13],
            [13, 4],
            [14, 3],
            [15, 3],
            [16, 6]
        ];
        var data2 = [
            [0, 1],
            [1, 0],
            [2, 2],
            [3, 0],
            [4, 1],
            [5, 3],
            [6, 1],
            [7, 5],
            [8, 2],
            [9, 3],
            [10, 2],
            [11, 1],
            [12, 0],
            [13, 2],
            [14, 8],
            [15, 0],
            [16, 0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
        ], {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#d5d5d5'
            },
            colors: ["#1ab394", "#1C84C6"],
            xaxis: {},
            yaxis: {
                ticks: 4
            },
            tooltip: false
        });

        var doughnutData = [{
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };

        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = [{
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 140,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 200,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };
        var ctx = document.getElementById("polarChart").getContext("2d");
        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);

    });
    </script>

</body>

</html>