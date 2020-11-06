<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-aset">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-aset form" id="form-aset">
					<label for="password">Nama Aset</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Nama Aset" data-validate-field="nama_aset" name="nama_aset" id="nama_aset" class="form-control">
						</div>
					</div>
					<label for="password">Satuan Aset</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="satuan_aset" name="satuan_aset" id="satuan_aset">
								<option value="">-- Satuan Aset --</option>
								<option value="Buah">Buah</option>
								<option value="Lusin">Lusin</option>
							</select>
						</div>
					</div>
					<label for="password">Jenis Aset</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="jenis_aset" name="jenis_aset" id="jenis_aset">
								<option value="">-- Jenis Aset --</option>
								<option value="Perlengkapan">Perlengkapan</option>
								<option value="Kendaraan">Kendaraan</option>
							</select>
						</div>
					</div>
					<label for="password">Harga Aset</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Harga Aset" data-validate-field="harga_aset" name="harga_aset" id="harga_aset" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-aset">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_aset" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Aset</th>
								<th>Satuan Aset</th>
								<th>Jenis Aset</th>
								<th>Harga Aset</th>
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
$('#harga_aset').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('aset/ajax_list')?>",
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
      $('#modal-form-aset').fadeIn('slow');
      $('#modal-data-aset').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-aset').fadeOut('slow');
      $('#modal-data-aset').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-aset')[0].reset();
    }
	
	function edit(no_aset){
		$.ajax({
			url:'<?= site_url(); ?>/aset/data/',
			data: {'no_aset':no_aset},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_aset);
				$('input[name="nama_aset"]').val(msg.nama_aset);
				$('select[name="satuan_aset"]').val(msg.satuan_aset).change();
				$('select[name="jenis_aset"]').val(msg.jenis_aset).change();
				$('input[name="harga_aset"]').val(msg.harga_aset);
				
				$('#modal-form-aset').fadeIn('slow');
				$('#modal-data-aset').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_aset){
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
				url:'<?= site_url(); ?>/aset/hapus/',
				data: {'no_aset':no_aset},
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
	
	
	new window.JustValidate('.js-form-aset', {
        rules: {
            nama_aset: {
                required: true
            },
            penerbit_aset: {
                required: true
            },
            jenis_aset: {
                required: true
            },
            harga_aset: {
                required: true
            }
        },
		messages: {
		  nama_aset: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  satuan_aset: 'Form Tidak Boleh Kosong',
		  jenis_aset: 'Form Tidak Boleh Kosong',
		  harga_aset: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('aset/tambah'); ?>";
		}else{
			var url = "<?= site_url('aset/ubah'); ?>";
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
