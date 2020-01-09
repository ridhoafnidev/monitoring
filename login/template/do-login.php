<?php

session_start();

include 'db.php';

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];


$sql = "select * from users where username='$username' and password='$password'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();

$v = $stmt->fetch();

if($v){
	$_SESSION["username"] = $v->username;
	$_SESSION["nama"] = $v->nama;
	$_SESSION["level"] = $v->level;
	// jika user ketemu
	if($_SESSION["level"] == "admin") { 
			header("Location:admin/index.php");
		} if($_SESSION["level"] == "mahasiswa") { 
			header("Location:mahasiswa/home.php");
			} if($_SESSION["level"] == "petugas") { 
			header("Location:petugas/home.php");
		}
	
}else{
	// jika user tidak ketemu
	$_SESSION['username'] = "";
	echo "<script>alert('User tidak ditemukan...'); window.history.back()</script>";
}
?>