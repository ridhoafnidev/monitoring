<?php
	
	include "db.php";
	require_once("../dompdf/dompdf_config.inc.php");
	ob_start();

include 'session.php';
$id_proker = $_REQUEST['id_proker'];
$nama = $_SESSION['username'];

$sql = "SELECT * FROM proker,detail_proker, proposal,lpj,user where proposal.id_proker=proker.id_proker and lpj.id_proker=proker.id_proker and proker.id_proker=detail_proker.id_proker and user.username=proker.oleh and user.username='$nama' and proker.id_proker='$id_proker'";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
if($stmt->execute() > 0){
?>

<body style="line-height: 20px">
<table align="center" style="width: 500px">
					<tr>
						<td width="100"> <span> <img src="../logo.png" width="120" height="120"> </span></td><td width="400" > <span> <h4 align="center">KEMENTRIAN AGAMA
						<br> UNIVERSITAS ISLAM NEGERI SULTAN SYARIF KASIM RIAU
						<br> FAKULTAS SAINS DAN TEKNOLOGI
						</h4>
						Jl. H.R. Soebrantas Km.15 Panam Pekanbaru. PO. Box. 1004 Telp. 0761-8359937
						</span> </td>
					</tr>
					</table>
               
				<hr>
				<table align="center" class="table highlight border bordered bg-white" style="width:100%;" >
				
					
					
					<br>

					<?php
					$no = 0;
					foreach ($stmt as $q)
						{
							$no++;        
					?>
					<tr align="center">
						<td ><b>BUKTI PENGAMBILAN BANTUAN DANA KEGIATAN
						<br>UNIT KEGIATAN MAHASISWA (UKM)
						<br>FAKULTAS SAINS DAN TEKNOLOGI
						<br>UIN SUSKA RIAU</b></td>
											
					</tr>
					</table>
					
					<table style="width: 600px">
					<tr>

					<td>1. NAMA ORGANISASI</td><td>:</td> <td><?= $q->nama ?></td>
					</tr>
					<tr>
					<td>2. TANGGAL REALISASI ANGGARAN</td><td>:</td> <td><?= $q->tgl_realisasi ?></td>
					</tr>
					<tr>
					<td>3. TAHUN ANGGARAN</td><td>:</td> <td><?= $q->tahun_anggaran ?></td>
					</tr>
					
					<tr>
					<td>4. BANTUAN DANA AWAL</td><td>:</td> <td><?= $q->bantuan_awal ?></td>
					</tr>
					<tr>
					<td>5. REALISASI ANGGARAN BANTUAN DANA</td><td>:</td> <td><?= $q->realisasi_bantuan ?></td>
					</tr>
					<tr>
					<td>6. STATUS</td>
					</tr>
					</table>
					<br>
					<table border="1" align="center" style="width: 600px">
						<thead>
						<tr>
							<th>NO</th>
							<th>NAMA</th>
							<th>STATUS</th>
						</tr>

						</thead>
						<tbody>
						<tr>
							<td>1</td><td>Program Kerja</td><td>Diterima</td>
						</tr>
						<tr>
							<td>2</td><td>Proposal Kegiatan</td><td>Diterima</td>
						</tr>
						<tr>
							<td>3</td><td>Laporan Pertanggung Jabawan (LPJ)</td><td>Diterima</td>
						</tr>
						</tbody>
					</table>
			<br>
			<br>
			
				 </body>
				 
				 
<?php
	$html = ob_get_contents();
	ob_end_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream('kwitansi'.$id_proker.'.pdf');
?> <?php }} ?>
