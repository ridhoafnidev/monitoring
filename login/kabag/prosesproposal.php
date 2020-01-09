<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}


	$id_proposal = $_REQUEST ['id_proposal'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker, proposal where proposal.id_proker=proker.id_proker and proposal.id_proposal='$id_proposal'");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Proses Proposal</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="..//font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	<script src="../sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>
<?php
include 'db.php';

if(isset($_POST['send'])){


$bantuan_awal = $_REQUEST['bantuan_awal'];
$realisasi_bantuan = $_REQUEST['realisasi_bantuan'];
$rancangan_biaya = $_REQUEST['rancangan_biaya'];

$rancangan = preg_replace('/\D/','',$rancangan_biaya);

$bantuan = preg_replace('/\D/','',$bantuan_awal);
$realisasi = preg_replace('/\D/','',$realisasi_bantuan);

$total = $bantuan+$realisasi;
$half = $rancangan*50/100;

if ($bantuan > $rancangan && $realisasi < $rancangan) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Gagal!","Dana bantuan awal tidak boleh melebihi 50% dari dana RAB!","error");})</script>';
    echo '<meta http-equiv="Refresh" content="2; URL=prosesproposal.php?id_proposal='.$id_proposal.'">';
}elseif ($bantuan < $rancangan && $realisasi > $rancangan) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Gagal!","Dana realisasi bantuan tidak boleh melebihi 50% dari dana RAB!","error");})</script>';
    echo '<meta http-equiv="Refresh" content="2; URL=prosesproposal.php?id_proposal='.$id_proposal.'">';
}else{


    $query = $db->prepare("SELECT * FROM proposal, proker, user where proker.id_proker=proposal.id_proker and proker.oleh=user.username and proposal.id_proposal='$id_proposal'");
    $query->execute();
    $data2 = $query->fetchAll();

    foreach ($data2 as $value) {
       $z = $value['program_studi'];
    }

$insert = "update proposal set bantuan_awal='$bantuan',realisasi_bantuan='$realisasi', status_anggaran='Telah Dianggarkan' where id_proposal='$id_proposal';
update anggaran set anggaran_tersedia=anggaran_tersedia-'$total' where program_studi='$z'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Proposal Telah Di Anggarkan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=proposal.php">';
}
}
?>
<body>
    <div id="wrapper">
        <?php include 'menu.php';

		?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include 'header.php';
		?>
                <div class="row  border-bottom white-bg dashboard-header">
<?php $no = 0;
				foreach ($data as $value) {
					$no++;
											 ?>
											 <?php }
				 ?>
                    <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Anggarkan Proposal</h5>
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
                            <form  method="post" class="form-horizontal">
								
										
										<div class="form-group"><label class="col-sm-4 control-label">Nama Kegiatan</label>
											<div class="col-sm-4"><input type="text" value="<?php echo $value['nama_kegiatan'] ?>" class="form-control" readonly></div>
										</div>
                                        <div class="form-group"><label class="col-sm-4 control-label">Tahun Anggaran</label>
                                            <div class="col-sm-4"><input type="text" value="<?php echo $value['tahun_anggaran'] ?>"  class="form-control" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">Ketua Pelaksana</label>
                                            <div class="col-sm-4"><input type="text" value="<?php echo $value['ketua_pelaksana'] ?>"  class="form-control" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">Tanggal Realisasi</label>
                                            <div class="col-sm-4"><input type="text" value="<?php echo $value['tgl_realisasi'] ?>"  class="form-control" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">Rancangan Anggaran Biaya(RAB)</label>
                                            <div class="col-sm-4"><input type="text" name="rancangan_biaya" value="<?php $d = $value['rancangan_biaya'];
                    echo "Rp. ".number_format($d, 0, ".", "."); ?>"  class="form-control" readonly></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label">Status Proposal</label>
                                            <div class="col-sm-4"><input type="text" value="<?php echo $value['status_proposal'] ?>"  class="form-control" readonly></div>
                                        </div>
                                         <div class="form-group"><label class="col-sm-4 control-label">Bantuan Dana Awal Kegiatan (Tahap 1)</label>
                                            
                                            <div class="col-sm-4"><input type="text" id="rupiah" name="bantuan_awal" placeholder="Rp.(Estimasi max 50% dari RAB)"  class="form-control" ></div>
                                        </div>
                                         <div class="form-group"><label class="col-sm-4 control-label">Realisasi Anggaran Bantuan Dana (Tahap 2)</label>
                                            <div class="col-sm-4"><input type="text" name="realisasi_bantuan" id="rupiah2" placeholder="Masukkan Jumlah Dana Realisasi"  class="form-control" ></div>
                                        </div>
									<div class="form-group">
									<div class="col-md-4 col-md-offset-4"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
									<a href="dataproyek.php" class="btn btn-sm btn-danger">Batal</a></div>
									</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">




                        </div>
                </div>

            </div>
			<?php
				include 'footer.php'
				?>
        </div>

        </div>





                </div>




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
<script type="text/javascript">
        
        var rupiah2 = document.getElementById('rupiah2');
        rupiah2.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value, 'Rp. ');
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



</body>
</html>
