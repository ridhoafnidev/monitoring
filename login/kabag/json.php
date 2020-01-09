<?php
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

$query = mysqli_query($koneksi, 'SELECT * FROM anggaran WHERE tahun_anggaran = "'.$tahun_aktif.'" ');

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
while($r = mysqli_fetch_assoc($query)) {
    $temp = array();
	// masing-masing kolom kita masukkan sebagai array sementara
	$temp[] = array('v' => $r['program_studi']);
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