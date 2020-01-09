<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">
                    <marquee>Welcome to Sistem Informasi Monitoring.</marquee>
                </span>
            </li>
            <?php 
                $username = $_SESSION['username'];
                $query = $db->prepare("SELECT count(proposal.id_proker) as proker from proker, proposal, user WHERE proker.oleh=user.username and proker.id_proker=proposal.id_proker and proposal.status_anggaran='Telah Dianggarkan' and user.username='$username'");
                // Jalankan perintah SQL
                $query->execute();
                // Ambil semua data dan masukkan ke variable $data
                $proker = $query->fetchAll();
                //var_dump($proker);
                $query = $db->prepare("SELECT * from proker, proposal, user WHERE proker.oleh=user.username and proker.id_proker=proposal.id_proker and proposal.status_anggaran='Telah Dianggarkan' and user.username='$username'");
                
                // Mengambil semua 
                // $query = $db->prepare("SELECT * from proker, proposal, user WHERE proker.oleh=user.username and proker.id_proker=proposal.id_proker and proposal.status_anggaran='Telah Dianggarkan' and user.username='$username'");
                // Jalankan perintah SQL
                $query->execute();
                // Ambil semua data dan masukkan ke variable $data
                $info = $query->fetchAll();  
            ?>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    <span class="label label-primary"><?php 
                    foreach($proker as $proker_s){
                        echo $proker_s["proker"];
                    } 
                    ?>
                    </span> Info
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <?php foreach($info as $value){ ?>
                    <li>
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Kegiatan <b><?php echo $value['nama_kegiatan']; ?></b>
                            telah <b>Dianggarkan</b>, silahkan selesaikan kegiatan tersebut dan kirim LPJ untuk
                            pengambilan dana kegiatan.
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>