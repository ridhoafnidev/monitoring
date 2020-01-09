<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:36:08 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Halaman Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" href="logo.ico" type="image/x-icon" />
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/sweetalert.css">

</head>
<?php

session_start();

include 'db.php';

if(isset($_POST['send'])){

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$md5 = md5($password);


$sql = "select * from user where username='$username' and password=('$md5')";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

$v = $stmt->fetch();

if($v){
    $_SESSION["id"] = $v->id;
    $_SESSION["username"] = $v->username;
    $_SESSION["keterangan"] = $v->keterangan;
    $_SESSION["nama"] = $v->nama;
    $_SESSION["program_studi"] = $v->program_studi;
    $_SESSION["status"] = $v->status;
    
    if($_SESSION["keterangan"] == "Admin") {
            header("Location:admin/home.php");
        } if($_SESSION["keterangan"] == "Himpunan") {
            header("Location:himpunan/home.php");
            } if($_SESSION["keterangan"] == "Ketua Prodi") {
            header("Location:kaprodi/home.php");
                } if($_SESSION["keterangan"] == "Sema & Dema") {
                header("Location:semadema/home.php");
                    } if($_SESSION["keterangan"] == "WD III") {
                    header("Location:wdiii/home.php");
                        } if($_SESSION["keterangan"] == "WR III") {
                        header("Location:wriii/home.php");
                            } if($_SESSION["keterangan"] == "Kabag") {
                            header("Location:kabag/home.php");
                                } if($_SESSION["keterangan"] == "Dekan") {
                                header("Location:dekan/home.php");
        }

}else{
    
    $_SESSION['username'] = "";
    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Gagal!","Username atau password salah!","error");})</script>';
echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
}
}
?>
<body class="gray-bg" >

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

            

            </div>
            <br>
            <br>
            <div align="center"><img width="150" align="center" src="logo.png" /></div>
            <br>
            <h3>Assalamu'alaikum, silahkan login.</h3>
            <form class="m-t" role="form" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="send" class="btn btn-primary block full-width m-b">Login</button>

                
            </form>
            <p class="m-t"> <small>Rusdi Hidayah | Sistem Informasi &copy; 2019</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:36:08 GMT -->
</html>
