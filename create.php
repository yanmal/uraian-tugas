<div class="row d-flex justify-content-center align-item-center mt-3 mb-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between text-uppercase">
				<h6 class="m-0 font-weight-bold text-uppercase">form tambah uraian tugas</h6>
				<a href="index.php" class="btn btn-dark btn-sm">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
				<!-- <input type="button" id="bahan_kerja" class="btn btn-sm btn-success" value="+ Tambah"> -->
			</div>
			<div class="card-body">
				<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?p=create'; ?>" method="POST">
					<div class="row mt-2">
						<div class="col-md-12">
							<label>Pilih Tanggal</label>
							<input type="text" name="tgl" class="form-control date" placeholder="Pilih tanggal" required="" autocomplete="off" />
						</div>
					</div>
					<div id="data_bahan_kerja">
						<div class="row mt-2 mb-3">
							<div class="col-md-2">
								<label for="start">Start</label>
								<input type="time" id="start" name="start[]" placeholder="start" class="form-control" required="" />
							</div>
							<div class="col-md-2">
								<label for="end">End</label>
								<input type="time" name="end[]" id="end" placeholder="end" class="form-control" required="" />
							</div>
							<div class="col-md-4">
								<label for="uraian">Uraian Tugas</label>
								<input type="text" id="uraian" name="tugas[]" placeholder="uraian tugas" class="form-control" required="" />
							</div>
							<div class="col-md-3">
								<label for="hasil">Hasil Kerja</label>
								<input type="text" name="hasil[]" placeholder="hasil kerja" class="form-control" required="" />
							</div>
							<div class="col-md-1">
								<label for="hasil">Tambah</label>
								<button type="button" class="btn btn-success" id="bahan_kerja">
									<i class="fa fa-plus-circle"></i>
								</button>
							</div>
						</div>
					</div>
					<hr />
					<button type="submit" class="btn btn-primary">Simpan Data</button>
					<a href="index.php" class="btn btn-dark">
						Batal
					</a>
				</form>

				<?php

				if ($_SERVER['REQUEST_METHOD'] == "POST") {
					/* mengubah data inputan tgl menjadi array dgn fungsi exlpode dimana pemisahnya koma */
					$arr_tgl = explode(',', $_POST['tgl']);
					$start 	= $_POST['start'];
					$end 	= $_POST['end'];
					$tugas 	= $_POST['tugas'];
					$hasil 	= $_POST['hasil'];
					$aksi = "tambah uraian tugas";
					$ip = get_client_ip();
					$os = "OS: ".explode(";",$client)[1]." . Browser: ".end(explode(" ",$client));

					require_once "config.php";

					foreach ($arr_tgl as $value) {
						// echo $value . "<br/>";
						/* melakukan perulangan utk mengambil data uraian tugas */
						for ($i=0; $i < count($start); $i++) { 
							/* simpan data uraian tugas ke DB */
							// echo "<ul>";
							for ($i=0; $i < count($start); $i++) { 
								// echo "<li>Jam = ". $start[$i] ." - ". $end[$i] . " | uraian tugas = ". $tugas[$i]." | Hasil Kerja = " . $hasil[$i] . " | Tanggal = " . $value;
								$insert = $link->query("INSERT INTO uraian_tugas (mulai, akhir, uraian, hasil, tgl, id_user) VALUES ('{$start[$i]}', '{$end[$i]}', '{$tugas[$i]}', '{$hasil[$i]}', '{$value}', '{$id_user}')");
							}
							// echo "</ul>";
						}
					}
					if ($insert) {
						$logs = $link->query("INSERT INTO logs (aksi, os, ip, id_user) VALUES ('{$aksi}', '{$os}', '{$ip}', '{$id_user}')");
						echo "<script>Swal.fire('SUKSES!','Data uraian tugas berhasil di buat','success');</script>";
					} else {
						echo "<script>Swal.fire('ERROR!','Maaf, Data gagal di simpan','error');</script>";
					}
				}
				?>
			</div>
		</div>
	</div>
</div>