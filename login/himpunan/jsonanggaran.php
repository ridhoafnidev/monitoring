<?php

include 'db.php';
include 'session.php';

$host="localhost";
$user="root";
$password="";	
$koneksi=mysqli_connect($host,$user,$password) or die("Gagal Koneksi Database");
mysqli_select_db($koneksi, "monitoring");
// write your SQL query here (you may use parameters from $_GET or $_POST if you need them)

$query_mj = mysqli_query($koneksi, 'SELECT * FROM masa_jabatan where status="aktif" ');
$tahun_aktif = "";
$ex_tahun_aktif = "";
while($mj =  mysqli_fetch_assoc($query_mj)){
	$tahun_aktif = $mj['tahun_priode'];
	$ex_tahun_aktif = explode("-", $tahun_aktif);
	$tahun_aktif = $ex_tahun_aktif[0];
}
$username = $_SESSION['username'];
$query = mysqli_query($koneksi, 'SELECT * FROM anggaran, user where anggaran.program_studi=user.program_studi and anggaran.keterangan=user.keterangan and username="'.mysqli_escape_string($koneksi,$username).'" ');
// $query = mysqli_query($koneksi, 'SELECT * FROM anggaran, user where anggaran.keterangan="Sema & Dema" and tahun_anggaran="'.mysqli_escape_string($koneksi,$tahun_aktif).'" and user.username="'.mysqli_escape_string($koneksi,$username).'" ');
$table = array();
$table['cols'] = array(
	/* Disini kita mendefinisikan fata pada tabel database
	 * masing-masing kolom akan kita ubah menjadi array
	 * Kolom tersebut adalah parameter (string) dan nilai (integer/number)
	 * Pada bagian ini kita juga memberi penamaan pada hasil chart nanti
	 */
    array('label' => 'Anggaran', 'type' => 'string'),
    array('label' => 'Anggaran Tersedia', 'type' => 'number'),
    array('label' => 'Total Anggaran', 'type' => 'number')
	
);
// melakukan query yang akan menampilkan array data
$rows = array();
// print_r(mysqli_fetch_assoc($query));
while($r = mysqli_fetch_assoc($query)) {
    $temp = array();
	// masing-masing kolom kita masukkan sebagai array sementara
	$temp[] = array('v' => $r['tahun_anggaran']);
	$temp[] = array('v' => (int) $r['anggaran_tersedia']);
	$temp[] = array('v' => (int) $r['total_anggaran']);
    $rows[] = array('c' => $temp);
}
// mempopulasi row tabel
$table['rows'] = $rows;
// encode tabel ke bentuk json
$jsonTable = json_encode($table);
// set up header untuk JSON, wajib.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
// menampilkan data hasil query ke bentuk json
echo $jsonTable;
?>