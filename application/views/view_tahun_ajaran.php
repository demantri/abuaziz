<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-tahun_ajaran">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-tahun_ajaran" id="form-tahun_ajaran">
					<label for="password">Tahun Angkatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="" data-validate-field="nama_ajaran" name="nama_ajaran" id="nama_ajaran" class="form-control">
						</div>
					</div>
					<label for="password">Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Biaya" data-validate-field="harga_ajaran" name="harga_ajaran" id="harga_ajaran" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-tahun_ajaran">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_tahun_ajaran" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tahun Angkatan</th>
								<!-- <th>Jenis ajaran</th> -->
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
$('#harga_ajaran').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('tahun_ajaran/ajax_list')?>",
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
      $('#modal-form-tahun_ajaran').fadeIn('slow');
      $('#modal-data-tahun_ajaran').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-tahun_ajaran').fadeOut('slow');
      $('#modal-data-tahun_ajaran').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-tahun_ajaran')[0].reset();
    }
	
	function edit(no){
		$.ajax({
			url:'<?= site_url(); ?>/tahun_ajaran/data/',
			data: {'no':no},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no);
				$('input[name="nama_ajaran"]').val(msg.nama_ajaran);
				//$('select[name="transaksi_utama"]').val(msg.transaksi_utama).change();
				// $('select[name="jenis_aset"]').val(msg.jenis_aset).change();
				$('input[name="harga_ajaran"]').val(msg.harga_ajaran);
				
				$('#modal-form-tahun_ajaran').fadeIn('slow');
				$('#modal-data-tahun_ajaran').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no){
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
				url:'<?= site_url(); ?>/tahun_ajaran/hapus/',
				data: {'no':no},
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
	
	
	new window.JustValidate('.js-form-tahun_ajaran', {
        rules: {
            nama_ajaran: {
                required: true
            },
            harga_ajaran: {
                required: true
            }
        },
		messages: {
		  nama_ajaran: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  harga_ajaran: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('tahun_ajaran/tambah'); ?>";
		}else{
			var url = "<?= site_url('tahun_ajaran/ubah'); ?>";
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
