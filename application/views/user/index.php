<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-user">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-user form" id="form-user">	
					<label for="email_address">No Akun</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="No Akun" data-validate-field="no_akun" name="no_akun" id="no_akun" class="form-control">
						</div>
					</div>
					<label for="password">Nama Akun</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Akun" data-validate-field="nama_akun" name="nama_akun" id="nama_akun" class="form-control">
						</div>
					</div>
					<label for="password">Jenis Akun</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="jenis_akun" name="jenis_akun" id="jenis_akun">
								<option value="">-- Jenis Akun --</option>
								<option value="aktiva">Aktiva</option>
								<option value="pasiva">Pasiva</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" name="simpan" class="btn btn-sm btn-default" onclick="batal()">Batal</button>
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" >Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-user">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
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
<!-- <script type="text/javascript">
	$(document).ready(function(){
	    //datatables
	    $('#table').DataTable({
	    	"ajax": "<?= base_url('users/list_data') ?>"
	    });
	});
</script> -->
