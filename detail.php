<div class="row d-flex justify-content-center align-item-center mt-3 mb-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between text-uppercase bg-info">
				<h6 class="m-0 font-weight-bold text-uppercase text-white">
					Detail uraian tugas bulan <?= nama_bulan($_GET['bulan']) ?>
				</h6>
				<a href="index.php" class="btn btn-dark btn-sm">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
			</div>
			<div class="card-body">
				<?php
				$bulan = $_GET['bulan'];
				/* mengambil data bulan satu-satu dimana data bulan di ambil dari karakter ke 4*/
				$query = $link->query("SELECT DISTINCT tgl FROM uraian_tugas WHERE id_user='{$id_user}' AND tgl LIKE '___{$bulan}%' ORDER BY tgl ASC");

				if ($query->num_rows > 0) {

					while ($row = $query->fetch_object()) :
						$tgl = $row->tgl;
						?>
						<div class="badge badge-pill badge-success text-uppercase mb-2 mt-2">
							<?= nama_hari(date('D', strtotime($tgl))) . ', ' . $tgl ?>
						</div>
						<?php
						$q2 = $link->query("SELECT id, mulai, akhir, uraian, hasil FROM uraian_tugas WHERE tgl='{$tgl}' AND id_user='{$id_user}' ORDER BY mulai ASC");
						$no = 1;
						while ($row2 = $q2->fetch_object()) :
							?>
							<div class="text-muted mt-1" style="margin-left:20px;">
								<span class="text-info">
									<i class="fa fa-clock"></i> <?= $row2->mulai . ' - ' . $row2->akhir ?>
									</span><?= $row2->uraian ?>
									<a href="#" class="badge badge-pill badge-dark text-uppercase view" data-toggle="tooltip" data-placement="top" title="lihat" id="<?= $row2->id ?>">
										<i class="fa fa-eye"></i>
									</a>
									<a href="#" class="badge badge-pill badge-info text-uppercase edit" data-toggle="tooltip" data-placement="top" title="edit" id="<?= $row2->id ?>">
										<i class="fa fa-edit"></i>
									</a>
									<a href="#" class="badge badge-pill badge-danger text-uppercase delete" data-toggle="tooltip" data-placement="top" id="158" title="hapus">
										<i class="fa fa-trash"></i>
									</a>
								</div>
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
				</div>
			</div>
		</div>
	</div>
</div>