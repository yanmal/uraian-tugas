<?php
// session_start();
// if (!isset($_SESSION['login'])) {
// 	header('Location: login.php');
// 	exit;
// }
require_once "config.php";

// $id_user = $_SESSION['user_id'];
$user = mysqli_query($link, "SELECT * FROM tbl_user WHERE id = '1'");
$r_user = mysqli_fetch_assoc($user);
// var_dump($user); die();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cetak Laporan Kegiatan</title>
	<style>
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			background-color: #FAFAFA;
			font-family: 'Segoe UI';
		}

		* {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
		}

		.page {
			width: 215mm;
			min-height: 330mm;
			padding: 15mm;
			margin: 10mm auto;
			border: 1px #D3D3D3 solid;
			/*border-radius: 5px;*/
			background: white;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
		}

		.subpage {
			padding: 1cm;
			border: 5px red solid;
			height: 257mm;
			outline: 2cm #FFEAEA solid;
		}

		@page {
			size: F4;
			margin: 0;
		}

		@media print {

			html,
			body {
				width: 215mm;
				height: 330mm;
			}

			.page {
				margin: 0;
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
			}
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p {
			margin-block-start: .3em;
			margin-block-end: .3em;
		}

		table {
			border-collapse: collapse;
		}

		tr.border_bottom td {
			border-bottom: 3px solid black;
		}

		.container {
			width: 900px;
			margin: 0 auto;
		}

		table {
			page-break-inside: auto;
		}

		tr {
			page-break-inside: avoid;
			page-break-after: auto;
		}

		thead {
			display: table-header-group;
		}

		/* tfoot {
			display: table-footer-group
			} */
		</style>
	</head>

	<body onload="window.print()">
		<div class="container">
			<h3 align="center">LAPORAN KEGIATAN HARIAN PEGAWAI</h3>
			<h3 align="center">BADAN KEPEGAWAIAN DAERAH & DIKLAT KABUPATEN BIMA</h3>

			<table cellpadding="5" style="margin: 30px 0px">
				<tr>
					<td>NAMA</td>
					<td>:</td>
					<td><?= $r_user['fullname'] ?></td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td><?= $r_user['nip'] ?></td>
				</tr>
				<tr>
					<td>PANGKAT/GOL</td>
					<td>:</td>
					<td><?= $r_user['p_g'] ?></td>
				</tr>
				<tr>
					<td>JABATAN</td>
					<td>:</td>
					<td><?= $r_user['jabatan'] ?></td>
				</tr>
			</table>

			<table border="1" cellpadding="5" width="100%">
				<?php
				$bulan = $_GET['bulan'];
				/* mengambil data bulan satu-satu dimana data bulan di ambil dari karakter ke 4*/
				$query = $link->query("SELECT DISTINCT tgl FROM uraian_tugas WHERE id_user='1' AND tgl LIKE '___{$bulan}%' ORDER BY tgl ASC");

				if ($query->num_rows > 0) {

					while ($row = $query->fetch_object()) :
						$tgl = $row->tgl;
						// echo $tgl . '<br>';
						?>
						<tr>
							<td colspan="4" align="right">
								<?= 'Hari, Tanggal : ' . nama_hari(date('D', strtotime($tgl))) . ', ' . $tgl ?>
							</td>
						</tr>
						<tr bgcolor="skyblue">
							<td align="center"><strong>NO</strong></td>
							<td align="center"><strong>JAM</strong></td>
							<td align="center"><strong>URAIAN TUGAS</strong></td>
							<td align="center"><strong>HASIL KERJA</strong></td>
						</tr>
						<?php
						/* mengambil data uraian tugas hasil query bulan  */
						// $q2 = mysqli_query($link, "SELECT tbl_uraian_tugas.uraian_tugas, tbl_kegiatan.id, tbl_kegiatan.tanggal, tbl_kegiatan.start, tbl_kegiatan.ends, tbl_kegiatan.hasil_kerja FROM tbl_uraian_tugas INNER JOIN tbl_kegiatan ON tbl_uraian_tugas.id = tbl_kegiatan.id_uraian_tugas AND tbl_kegiatan.id_user = '{$id_user}' AND tbl_kegiatan.tanggal = '{$tgl}' ORDER BY tbl_kegiatan.tanggal, tbl_kegiatan.start ASC");
						$q2 = $link->query("SELECT mulai, akhir, uraian, hasil FROM uraian_tugas WHERE tgl='{$tgl}' AND id_user='1' ORDER BY mulai ASC");
						$no = 1;
						while ($row2 = $q2->fetch_object()) :
						// echo $no++ . ' - ' . $row2['hasil_kerja'] . '<br>';
							?>
							<tr>
								<td align="center"><?= $no++ ?></td>
								<td><?= $row2->mulai . ' - ' . $row2->akhir ?></td>
								<td><?= $row2->uraian ?></td>
								<td><?= $row2->hasil ?></td>
							</tr>
							<?php
						endwhile;
					endwhile;
				} else {
					?>
					<tr>
						<td colspan="4">Anda belum memiliki aktivitas kegiatan.</td>
					</tr>
					<?php
				}

				?>
			</table>
			<table align="right" style="margin-top: 30px" cellpadding="10">
				<tr>
					<td align="center">Atasan Langsung</td>
				</tr>
				<tr>
					<td align="center">
						<p style="margin-top: 40px; font-weight: bold;">
							<u><?= $r_user['nama_atasan'] ?></u><br>
							NIP. <?= $r_user['nip_atasan'] ?>
						</p>
					</td>
				</tr>
			</table>
		</div>
	</body>

	</html>