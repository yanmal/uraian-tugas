<div class="row d-flex justify-content-center align-item-center mt-3 mb-5">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h6 class="m-0 font-weight-bold text-uppercase">Form Tambah User</h6>
			</div>
			<form action="<?= $_SERVER['PHP_SELF'] ?>?page=add_users" method="POST">
				<div class="card-body">
					<div class="form-group">
						<label for="nip">N I P *</label>
						<input type="text" name="nip" id="nip" maxlength="18" class="form-control" placeholder="nip" required />
					</div>
					<div class="form-group">
						<label for="fullname">Fullname *</label>
						<input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname" required />
					</div>
					<div class="form-group">
						<label for="username">Username *</label>
						<input type="username" name="username" id="username" class="form-control" placeholder="username" required />
					</div>
					<div class="form-group">
						<label for="password">Password *</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="******" required />
					</div>
					<div class="form-group">
						<label for="level">Level *</label>
						<select name="level" id="level" class="form-control" required>
							<option>Level</option>
							<option value="kabid">Kabid</option>
							<option value="kasubid">Kasubid</option>
							<option value="staf">Staf</option>
						</select>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Simpan Data</button>
					<a href="index.php" class="btn btn-dark">
						Batal
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") :
	$nip 		= htmlspecialchars($_POST['nip']);
	$fullname 	= htmlspecialchars($_POST['fullname']);
	$username 	= htmlspecialchars($_POST['username']);
	$password 	= htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
	$level 		= htmlspecialchars($_POST['level']);

	$insert = $link->query("INSERT INTO tbl_user (nip, fullname, username, password, level) VALUES ('{$nip}', '{$fullname}', '{$username}', '{$password}', '{$level}')");

	if ($insert) {
		echo "<script>Swal.fire('SUKSES!','User baru berhasil ditambahkan','success');</script>";
	} else {
		echo "<script>Swal.fire('ERROR!','Maaf, User baru gagal ditambahkan','error');</script>";
	}

endif;

?>