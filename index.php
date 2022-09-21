<?php
// ob_start();
// ob_clean();
session_start();
// $waktu = '31-05-2021';

if (!isset($_SESSION['login'])) {
	header('Location: login.php');
	exit;
}
require_once('config.php');
$id_user = $_SESSION['user_id'];
$result = mysqli_query($link, "SELECT * FROM tbl_user WHERE id = '{$id_user}'");
$row = mysqli_fetch_assoc($result);

function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

$client = $_SERVER['HTTP_USER_AGENT'];

// $_SESSION['sukses'] = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="dist/vendor/fontawesome-free/css/all.min.css" />
	<link rel="stylesheet" href="dist/css/sb-admin-2.css" />
	<link rel="stylesheet" href="dist/vendor/datatables/dataTables.bootstrap4.css" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->

	<title>Toolkit Uraian Tugas</title>
</head>
<body>
	<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		<div class="container">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="?p=profile">Profile</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="logout.php" class="btn btn-danger">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<?php

		// echo $_SESSION['sukses'];
		// echo "<script>Swal.fire('Sukses!','Data berhasil di ubah','success');</script>";
		if (isset($_SESSION['sukses'])) {
			if ($_SESSION['sukses'] === true) {
				echo "<script>Swal.fire('Sukses!','Data berhasil di ubah','success');</script>";
				unset($_SESSION['sukses']);
			} else {
				echo "<script>Swal.fire('Error!','Data gagal di ubah','error');</script>";
				unset($_SESSION['sukses']);
			}
		}

		if (isset($_GET['p'])) :
			$page = $_GET['p'] . '.php';

			if (file_exists($page)) :
				include $page;
			else:
				?>
				<!-- 404 Error Text -->
				<div class="text-center">
					<div class="glitch mx-auto" data-text="404">404</div>
					<p class="lead text-gray-800 mb-5">Page Not Found</p>
					<p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
					<a href="index.php">&larr; Back to Dashboard</a>
				</div>
				<?php
			endif;
		else:
			?>
			<div class="row">
				<!-- Earnings (Monthly) Card Example -->
				<div class="col-xl-12 col-md-12 mb-4">
					<!-- <h1 class="h3 mb-2 text-uppercase text-gray-800 mb-4">List uraian tugas</h1> -->
					<div class="card shadow mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between text-uppercase">
							<!-- <a href="index.php" class="btn btn-dark btn-sm">
								<i class="fas fa-arrow-left"></i>
							</a> -->
							<h6 class="m-0 font-weight-bold text-uppercase">List uraian tugas</h6>
							<a href="?p=create" class="btn btn-primary btn-sm">
								<i class="fas fa-file-signature"></i> Buat Uraian tugas
							</a>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="myTable">
									<thead>
										<tr>
											<th width="100px">#</th>
											<th width="550px">BULAN</th>
											<th>AKSI</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$sql = $link->query("SELECT DISTINCT SUBSTRING(tgl, 4, 2) AS bulan FROM uraian_tugas WHERE id_user='{$id_user}'");
										if ($sql->num_rows > 0) {
											while ($row = $sql->fetch_object()) :
												?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= strtoupper(nama_bulan($row->bulan)) ?></td>
													<td>
														<a href="cetak.php?bulan=<?= $row->bulan ?>" target="_blank" class="btn btn-sm btn-dark" title="cetak" data-toggle="tooltip" data-placement="top">
															<i class="fa fa-print"></i> Cetak
														</a>
														<a href="?p=detail&&bulan=<?= $row->bulan ?>" class="btn btn-sm btn-info">
															<i class="fa fa-eye"></i> Lihat Detail
														</a>
														<a href="?p=hapus&&bulan=<?= $row->bulan ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">
															<i class="fa fa-trash"></i> Hapus
														</a>
													</td>
												</tr>
												<?php
											endwhile;
										} 
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		endif;
		?>
	</div>

	<!-- Logout Modal-->
	<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-uppercase" id="modalTitle"></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body" id="showData"></div>
				<div class="modal-footer">
					<button class="btn btn-secondary btn-block" type="button" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<div class="copyright">
						© 2022 <a href="www.bkd.bimakab.go.id" target="_blank">BKD & Diklat Kab. Bima - Bid. Kesra & Informasi Kepegawaian</a>. { Make with <i class="ni ni-favourite-28 text-danger"></i> by YANMAL-PC }
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<!-- bootstrap core -->
	<script src="dist/vendor/jquery/jquery.js"></script>
	<script src="dist/vendor/bootstrap/js/bootstrap.js"></script>
	<!-- core plugin js -->
	<script src="dist/vendor/jquery-easing/jquery.easing.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="dist/js/sb-admin-2.js"></script>
	<script src="dist/vendor/datatables/jquery.dataTables.js"></script>
	<script src="dist/vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
	<script>
		$(document).ready(function() {
			// $('[data-toggle="tooltip"]').tooltip();
			$('#myTable').DataTable();
			$('.date').datepicker({
				multidate: true,
				format: 'dd-mm-yyyy'
			});
			$(document).on('click', '.view', function(e) {
				e.preventDefault();
				let id_keg = $(this).attr('id');
				$.ajax({
					url: 'detail_tugas.php',
					method: 'POST',
					data : {id_keg: id_keg},
					beforeSend: function () {
						$('#showData').text('Loading...');
						$('#modalStatus').modal('show');
						$('#modalTitle').text('Form Detail Uraian Tugas');
					},
					success: function(data) {
						// console.log(data);
						$('#showData').html(data);
					}
				});
			});

			$(document).on('click', '.edit', function(e) {
				e.preventDefault();
				let id_keg = $(this).attr('id');
				let url = window.location.href;
				$.ajax({
					url: 'edit_tugas.php',
					method: 'POST',
					data : {id_keg: id_keg, url: url},
					beforeSend: function () {
						$('#showData').text('Loading...');
						$('#modalStatus').modal('show');
						$('#modalTitle').text('Form Edit Uraian Tugas');
					},
					success: function(data) {
						// console.log(data);
						$('#showData').html(data);
					}
				});
			});

			$('#bahan_kerja').click(function() {
				$('#data_bahan_kerja').append(`
					<div class="row items mb-3">
					<div class="col-md-2">
					<input type="time" name="start[]" placeholder="start" class="form-control" required="" />
					</div>
					<div class="col-md-2">
					<input type="time" name="end[]" placeholder="end" class="form-control" required="" />
					</div>
					<div class="col-md-4">
					<input type="text" name="tugas[]" placeholder="uraian tugas" class="form-control" required="" />
					</div>
					<div class="col-md-3">
					<input type="text" name="hasil[]" placeholder="hasil kerja" class="form-control" required="" />
					</div>
					<div class="col-md-1">
					<button class="btn btn-danger" onclick="$(this).parents('.items').remove()" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
					</div>
					</div>`);
			});
			// $('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>
</html>