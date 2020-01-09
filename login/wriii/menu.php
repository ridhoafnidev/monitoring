 <?php  
    include 'db.php';

    $nama = $_SESSION['username'];
    
    $query = $db->prepare("SELECT * FROM user where username='$nama'");
    $query->execute();
    $nama = $query->fetchAll();

    $query = $db->prepare("SELECT * FROM masa_jabatan where status='aktif'");
    $query->execute();
    $masa_jabatan = "";
    $data_mj = $query->fetchAll();
    foreach($data_mj as $data_m)
    $masa_jabatan = $data_m['tgl_akhir_priode'];
    $date_now = date("Y-m-d");
?>

 <?php $no = 0;
    foreach ($nama as $value) {
        $no++; 
 ?>

<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element" align="center"> <span>
                            <img alt="image" width="100" height="100" class="img-circle" src="../images/<?php echo $value['image'] ?> " />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $value['nama'] ?> </span></span> </a>
                            
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
					<li>
                        <a href="home.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="grafik.php"><i class="fa fa-bar-chart"></i> <span class="nav-label">Grafik</span></a>
                    </li>
                    <li>
                        <a href="anggaranhimpunan.php"><i class="fa fa-money"></i> <span class="nav-label">Data Anggaran</span></a>
                    </li>
                    <li>
                        <a href="datahimpunan.php"><i class="fa fa-laptop"></i> <span class="nav-label">Data UKM</span></a>
                    </li>
                    <?php
                   if($date_now == $masa_jabatan){?>
                    <li>
                        <a href="kuesioner.php"><i class="fa fa-question"></i> <span class="nav-label">Kuesioner</span></a>
                    </li>
                   <?php } else {?>
                   <?php } ?>
                    <li>
                        <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Laporan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                        <li><a href="proker.php">Program Kerja</a></li>
                        <li><a href="proposal.php">Proposal</a></li>
                        <li><a href="lpj.php">LPJ</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="ubahpassword.php"><i class="fa fa-gears"></i> <span class="nav-label">Ganti Password</span></a>
                    </li>
                    
                    
            </div>
        </nav>
        <?php } ?>
