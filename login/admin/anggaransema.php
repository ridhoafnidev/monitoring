<?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM anggaran where keterangan='Sema & Dema'");
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

    <title>Data Anggaran Sema & Dema</title>

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

$tahun_anggaran=$_REQUEST['tahun_anggaran'];
$total=$_REQUEST['total_anggaran'];
$program_studi=$_REQUEST['program_studi'];

$total_anggaran = preg_replace('/\D/','',$total);


    
$insert = "SELECT tahun_anggaran, program_studi from anggaran where tahun_anggaran='$tahun_anggaran' and program_studi='$program_studi'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();
        
//Row will return false if there was no value
        if ($stmti->rowCount() == 0) {
            //insert new data
            $insert = "insert into anggaran values(' ','$program_studi', '$tahun_anggaran', '$total_anggaran','$total_anggaran','Sema & Dema')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Anggaran Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=anggaransema.php">';
        } else {
           echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Gagal!","Tidak dapat menambahkan anggaran pada Sema/Dema yang sama di tahun yang sama!","error");})</script>';
echo '<meta http-equiv="Refresh" content="3; URL=anggaransema.php">';
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
                    <h2>Data Anggaran <strong>Sema & Dema</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Data Anggaran</a>
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
                            <h5>Data Anggaran Sema & Dema</h5>

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
                                    <th>Sema/Dema</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Anggaran Tersedia</th>
                                    <th>Total Anggaran</th>
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
                    <td><?php echo $value['program_studi'] ?></td>
                    <td><?php echo $value['tahun_anggaran'] ?></td>
                    <td><?php $a = $value['anggaran_tersedia'];
                    echo "Rp. ".number_format($a, 0, ".", "."); ?></td>
                    <td><?php $d = $value['total_anggaran'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?></td>



                    <td>
                        <a href="detailsema.php?id_anggaran=<?php echo $value ['id_anggaran'] ?>&program_studi=<?php echo $value['program_studi'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>
                        <a href="edit-anggaran-sema.php?id_anggaran=<?php echo $value ['id_anggaran'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>


                        <a href="hapus-anggaran-sema.php?id_anggaran=<?php echo $value['id_anggaran']?>" onclick="return hapus()" class="btn btn-danger btn-sm btn-icon icon-left">
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
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus" href="#modal-form">Tambah Anggaran</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="m-t-none m-b">Tambah Anggaran</h3>

                                                   <form role="form" method="post" enctype="multipart/form-data" >
                                                        <div class="form-group"><label>Sema & Dema</label>
                                                            <div class="form-group">
                                                                <select class="form-control" name="program_studi">
                                                                <option value="">-Pilih Sema/Dema-</option>
                                                                <option value="Sema">Sema</option>
                                                                <option value="Dema">Dema</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label>Tahun</label> <input type="text" name="tahun_anggaran" placeholder="Masukkan Tahun Anggaran" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Jumlah Anggaran </label> <input type="text" name="total_anggaran" id="rupiah" placeholder="Masukkan Jumlah Anggaran" class="form-control" required=""></div>
                                                       
                                                      
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
        <script type="text/javascript">
        
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

<script type="text/javascript" language="JavaScript">
 function hapus()
 {
 tanya = confirm("Anda Yakin Menghapus Data Anggaran Ini ?");
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
