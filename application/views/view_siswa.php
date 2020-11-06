<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-siswa">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-siswa form" id="form-siswa">
					<label for="password">NIS</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="NIS" data-validate-field="nis" name="nis" id="nis" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">Nama Siswa</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Siswa" data-validate-field="nama_siswa" name="nama_siswa" id="nama_siswa" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">Alamat Siswa</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Alamat Siswa" data-validate-field="alamat_siswa" name="alamat_siswa" id="alamat_siswa" class="form-control">
						</div>
					</div>
<!-- 					<label for="password">No Telepon</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="No Telepon Pendaftaran" data-validate-field="no_telepon" name="no_telepon" id="no_telepon" class="form-control">
						</div>
					</div> -->
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
					<label for="password">Tanggal Lahir</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Tanggal Lahir" data-validate-field="tanggal_lahir" name="tanggal_lahir" id="tanggal_lahir" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">Tempat Lahir</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Tempat Lahir" data-validate-field="tempat_lahir" name="tempat_lahir" id="tempat_lahir" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">Nama Ayah</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Ayah" data-validate-field="nama_ayah" name="nama_ayah" id="nama_ayah" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">Nama Ibu</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Ibu" data-validate-field="nama_ibu" name="nama_ibu" id="nama_ibu" class="form-control" readonly="">
						</div>
					</div>
					<label for="password">No Telepon Orang Tua (Ayah/Ibu)</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="No Telepon Orang Tua" data-validate-field="no_telepon_ortu" name="no_telepon_ortu" id="no_telepon_ortu" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-siswa">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<!--<button type="button" class="btn btn-sm btn-primary" name="tambah_siswa" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				--><br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Daftar</th>
								<th>NIS</th>
								<th>Nama Siswa</th>
								<th>Alamat Siswa</th>
								<!-- <th>No Telepon</th> -->
								<th>Jenis Kelamin</th>
								<th>TTL</th>
								<th>Nama Ayah</th>
								<th>Nama Ibu</th>
								<th>No Telp</th>
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
            "url": "<?php echo site_url('siswa/ajax_list')?>",
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

	$('input[name="tanggal_lahir"]').datetimepicker({
        language:  'id',
        format:'yyyy-mm-dd',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	
	function tambah() {
      $('#modal-form-siswa').fadeIn('slow');
      $('#modal-data-siswa').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-siswa').fadeOut('slow');
      $('#modal-data-siswa').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-siswa')[0].reset();
    }
	
	function edit(no_siswa){
		$.ajax({
			url:'<?= site_url(); ?>/siswa/data/',
			data: {'no_siswa':no_siswa},
            type:'POST',
			dataType:'JSON',

			success:function(msg){
				$('input[name="aksi"]').val(msg.no_siswa);
				$('input[name="nis"]').val(msg.nis);
				$('input[name="nama_siswa"]').val(msg.nama_siswa);
				$('input[name="alamat_siswa"]').val(msg.alamat_siswa);
				//$('input[name="no_telepon"]').val(msg.no_telepon);
				$('select[name="jenis_kelamin"]').val(msg.jenis_kelamin).change();
				$('input[name="tanggal_lahir"]').val(msg.tanggal_lahir);
				$('input[name="tempat_lahir"]').val(msg.tempat_lahir);
				$('input[name="nama_ayah"]').val(msg.nama_ayah);
				$('input[name="nama_ibu"]').val(msg.nama_ibu);
				$('input[name="no_telepon_ortu"]').val(msg.no_telepon_ortu);
				
				$('#modal-form-siswa').fadeIn('slow');
				$('#modal-data-siswa').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}


	
	function hapus(no_siswa){
		Swal.fire({
		  title: 'Hapus Data Ini?',
		  text: "Ya Hapus!",
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
				url:'<?= site_url(); ?>/siswa/hapus/',
				data: {'no_siswa':no_siswa},
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
	
	
	new window.JustValidate('.js-form-siswa', {
        rules: {
        	nis: {
                required: true,
                max_length: 13
            },
            nama_siswa: {
                required: true
            },
            alamat_siswa: {
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
		  nama_siswa: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  nis: 'Harus 13 digit',
		  alamat_siswa: 'Form Tidak Boleh Kosong',
		  no_telepon: 'Form Tidak Boleh Kosong',
		  jenis_kelamin: 'Form Tidak Boleh Kosong',
		  tanggal_lahir: 'Form Tidak Boleh Kosong',
		  tempat_lahir: 'Form Tidak Boleh Kosong',
		  nama_ortu: 'Form Tidak Boleh Kosong',
		  no_telepon_ortu: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('siswa/tambah'); ?>";
		}else{
			var url = "<?= site_url('siswa/ubah'); ?>";
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
