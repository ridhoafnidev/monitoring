  <?php
    include 'db.php';
include 'session.php';

if(!isset($_SESSION["username"])){
	header("Location:../login.php");
}
    $username = $_SESSION['username'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker, user where user.username=proker.oleh and user.keterangan='Himpunan' and user.username='$username'");
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

if(isset($_POST['send'])){

move_uploaded_file($_FILES["file"]["tmp_name"],"../file/" . $_FILES["file"]["name"]);
$file=$_FILES["file"]["name"];
$nama_kegiatan=$_REQUEST['nama_kegiatan'];
$tahun_anggaran=$_REQUEST['tahun_anggaran'];
$ketua_pelaksana=$_REQUEST['ketua_pelaksana'];
$tgl_realisasi = $_REQUEST['tgl_realisasi'];
$rancang = $_REQUEST['rancangan_biaya'];

$rancangan_biaya = preg_replace('/\D/','',$rancang);

$insert = "insert into proker values(' ','$nama_kegiatan', '$tahun_anggaran','$ketua_pelaksana','$tgl_realisasi','$rancangan_biaya','$file','0','Menunggu','Tidak Ada','Tidak Ada','$username')";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Data Program Kerja Berhasil Di Simpan!","success");})</script>';
  echo '<meta http-equiv="Refresh" content="1; URL=proker.php">';
}
?>
<body>

    <div id="wrapper">
	 <?php include 'menu.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <?php include 'header.php'; ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Kelola <strong>Program Kerja</strong> </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="home.php">Home</a>
                        </li>
                        <li>
                            <a>Himpunan</a>
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Data Program Kerja</h5>

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
                                    <th>Nama Kegiatan</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>Status Proker</th>
                                    <th>Status Proposal</th>
                                     <th>Status LPJ</th>
                                    <th>Progress</th>
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
                    <td><?php echo $value['nama_kegiatan'] ?></td>
                    <td><?php echo $value['tahun_anggaran'] ?></td>
					<td><?php echo $value['ketua_pelaksana'] ?></td>
					<td>  <p><span class="badge badge-<?php
                    $a = $value['status_proker'];
                    if($a=="Menunggu"){
                        echo "warning";
                    }elseif($a=="Telah Disetujui"){
                        echo "primary";
                        }
                        elseif($a=="Telah Ditolak"){
                            echo "danger";
                        }
                    ?>"><?php echo $value['status_proker'] ?></span></p></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_proposal'];
                    if($a=="Menunggu"){
                        echo "warning";
                        }elseif($a=="Telah Disetujui"){
                        echo "primary";
                            }elseif($a=="Telah Ditolak"){
                            echo "danger";
                                }elseif ($a=="Tidak Ada") {
                                    echo "default";
                                }
                    ?>"><?php echo $value['status_proposal'] ?></span></p></td>
                    <td>  <p><span class="badge badge-<?php
                    $a = $value['status_lpj'];
                    if($a=="Menunggu"){
                        echo "warning";
                        }elseif($a=="Telah Disetujui"){
                        echo "primary";
                            }elseif($a=="Telah Ditolak"){
                            echo "danger";
                                }elseif ($a=="Tidak Ada") {
                                    echo "default";
                                }
                    ?>"><?php echo $value['status_lpj'] ?></span></p></td>
                    

                    <td>
    <?php
    $id_proker = $value['id_proker'];
    $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
    $query->execute();
    $data2 = $query->fetchAll();
    ?>
    <?php 
                foreach ($data2 as $value2) {?> 
                <?php 
                $c = $value2['total'];
          ?>
    <div class="progress progress-striped active">
                                <div style="width: <?php echo $c ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $value['progress'] ?>" role="progressbar" class="progress-bar progress-bar-<?php
            if($c<40){
              echo "danger";
            }elseif ($c<70){
              echo "warning";
              }elseif ($c>70){
                echo "primary";
              }
            ?>">
                    <?php echo $c ?>%</div></td>
                    <?php }
                 ?>

<?php
    $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
    $query->execute();
    $data2 = $query->fetchAll();
    exit();
    ?>
    <?php 
                foreach ($data2 as $value2) {?> 
                <?php 
                $z = $value2['total'];
                
          ?>
					<td>
                    <?php if ($value['status_proker']=="Telah Disetujui" && $z<100){ ?>
                            <a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>
                        
                        <button type="button" class="btn-sm btn btn-warning"  data-toggle="popover" data-placement="auto top" data-content="Tidak dapat mengupload LPJ! Progress belum mencapai 100!">
                                <i class="fa fa-files-o"> </i> LPJ
                            </button>

                    <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Tidak Ada") { ?>

                    
						<a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
							<i class="fa fa-eye"></i>
							Detail
						</a>

						<a href="lpj.php?id_proker=<?php echo $value['id_proker']?>" class="btn btn-success btn-sm btn-icon icon-left">
							<i class="fa fa-upload"></i>
							LPJ
						</a>

                    <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Menunggu") { ?>

                    
                        <a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>

                        <a class="btn btn-success btn-sm btn-icon icon-left">
                            <i class="fa fa-gear"></i>
                            LPJ Telah Diupload
                        </a>
                    <?php }elseif($value['status_proker']=="Telah Disetujui" && $z=="100" && $value['status_lpj']=="Telah Ditolak") { ?>

                    
                        <a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>

                        <a href="lpj.php?id_proker=<?php echo $value['id_proker']?>" class="btn btn-success btn-sm btn-icon icon-left">
                            <i class="fa fa-upload"></i>
                            LPJ Ditolak<br>
                            Upload ulang?
                        </a>

                    <?php }elseif($value['status_proker']=="Menunggu" || $z<100 && $value['status_lpj']=="Tidak Ada") { ?>
                        <a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>

                        <button type="button" class="btn-sm btn btn-warning"  data-toggle="popover" data-placement="auto top" data-content="Tidak dapat mengupload LPJ! Progress tidak memenuhi syarat!">
                                <i class="fa fa-files-o"> </i> LPJ
                            </button>
					</td>
                    <?php }else{ ?>
                        <a href="detailproker.php?id_proker=<?php echo $value ['id_proker'] ?>" class="btn btn-primary btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            Detail
                        </a>

                  <?php      
                    } 
                     } ?>
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
    $username = $_SESSION['username'];
    $query = $db->prepare("SELECT file_pdf from birokrasi where jenis_birokrasi='Program Kerja'");
    $query->execute();
    $data4 = $query->fetchAll();
?>
<?php foreach ($data4 as $value2) {
?>
                        <div class="ibox-content">
                            <div class="text-left">
                            <a data-toggle="modal" class="btn btn-primary" class="fa fa-plus" href="#modal-form">Tambah Program Kerja</a>
                            </div>
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
													<h3 class="m-t-none m-b">Tambah Program Kerja</h3>

                                                   <form role="form" method="post" enctype="multipart/form-data" >
                                                        <div class="form-group"><label><a href="download.php?file=<?php echo $value2['file_pdf'] ?> " class="btn btn-sm btn-primary" >Download</a></label> Download Alur Birokrasi Program Kerja Disini.</div>
                                                        <div class="form-group"><label>Nama Kegiatan</label> <input type="text" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Tahun Anggaran</label> <input type="text" name="tahun_anggaran" placeholder="Masukkan Tahun Anggaran" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Ketua Pelaksana</label> <input type="text" name="ketua_pelaksana" placeholder="Masukkan Nama Ketua Pelaksana" class="form-control" required=""></div>
                                                        <div class="form-group"><label>Tanggal Realisasi</label> <input type="date" name="tgl_realisasi"  class="form-control" required=""></div>
                                                        <div class="form-group"><label>Rancangan Anggaran Biaya</label> <input type="text" name="rancangan_biaya" id="rupiah" placeholder="Masukkan Rancangan Anggaran Biaya Kegiatan yang Dibutuhkan (Rp)" class="form-control" required=""></div>

                                                        <div class="form-group"><label>Upload PDF</label>
                                                         <input type="file" name="file" class="form-control" required></div>
                                                      
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
