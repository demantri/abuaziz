<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-user">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash')?>"></div>
                    <?php if ($this->session->flashdata('flash')) : ?>
                                
                    <?php endif; ?>

				<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-user">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive"> 
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<!-- <th>No User</th> -->
								<th>Username</th>
								<th>Password</th>
								<th class="text-center">Aksi</th> 
							</tr>
						</thead>
						<?php 
							$no = 1;
						?>
						<tbody id="show_data">
							<?php foreach ($user as $r) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $r->username ?></td>
									<td><?= md5($r->password) ?></td>
									<td>
										<a data-toggle="modal" data-target="#modal-edit-user<?= $r->id ?>" class="btn btn-warning btn-xs edit">
											<i class="fa fa-pencil"></i>
										</a>

										<a href="<?= site_url('users/hapus/'. $r->id ) ?>" class="btn btn-danger btn-xs tombol-hapus">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('user/modal-form-user');
?>
<!-- #END# Basic Examples -->
<script type="text/javascript">
	$(document).ready(function(){
	    //datatables
	    $('#table').DataTable();
	});
</script>
