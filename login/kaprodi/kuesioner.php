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

$user_id = $_SESSION["id"];
$jumlah_kue_himasi = $_REQUEST['jumlah_kue_himasi'];
$username_himasi = $_REQUEST['username_himasi'];

$jumlah_kue_himatif = $_REQUEST['jumlah_kue_himatif'];
$username_himatif = $_REQUEST['username_himatif'];

$jumlah_kue_himate = $_REQUEST['jumlah_kue_himate'];
$username_himate = $_REQUEST['username_himate'];

$jumlah_kue_hmjmt = $_REQUEST['jumlah_kue_hmjmt'];
$username_hmjmt = $_REQUEST['username_hmjmt'];

$jumlah_kue_hmjti = $_REQUEST['jumlah_kue_hmjti'];
$username_hmjti = $_REQUEST['username_hmjti'];

$jumlah_kue_sema = $_REQUEST['jumlah_kue_sema'];
$username_sema = $_REQUEST['username_sema'];

$jumlah_kue_dema = $_REQUEST['jumlah_kue_dema'];
$username_dema = $_REQUEST['username_dema'];

    foreach($_POST['kuesioner_himasi'] as $option_num => $option_val){
        //echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himasi', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himasi', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himasi', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himasi', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }

    }

    foreach($_POST['kuesioner_himatif'] as $option_num => $option_val){
        //echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himatif', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himatif', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himatif', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himatif', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }
    }

    foreach($_POST['kuesioner_himate'] as $option_num => $option_val){
        //echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himate', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himate', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himate', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_himate', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }
    }

    foreach($_POST['kuesioner_hmjmt'] as $option_num => $option_val){
        // echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjmt', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjmt', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjmt', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjmt', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }
    }

    foreach($_POST['kuesioner_hmjti'] as $option_num => $option_val){
        // echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjti', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjti', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjti', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_hmjti', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }
    }

    foreach($_POST['kuesioner_sema'] as $option_num => $option_val){
        // echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_sema', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_sema', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_sema', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_sema', '$option_num', '', '', '', '$option_val')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }
    }

    foreach($_POST['kuesioner_dema'] as $option_num => $option_val){
        //echo $option_num." ".$option_val."<br>";
        if($option_val == 5){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_dema', '$option_num', '$option_val', '', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 4){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_dema', '$option_num', '', '$option_val', '', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }elseif($option_val == 3){
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_dema', '$option_num', '', '', '$option_val', '')";
            $stmti = $db->prepare($insert);
            $stmti->setFetchMode(PDO::FETCH_OBJ);   
            $stmti->execute();  
        }else{
            $insert = "insert into kuesioner_detail values(' ','$user_id', '$username_dema', '$option_num', '', '', '', '$option_val')";
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
                        <div class="ibox  float-e-margins">
                            <div class="ibox-title">
                                <h5>Wizard with Validation</h5>
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
                                <form name="send" method="post" action="">
                                <div id="wizard">
                                <h1>Himasi</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_himasi" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_himasi" value="himasi" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himasi[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himasi[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himasi[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himasi[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Himatif</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_himatif" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_himatif" value="himatif" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himatif[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himatif[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himatif[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himatif[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Himate</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_himate" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_himate" value="himate" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himate[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himate[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himate[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_himate[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Hmj MT</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_hmjmt" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_hmjmt" value="hmjmt" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjmt[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjmt[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjmt[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjmt[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Hmj TI</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_hmjti" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_hmjti" value="hmjti" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjti[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjti[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjti[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_hmjti[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Sema</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_sema" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_sema" value="sema" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_sema[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_sema[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_sema[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_sema[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h1>Dema</h1>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-stripped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data as $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $value['pertanyaan'] ?></td>
                                                        <td>
                                                            <input type="hidden" name="jumlah_kue_dema" value=<?=sizeof($data)?> required />
                                                            <input type="hidden" name="username_dema" value="dema" required />
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_dema[<?=$value['id_kuesioner']?>]"
                                                            value="5" required/> SB
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_dema[<?=$value['id_kuesioner']?>]"
                                                            value="4" required/> B 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_dema[<?=$value['id_kuesioner']?>]"
                                                            value="3" required/> C 
                                                            <input 
                                                            type="radio"
                                                            name="kuesioner_dema[<?=$value['id_kuesioner']?>]"
                                                            value="2" required/> K
                                                        </td>
                                                    </tr>
                                                    <?php $no++; } 
                                                    ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                
                                    </div>
                                    <div class="ibox-content" >
                                        <input class="btn btn-primary pull-right" type="submit" name="send" value="SIMPAN" />
                                    </div>
                                    <br>
                                
                                </form>
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