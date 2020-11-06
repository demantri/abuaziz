<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-pegawai">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-pegawai form" id="form-pegawai">
					<label for="password">NIP</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="NIP" data-validate-field="nip" name="nip" id="nip" class="form-control">
						</div>
					</div>
					<label for="password">Nama Pegawai</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Pegawai" data-validate-field="nama_pegawai" name="nama_pegawai" id="nama_pegawai" class="form-control">
						</div>
					</div>
					<label for="password">Alamat Pegawai</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Alamat Pegawai" data-validate-field="alamat_pegawai" name="alamat_pegawai" id="alamat_pegawai" class="form-control">
						</div>
					</div>
					<label for="password">No Telepon</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="No Telepon Pegawai" data-validate-field="no_telepon" name="no_telepon" id="no_telepon" class="form-control">
						</div>
					</div>
					<label for="password">Jenis Kelamin</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin">
								<option value="">-- Jenis Kelamin --</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-pegawai">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_pegawai" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Nama Pegawai</th>
								<th>Alamat Pegawai</th>
								<th>No Telepon</th>
								<th>Jenis Kelamin</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pegawai/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,-1 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });
	// table.ajax.reload();  //just reload table
});

	function tambah() {
      $('#modal-form-pegawai').fadeIn('slow');
      $('#modal-data-pegawai').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-pegawai').fadeOut('slow');
      $('#modal-data-pegawai').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-pegawai')[0].reset();
    }
	
	function edit(no_pegawai){
		$.ajax({
			url:'<?= site_url(); ?>/pegawai/data/',
			data: {'no_pegawai':no_pegawai},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_pegawai);
				$('input[name="nip"]').val(msg.nip);
				$('input[name="nama_pegawai"]').val(msg.nama_pegawai);
				$('input[name="alamat_pegawai"]').val(msg.alamat_pegawai);
				$('input[name="no_telepon"]').val(msg.no_telepon);
				$('select[name="jenis_kelamin"]').val(msg.jenis_kelamin).change();
				
				$('#modal-form-pegawai').fadeIn('slow');
				$('#modal-data-pegawai').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_pegawai){
		Swal.fire({
		  title: 'Hapus Data Ini?',
		  text: "Kalo Udah Dihapus Ga Akan Balik Lagi Loh!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Hapus!',
		  cancelButtonText: 'Jangan!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.value) {
			$.ajax({
				url:'<?= site_url(); ?>/pegawai/hapus/',
				data: {'no_pegawai':no_pegawai},
				type:'POST',
				dataType:'JSON',
				success: function(response) {
					if(response.status =="benar") {
						Swal.fire(
						  'Terhapus!',
						  'Data Telah Berhasil Dihapus',
						  'success'
						)
						table.ajax.reload();  //just reload table
						batal();  //just reload table
					} else if(response.status =="salah"){
						Swal.fire(
						  'Gagal!',
						  'Data Gagal Untuk Dihapus!',
						  'error'
						)
					} else if(response.status =="blokir"){
						Swal.fire(
						  'Ups!',
						  'Anda Tidak Memiliki Hak Akses!',
						  'warning'
						)
					}
				}
			});
		  }else{
			Swal.fire(
			  'Batal',
			  'Data Batal Untuk Dihapus',
			  'warning'
			)
		  }
		});
	}
	
	
	new window.JustValidate('.js-form-pegawai', {
        rules: {
            nama_pegawai: {
                required: true
            },
            alamat_pegawai: {
                required: true
            },
            no_telepon: {
                required: true
            },
            jenis_kelamin: {
                required: true
            }
        },
		messages: {
		  nama_pegawai: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  nip: 'Form Tidak Boleh Kosong',
		  alamat_pegawai: 'Form Tidak Boleh Kosong',
		  no_telepon: 'Form Tidak Boleh Kosong',
		  jenis_kelamin: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('pegawai/tambah'); ?>";
		}else{
			var url = "<?= site_url('pegawai/ubah'); ?>";
		}
            $.ajax({
			  url: url,
			  method: "POST",
			  data: values,
			  dataType: "JSON",
			  success: function(response) {
				if(response.status =="benar") {
					$.toast({
						heading: 'Info',
						text: 'Data Berhasil Ditambah!',
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'info'
					});
					table.ajax.reload();  //just reload table
					batal();  //just reload table
				} else if(response.status =="salah"){
					$.toast({
						heading: 'Bahaya',
						text: 'Data Gagal Ditambah!',
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'error'
					});
				} else if(response.status =="blokir"){
					$.toast({
						heading: 'Ups',
						text: 'Anda Tidak Memiliki Akses!',
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'error'
					});
				}
			  }
			});
        },
    });
</script>
