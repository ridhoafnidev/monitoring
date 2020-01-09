<?php
	include "db.php";
	require_once("../dompdf/dompdf_config.inc.php");
	ob_start();

$no_kontrak = $_GET ['no_kontrak'];
$tgl=getdate();
$tanggal=$tgl['year'].'-'.$tgl['mon'].'-'.$tgl['mday'];

$sql = "SELECT * from progress,proyek where proyek.no_kontrak=progress.no_kontrak and progress.no_kontrak = '$no_kontrak' order by minggu_ke";
$stmt = $db->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
if($stmt->execute() > 0){
?>


                		<table align="center" style="width: 1000px">
					<tr>
						<td width="1"> <span> <img src="../logo.png" width="80" height="80"> </span></td><td width="500" > <span> <h4 align="center"> <b>PT. WAHANAKARSA SWANDIRI<br>
						CONSTRUCTION COMPANY
						<br>Jl.Arifin Ahmad No.10, Sidomulyo Tim. Marpoyan Damai, Kota Pekanbaru, Riau. Indonesia - Website : http://www.wahanakarsa.co.id
						</span></td><td width="300"></td>
					</tr>


					</table>
					<hr>
                	<table align="left" style="width: 500px">
					<h4> Tanggal Proyek : <?php echo date('d-m-Y', strtotime($tanggal)) ?> </h4>
					</table>

	<br>
					<table class="footable table table-stripped" style="width:100%;" border="1">
				<thead>
					<tr>
						<th>No</th>
							<th>Minggu Ke</th>
						<th>Uraian</th>
						<th>Bobot</th>
						
						
						<th>Progress Minggu Ini</th>
						<th>Rencana Minggu Depan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					foreach ($stmt as $value)
						{
							$no++;
					?>
					<tr>
						<td><?= $no ?></td>
						<td><?= $value->minggu_ke ?></td>
						<td><?= $value->uraian_pekerjaan ?></td>
						<td><?= $value->bobot ?>%</td>
						
						
						<td><?= $value->progress ?>%</td>
						<td><?= $value->rencana ?>%</td>
					</tr>
						<?php }}?>
				 </tbody>
			</table>
			<br>
			<br>
			<br>
			<br>
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table style="width:100%;" > <tbody><tr><td width="80%"></td><td>Project Manager</td></tr></tbody></table>
			<br>
			<br>
			<table style="width:100%;" > <tbody><tr><td width="80%"></td><td><?= $value->pelaksana ?></td></tr></tbody></table>

<?php
	$html = ob_get_contents();
	ob_end_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_paper('letter', 'landscape');
	$dompdf->render();
	$dompdf->stream('laporan'.$tanggal.'.pdf');
?>
