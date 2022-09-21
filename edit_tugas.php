<?php
session_start();
require_once "config.php";
$id_tug = (isset($_POST['id_keg'])) ? $_POST['id_keg'] : 'null';
$url = (isset($_POST['url'])) ? $_POST['url'] : 'null';
// echo $url; die() ;

$edit = $link->query("SELECT * FROM uraian_tugas WHERE id = '{$id_tug}'");
$row = $edit->fetch_object();

if (isset($_POST['submit'])):
	// var_dump($_POST['link']);
	// die();
	$id = htmlspecialchars($_POST['id']);
	$mulai = htmlspecialchars($_POST['mulai']);
	$akhir = htmlspecialchars($_POST['akhir']);
	$tugas = htmlspecialchars($_POST['tugas']);
	$hasil = htmlspecialchars($_POST['hasil']);
	$url = $_POST['link'];

	$update = $link->query("UPDATE uraian_tugas SET mulai = '{$mulai}', akhir = '{$akhir}', uraian = '{$tugas}', hasil = '{$hasil}' WHERE id = '{$id}'") or die ($link->error);

	if ($update) {
		$_SESSION['sukses'] = true;
		header('Location: ' . $url);
	} else {
		$_SESSION['sukses'] = false;
		header('Location: ' . $url);
	}
endif;
?>

<div class="row">
	<div class="col-md-12">
		<h6 class="badge badge-info py-2 px-2 text-uppercase">Hari, Tanggal : <strong><?= nama_hari(date('D', strtotime($row->tgl))) . ', ' . $row->tgl ?></strong></h6>
		<hr>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			<input type="hidden" name="id" value="<?= $row->id ?>" />
			<input type="hidden" name="link" value="<?= $url ?>" />
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="mulai">Mulai</label>
					<input type="time" name="mulai" class="form-control" id="mulai" placeholder="mulai" value="<?= $row->mulai ?>" required />
				</div>
				<div class="form-group col-md-6">
					<label for="akhir">Akhir</label>
					<input type="time" name="akhir" class="form-control" id="akhir" placeholder="akhir" value="<?= $row->akhir ?>" required />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="tugas">Uraian Tugas</label>
					<textarea rows="3" id="tugas" name="tugas" class="form-control" placeholder="uraian tugas" required /><?= $row->uraian ?></textarea>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="hasil">Hasil Kerja</label>
					<input type="text" class="form-control" name="hasil" id="hasil" placeholder="hasil" value="<?= $row->hasil ?>" required />
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-info btn-block">Simpan perubahan</button>
		</form>
	</div>
</div>