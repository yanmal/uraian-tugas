<?php

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="dist/vendor/fontawesome-free/css/all.min.css" />
	<link rel="stylesheet" href="dist/css/sb-admin-2.css" />
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->

	<title>Toolkit Uraian Tugas | Register</title>
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
		<div class="row justify-content-center mb-3">
			<div class="col-md-8">
				<div class="card shadow">
					<div class="card-header"><strong>FORM REGISTRASI AKUN</strong></div>
					<div class="card-body">
						<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
							<div class="form-group">
								<label for="nip">NIP</label>
								<input type="text" name="nip" id="nip" class="form-control" placeholder="masukkan nip" required />
							</div>
							<div class="form-group">
								<label for="fullname">Fullname</label>
								<input type="text" name="fullname" id="fullname" class="form-control" placeholder="masukkan fullname" required />
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" id="username" class="form-control" placeholder="masukkan username" required />
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="masukkan password" required />
							</div>
							<hr>
							<input type="submit" name="simpan" class="btn btn-primary" value="Register">
							<a href="index.php" class="btn btn-secondary">Batal</a>
						</form>
					</div>
					<div class="card-footer"></div>
					<?php 
					if (isset($_POST['simpan'])) {
						require 'config.php';

						$nip = mysqli_real_escape_string($link, $_POST['nip']);
						$fullname = mysqli_real_escape_string($link, $_POST['fullname']);
						$username = mysqli_real_escape_string($link, strtolower($_POST['username']));
						$password = mysqli_real_escape_string($link, password_hash($_POST['password'], PASSWORD_DEFAULT));

						$query = mysqli_query($link, "INSERT INTO tbl_user (nip, fullname, username, password) VALUES ('{$nip}', '{$fullname}', '{$username}', '{$password}')") or die(mysqli_error($link));
						if ($query) {
							echo "<script>Swal.fire('Sukses!','Registrasi berhasil di kirim','success');</script>";
						} else {
							echo "<script>Swal.fire('Error!','Registrasi gagal di kirim','error');</script>";
						}
					}
					?>
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
</body>
</html>