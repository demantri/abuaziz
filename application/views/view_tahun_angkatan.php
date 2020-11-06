<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-tahun_angkatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-tahun_angkatan" id="form-tahun_angkatan">
					<label for="password">Tahun angkatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Tahun angkatan" data-validate-field="nama_angkatan" name="nama_angkatan" id="nama_angkatan" class="form-control">
						</div>
					</div>
					<label for="password">Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Biaya" data-validate-field="harga_angkatan" name="harga_angkatan" id="harga_angkatan" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-tahun_angkatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_tahun_angkatan" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama angkatan</th>
								<!-- <th>Jenis angkatan</th> -->
								<th>Biaya</th>
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
$('#harga_angkatan').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('tahun_angkatan/ajax_list')?>",
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
      $('#modal-form-tahun_angkatan').fadeIn('slow');
      $('#modal-data-tahun_angkatan').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-tahun_angkatan').fadeOut('slow');
      $('#modal-data-tahun_angkatan').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-tahun_angkatan')[0].reset();
    }
	
	function edit(no_angkatan){
		$.ajax({
			url:'<?= site_url(); ?>/tahun_angkatan/data/',
			data: {'no_angkatan':no_angkatan},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_angkatan);
				$('input[name="nama_angkatan"]').val(msg.nama_angkatan);
				//$('select[name="transaksi_utama"]').val(msg.transaksi_utama).change();
				// $('select[name="jenis_aset"]').val(msg.jenis_aset).change();
				$('input[name="harga_angkatan"]').val(msg.harga_angkatan);
				
				$('#modal-form-tahun_angkatan').fadeIn('slow');
				$('#modal-data-tahun_angkatan').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_angkatan){
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
				url:'<?= site_url(); ?>/tahun_angkatan/hapus/',
				data: {'no_angkatan':no_angkatan},
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
	
	
	new window.JustValidate('.js-form-tahun_angkatan', {
        rules: {
            nama_angkatan: {
                required: true
            },
            harga_angkatan: {
                required: true
            }
        },
		messages: {
		  nama_angkatan: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  harga_angkatan: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('tahun_angkatan/tambah'); ?>";
		}else{
			var url = "<?= site_url('tahun_angkatan/ubah'); ?>";
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
