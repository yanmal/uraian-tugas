<?php


session_start();
// $waktu = '31-05-2021';

if (!isset($_SESSION['auth'])) {
	header('Location: auth.php');
	exit;
}

require_once "../config.php";
$id_user = $_SESSION['user_id'];
$result = mysqli_query($link, "SELECT * FROM tbl_user WHERE id = '{$id_user}'");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Data Kartu</title>
	<link rel="stylesheet" href="../dist/vendor/fontawesome-free/css/all.min.css" />
	<link rel="stylesheet" href="../dist/css/sb-admin-2.css" />
	<link rel="stylesheet" href="../dist/vendor/datatables/dataTables.bootstrap4.css" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->

	<title>Admins Page</title>
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
					<li class="nav-item <?= (!isset($_GET['page'])) ? 'active' : '' ?>">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item <?= ($_GET['page'] == 'users') ? 'active' : '' ?>">
						<a class="nav-link" href="?page=users">Users</span></a>
					</li>
					<li class="nav-item <?= ($_GET['page'] == 'logs') ? 'active' : '' ?>">
						<a class="nav-link" href="?page=logs">Logs</span></a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Logout</span></a>
					</li>
				</ul>
				
			</div>
		</div>
	</nav>
	<div class="container">
		<?php
		if (isset($_GET['page'])) :
			$page = $_GET['page'] . '.php';

			if (file_exists($page)) :
				include $page;
			else:
				?>
				<!-- 404 Error Text -->
				<div class="text-center">
					<div class="glitch mx-auto" data-text="404"><h1>404</h1></div>
					<p class="lead text-gray-800 mb-5">Page Not Found</p>
					<p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
					<a href="index.php">&larr; Back to Dashboard</a>
				</div>
				<?php
			endif;
		else:
			include 'home.php';
		endif;
		?>
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

	<!-- bootstrap core -->
	<script src="../dist/vendor/jquery/jquery.js"></script>
	<script src="../dist/vendor/bootstrap/js/bootstrap.js"></script>
	<!-- core plugin js -->
	<script src="../dist/vendor/jquery-easing/jquery.easing.js"></script>
	<script src="../dist/js/sb-admin-2.js"></script>
	<script src="../dist/vendor/datatables/jquery.dataTables.js"></script>
	<script src="../dist/vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
			$('#myTable').DataTable();
		})
	</script>
</body>
</html>