<?php
    include 'db.php';
    include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    $query = $db->prepare("SELECT * FROM masa_jabatan where status='aktif'");
    $query->execute();
    $masa_jabatan = "";
    $data_mj = $query->fetchAll();
    foreach($data_mj as $data_m){
        $masa_jabatan = $data_m['tgl_akhir_priode'];
    }
    $tahun_ex = explode("-", $masa_jabatan);
    $tahun = $tahun_ex['0'];
    
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM proker INNER JOIN user ON proker.oleh=user.username where proker.tahun_anggaran='$tahun'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
?>
<?php $no = 0;
$table = array();
$table['cols'] = array(
	/* Disini kita mendefinisikan fata pada tabel database
	 * masing-masing kolom akan kita ubah menjadi array
	 * Kolom tersebut adalah parameter (string) dan nilai (integer/number)
	 * Pada bagian ini kita juga memberi penamaan pada hasil chart nanti
	 */
    array('label' => 'Pelaksana', 'type' => 'string'),
    array('label' => 'Proker', 'type' => 'string'),
    array('label' => 'Persentase', 'type' => 'number')
);
foreach ($data as $value) {
    $no++;
?>
    <?php
    $id_proker=$value['id_proker'];
    $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
    $query->execute();
    $data2 = $query->fetchAll();
    ?>

    <?php 
    foreach ($data2 as $value2) {?>
    <?php 
        if(!isset($value2['total'])){
            $c = 0;
        }else{
            $c = $value2['total'];
        } 
        //membuat array
        $temp = array();
        //memasukkan data pertama yaitu nama kelasnya
        $temp[] = array('v' => (string)$value['oleh']);

        $temp[] = array('v' => (string)$value['nama_kegiatan']);
        //memasukkan data kedua yaitu jumlah siswanya
        $temp[] = array('v' => (int)$c);
        //memasukkan data diatas ke dalam array $rows
        $rows[] = array('c' => $temp);                                    
    ?>
<?php
//memasukkan array $rows dalam variabel $table
$table['rows'] = $rows;
//mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
$jsonTable = json_encode($table); 
?>

<?php }
?>
<?php } ?>
<?php 
    // $username = $_SESSION['username'];
    // $query = $db->prepare("SELECT * FROM proker, user where proker.oleh=user.username and user.keterangan='Sema & Dema'");
    // $query->execute();
    // $data = $query->fetchAll();
?>

<?php $no = 0;
    // foreach ($data as $value) {
    // $no++;
?>

<?php
    // $id_proker=$value['id_proker'];
    // $query = $db->prepare("SELECT SUM(persentase) as total from detail_proker where status='Telah Tercapai' and bukti NOT IN ('Belum Dikirim') and id_proker='$id_proker'");
    // $query->execute();
    // $data2 = $query->fetchAll();
?>

<?php 
    // foreach ($data2 as $value2) {
?>

<?php 
    // if(!isset($value2['total'])){
    //     $c = 0;
    // }else{
    //     $c = $value2['total'];
    // } 
?>

<?php
    // //membuat array
    // $temp = array();
    // //memasukkan data pertama yaitu nama kelasnya
    // $temp[] = array('v' => (string)$value['nama_kegiatan']);
    // //memasukkan data kedua yaitu jumlah siswanya
    // $temp[] = array('v' => (int)$c);
    // //memasukkan data diatas ke dalam array $rows
    // $rows[] = array('c' => $temp);

    //memasukkan array $rows dalam variabel $table
    $table['rows'] = $rows;
    //mengeluarkan data dengan json_encode. silahkan di echo kalau ingin menampilkan data nya
    $jsonTable = json_encode($table);

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    // menampilkan data hasil query ke bentuk json
    echo $jsonTable;
?>
