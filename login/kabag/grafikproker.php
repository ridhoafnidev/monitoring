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
// $sql = $conn->query("SELECT * FROM proker, user where proker.oleh=user.username AND proker.oleh = 'himatif' ");

$sql_tin = $conn->query("SELECT * FROM anggaran where program_studi='Teknik Industri' ");
$sql_si = $conn->query("SELECT * FROM anggaran where program_studi='Sistem Informasi' ");
$sql_dema = $conn->query("SELECT * FROM anggaran where program_studi='Dema' ");

//$jml_tin = sizeof($sql_tin);
//$jml_dema = sizeof($sql_dema);
//$jml_si = sizeof($sql_si);

$sql = $conn->query(" SELECT
proker.*,
USER.*,
detail_proker.*,
SUM(detail_proker.persentase) AS total
FROM
detail_proker
INNER JOIN proker ON detail_proker.id_proker = proker.id_proker
INNER JOIN USER ON proker.oleh = USER.username
WHERE
proker.oleh = 'himatif' ");
//perulangan untuk menampilkan data dari database

?>
<html>
</html>

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
                    <h2>Data Laporan <strong>Program Kerja</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>

                        <li class="active">
                            <strong>Program Kerja</strong>
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
                    
                    // $query = $db->prepare("SELECT proker.*, user.*, proker_detail.* FROM proker_detail 
                    // INNER JOIN proker ON proker_detail.id_proker = proker.id_proker
                    // INNER JOIN user ON proker.oleh = user.username
                    // where proker.oleh=user.username and user.keterangan='Himpunan'");
                    //$query->execute();
                    //$data = $query->fetchAll();
                    ?>
                    <div class="col-lg-12">

                    <div id="chart_divs"></div>
                    <div id="chart_div_sema"></div>

                        <div class="tabs-container">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                                <?php $no = 0;
                                                    foreach ($data as $value) {
                                                        $no++;
                                                ?>
                                                        <?php
                                                        $id_proker=$value['id_proker'];
                                                        $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
                                                        $query->execute();
                                                        $data2 = $query->fetchAll();
                                                        ?>

                                                        <?php 
                                                        foreach ($data2 as $value2) {?>
                                                        <?php 
                                                            if(!isset($value2['total'])){
                                                                $c = 0;
                                                            }else{
                                                                $c = $value2['total'];
                                                            } 
                                                            //membuat array
                                                            $temp = array();
                                                            //memasukkan data pertama yaitu nama kelasnya
                                                            $temp[] = array('v' => (string)$value['nama_kegiatan']);
                                                            //memasukkan data kedua yaitu jumlah siswanya
                                                            $temp[] = array('v' => (int)$c);
                                                            //memasukkan data diatas ke dalam array $rows
                                                            $rows[] = array('c' => $temp);                                    
                                                        ?>
                                                    <?php
                                                    //memasukkan array $rows dalam variabel $table
                                                    $table['rows'] = $rows;
                                                    //mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
                                                    $jsonTable = json_encode($table); 
                                                    ?>
                                                    <html>
                                                    <head>
                                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                                        <script type="text/javascript">
                                                    
                                                        google.charts.load('current', {'packages':['corechart']});
                                                        google.charts.setOnLoadCallback(drawChart);
                                                    
                                                        function drawChart() {
                                                    
                                                            // membuat data chart dari json yang sudah ada di atas
                                                            var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);
                                                    
                                                            // Set options, bisa anda rubah
                                                            var options = {'title':'Grafik Proker Himpunan',
                                                                        'width':500,
                                                                        'height':300};
                                                    
                                                            var chart = new google.visualization.PieChart(document.getElementById('chart_divs'));
                                                            chart.draw(data, options);
                                                        }
                                                        </script>
                                                    </head>
                                                    <body>
                                                        <!--Div yang akan menampilkan chart-->
                                                        
                                                    </body>
                                                    </html>

                                                    <?php }
                                                    ?>
                                                    <?php } ?>
                                </div>
                                <?php 
                                    $username = $_SESSION['username'];
                                    $query = $db->prepare("SELECT * FROM proker, user where proker.oleh=user.username and user.keterangan='Sema & Dema'");
                                    $query->execute();
                                    $data = $query->fetchAll();
                                    ?>

                                    <?php $no = 0;
                                    foreach ($data as $value) {
                                        $no++;
                                    ?>
                                            <?php
                                            $id_proker=$value['id_proker'];
                                            $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
                                            $query->execute();
                                            $data2 = $query->fetchAll();
                                            ?>
                                            <?php 
                                            foreach ($data2 as $value2) {?>
                                            <?php 
                                                if(!isset($value2['total'])){
                                                    $c = 0;
                                                }else{
                                                    $c = $value2['total'];
                                                } 
                                            ?>
                                            <?php
                                            //membuat array
                                            $temp = array();
                                            //memasukkan data pertama yaitu nama kelasnya
                                            $temp[] = array('v' => (string)$value['nama_kegiatan']);
                                            //memasukkan data kedua yaitu jumlah siswanya
                                            $temp[] = array('v' => (int)$c);
                                            //memasukkan data diatas ke dalam array $rows
                                            $rows[] = array('c' => $temp);
                                        
                                            //memasukkan array $rows dalam variabel $table
                                            $table['rows'] = $rows;
                                            //mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
                                            $jsonTable = json_encode($table);
                                            
                                            ?>

                                        <html>
                                            <head>
                                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                                <script type="text/javascript">
                                            
                                                google.charts.load('current', {'packages':['corechart']});
                                                google.charts.setOnLoadCallback(drawChart);
                                            
                                                function drawChart() {
                                            
                                                    // membuat data chart dari json yang sudah ada di atas
                                                    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);
                                            
                                                    // Set options, bisa anda rubah
                                                    var options = {'title':'Grafik Proker Sema/Hima',
                                                                'width':500,
                                                                'height':400};
                                            
                                                    var chart = new google.visualization.PieChart(document.getElementById('chart_div_sema'));
                                                    chart.draw(data, options);
                                                }
                                                </script>
                                            </head>
                                            <body>
                                                <!--Div yang akan menampilkan chart-->
                                                
                                            </body>
                                        </html>  
                                        <?php } ?>
                                        <?php } ?>
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