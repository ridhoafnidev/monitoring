<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}
    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker, user where proker.oleh=user.username");
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

    <title>Data Program Kerja</title>

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

<body>

    <div id="wrapper">
        <?php include 'menu.php';

        ?>


        <div id="page-wrapper" class="gray-bg">
            <?php include 'header.php';
        ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data <strong>Anggaran</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>

                        <li class="active">
                            <strong>Anggaran</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <?php 
        $username = $_SESSION['username'];
    $query = $db->prepare("SELECT * FROM anggaran where keterangan='Himpunan'");
    $query->execute();
    $data = $query->fetchAll();
    ?>
                    <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Himpunan</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2">Sema & Dema</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3">Grafik Sema & Dema</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                            placeholder="Search in table">

                                        <table class="footable table table-stripped" data-page-size="8"
                                            data-filter=#filter>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Program Studi</th>
                                                    <th>Tahun Anggaran</th>
                                                    <th>Anggaran Tersedia</th>
                                                    <th>Total Anggaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $value['program_studi'] ?></td>
                                                    <td><?php echo $value['tahun_anggaran'] ?></td>
                                                    <td><?php $a = $value['anggaran_tersedia'];
                            
                    echo "Rp. ".number_format($a, 0, ".", "."); ?></td>
                                                    <td><?php $d = $value['total_anggaran'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></td>



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
                                <?php 
                                $username = $_SESSION['username'];
                                $query = $db->prepare("SELECT * FROM anggaran where keterangan='Sema & Dema'");
                                $query->execute();
                                $data = $query->fetchAll();
                                ?>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                            placeholder="Search in table">

                                        <table class="footable table table-stripped" data-page-size="8"
                                            data-filter=#filter>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Sema/Dema</th>
                                                    <th>Tahun Anggaran</th>
                                                    <th>Anggaran Tersedia</th>
                                                    <th>Total Anggaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;
                                                    foreach ($data as $value) {
                                                        $no++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $value['program_studi'] ?></td>
                                                    <td><?php echo $value['tahun_anggaran'] ?></td>
                                                    <td><?php $a = $value['anggaran_tersedia'];
                                                    echo "Rp. ".number_format($a, 0, ".", "."); ?></td>
                                                    <td><?php $d = $value['total_anggaran'];
                                                    echo "Rp. ".number_format($d, 0, ".", "."); ?></td>
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
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                    <?php
                                        //koneksi ke database
                                        $conn = new mysqli("localhost", "root", "", "monitoring");
                                        if ($conn->connect_errno) {
                                            echo die("Failed to connect to MySQL: " . $conn->connect_error);
                                        }

                                        $rows = array();
                                        $table = array();
                                        $table['cols'] = array(
                                            //membuat label untuk nama nya, tipe string
                                            array('label' => 'Kelas', 'type' => 'string'),
                                            //membuat label untuk jumlah siswa, tipe harus number untuk kalkulasi persentasenya
                                            array('label' => 'Jumlah siswa', 'type' => 'number')
                                        );

                                        //melakukan query ke database select
                                        $sql = $conn->query("SELECT * FROM anggaran");
                                        //perulangan untuk menampilkan data dari database
                                        while($data = $sql->fetch_assoc()){
                                            //membuat array
                                            $temp = array();
                                            //memasukkan data pertama yaitu nama kelasnya
                                            $temp[] = array('v' => (string)$data['program_studi']);
                                            //memasukkan data kedua yaitu jumlah siswanya
                                            $temp[] = array('v' => (int)$data['anggaran_tersedia']);
                                            //memasukkan data diatas ke dalam array $rows
                                            $rows[] = array('c' => $temp);
                                        }

                                        //memasukkan array $rows dalam variabel $table
                                        $table['rows'] = $rows;
                                        //mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
                                        $jsonTable = json_encode($table);

                                        ?>

                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                            <script type="text/javascript">

                                            google.charts.load('current', {'packages':['corechart']});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {

                                                // membuat data chart dari json yang sudah ada di atas
                                                var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

                                                // Set options, bisa anda rubah
                                                var options = {
                                                            'title':'Anggaran dana',
                                                            'width':800,
                                                            'height':800,
                                                            'redFrom': 90, 'redTo': 100,
                                                            'yellowFrom':75, 'yellowTo': 90,
                                                            'minorTicks': 5,
                                                            'majorTricks':['A','B','C']};

                                                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                                chart.draw(data, options);
                                            }
                                            </script>

                                            <!--Div yang akan menampilkan chart-->
                                            <div id="chart_div"></div>

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
    function setujui() {
        tanya = confirm("Anda Yakin Menyetujui Program Kerja Ini ?");
        if (tanya == true) return true;
        else return false;
    }
    </script>
    <script type="text/javascript" language="JavaScript">
    function tolak() {
        tanya = confirm("Anda Yakin Menolak Program Kerja Ini ?");
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