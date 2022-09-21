<?php 
if (isset($_SESSION['sukses'])) {
	if ($_SESSION['sukses'] === true) {
		echo "<script>Swal.fire('Sukses!','Data profil berhasil di perbaharui','success');</script>";
		unset($_SESSION['sukses']);
	} else {
		echo "<script>Swal.fire('Error!','Data gagal di perbaharui','error');</script>";
		unset($_SESSION['sukses']);
	}
}

if ($_SERVER['REQUEST_METHOD'] === "POST") :
	$nip = htmlspecialchars($_POST['nip']);
	$fullname = htmlspecialchars($_POST['fullname']);
	$jabatan = htmlspecialchars($_POST['jabatan']);
	$gol = htmlspecialchars($_POST['gol']);
	$nip_atasan = htmlspecialchars($_POST['nip_atasan']);
	$nama_atasan = htmlspecialchars($_POST['nama_atasan']);
					// logs
	$ip = get_client_ip();
	$os = "OS: ".explode(";",$client)[1]." . Browser: ".end(explode(" ",$client));
	$aksi = "Update profile";

	$insert = $link->query("UPDATE tbl_user SET nip = '{$nip}', fullname = '{$fullname}', jabatan = '{$jabatan}', p_g = '{$gol}', nip_atasan = '{$nip_atasan}', nama_atasan = '{$nama_atasan}' WHERE id = '{$id_user}'") or die ($link->error);

	if ($insert) :
		$logs = $link->query("INSERT INTO logs (aksi, os, ip, id_user) VALUES ('{$aksi}', '{$os}', '{$ip}', '{$id_user}')");
		$_SESSION['sukses'] = true;
		header('Location: index.php?p=profile');
	else:
		// echo "<script>Swal.fire('ERROR!','Maaf, Data gagal di perbaharui','error');</script>";
		$_SESSION['sukses'] = false;
		header('Location: index.php?page=edit_profile');
	endif;
endif;
?>
<div class="row d-flex justify-content-center align-item-center mt-3 mb-3">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between text-uppercase">
				<h6 class="m-0 font-weight-bold text-uppercase">form tambah uraian tugas</h6>
				<a href="index.php" class="btn btn-dark btn-sm">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
			</div>
			<div class="card-body">
				<?php
				$user = $link->query("SELECT * FROM tbl_user WHERE id = '{$id_user}'");
				$row = $user->fetch_object();
				?>
				<form action="<?= $_SERVER['PHP_SELF'] ?>?p=profile" method="POST">
					<div class="form-group">
						<label label="nip">NIP</label>
						<input type="text" name="nip" class="form-control" value="<?= $row->nip ?>" required />
					</div>
					<div class="form-group">
						<label label="fullname">Nama Lengkap</label>
						<input type="text" name="fullname" class="form-control" value="<?= $row->fullname ?>" required />
					</div>
					<div class="form-group">
						<label label="username">Username</label>
						<input type="text" name="username" class="form-control" value="<?= $row->username ?>" readonly />
					</div>
					<div class="form-group">
						<label label="jabatan">Jabatan</label>
						<input type="text" name="jabatan" class="form-control" value="<?= $row->jabatan ?>" placeholder="masukkan jabatan" required />
					</div>
					<div class="form-group">
						<label label="gol">Pangkat/Gol</label>
						<input type="text" name="gol" class="form-control" value="<?= $row->p_g ?>" placeholder="masukkan pangkat/gol" required />
					</div>
					<div class="form-group">
						<label label="nip_atasan">NIP Atasan</label>
						<input type="text" name="nip_atasan" class="form-control" value="<?= $row->nip_atasan ?>" placeholder="masukkan nip atasan" required />
					</div>
					<div class="form-group">
						<label label="nama_atasan">Nama Atasan</label>
						<input type="text" name="nama_atasan" class="form-control" value="<?= $row->nama_atasan ?>" placeholder="masukkan nama atasan" required />
					</div>
					<hr/> 
					<button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
					<a href="index.php" class="btn btn-dark">Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>