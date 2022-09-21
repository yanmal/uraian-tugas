<?php
require_once "config.php";
$id_tug = (isset($_POST['id_keg'])) ? $_POST['id_keg'] : 'null';

$detail = $link->query("SELECT * FROM uraian_tugas WHERE id = '{$id_tug}'");
$row = $detail->fetch_object();

?>

<div class="row pl-3">
	<div class="col-lg-1 mt-3">
		<i class="fa fa-briefcase fa-lg"></i> 
	</div>
	<div class="col-lg-11">
		<div class="form-group">
			<label for="kegiatan">Uraian Tugas</label>
			<h6 class="text-primary"><strong><?= $row->uraian ?></strong></h6>
		</div>
	</div>
	<div class="col-lg-1 mt-3">
		<i class="fas fa-calendar-alt fa-lg"></i>
	</div>
	<div class="col-md-11">
		<div class="form-group">
			<label for="bukti">Tanggal</label>
			<h6 class="text-primary"><strong><?= nama_hari(date('D', strtotime($row->tgl))) . ', ' .date('d-m-Y', strtotime($row->tgl)) ?></strong></h6>
		</div>
	</div>
	<div class="col-lg-1 mt-3">
		<i class="fa fa fa-clock fa-lg"></i> 
	</div>
	<div class="col-md-11">
		<div class="form-group">
			<label for="bukti">Waktu</label>
			<h6 class="text-primary"><strong><?= $row->mulai .' - '. $row->akhir ?></strong></h6>
		</div>
	</div>
	<div class="col-lg-1 mt-3">
		<i class="fas fa-file-alt fa-lg"></i> 
	</div>
	<div class="col-md-11">
		<div class="form-group">
			<label for="ket">Hasil Kerja</label>
			<h6 class="text-primary"><strong><?= $row->hasil ?></strong></h6>
		</div>
	</div>
	<!-- <div class="col-lg-1 mt-3">
		<i class="fa fa-comments fa-lg"></i> 
	</div>
	<div class="col-md-11">
		<div class="form-group">
			<label for="ket">Keterangan</label>
			<h6 class="text-primary"><strong><?= $row['ket'] ?></strong></h6>
		</div>
	</div> -->
</div>