<?php
if(!isset($_SESSION["username"])){
	header("Location:login/index.php");
} else {
	header("Location:index.php");
}
?>