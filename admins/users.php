<div class="row d-flex justify-content-center align-item-center mt-3 mb-3">
	<div class="col-md-10">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between text-uppercase">
				<h6 class="m-0 font-weight-bold text-uppercase"> List data users</h6>
				<a href="?page=add_users" class="btn btn-primary btn-sm">
					<i class="fa fa-plus-circle"></i> Tambah Users
				</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover" id="myTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Fullname</th>
								<th>Username</th>
								<th width="250px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$query = $link->query("SELECT * FROM tbl_user ORDER BY fullname ASC");
							while ($row = $query->fetch_object()) :
								?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row->fullname ?></td>
									<td><?= $row->username ?></td>
									<td>
										<a href="#" id="<?= $row->id ?>" class="btn btn-primary lihat">
											Lihat
										</a>
										<a href="?page=edit&&id=<?= $row->id ?>" class="btn btn-info">
											Edit
										</a>
										<a href="?page=hapus&&id=<?= $row->id ?>" class="btn btn-danger">
											Hapus
										</a>
									</td>
								</tr>
								<?php
							endwhile;
							?>
						</tbody>
					</div>
				</table>
			</div>
		</div>
	</div>
</div>