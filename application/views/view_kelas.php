<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-kelas">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-kelas" id="form-kelas">
					
					<label for="password">Nama Siswa</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_siswa" id="no_siswa" data-validate-field="no_siswa" class="form-control">
								<option value="">--Pilih Siswa--</option>
								
							</select>
						</div>
					</div>
					<label for="password">Nama Kelas</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="nama_kelas" name="nama_kelas" id="transaksi_utama">
								<option value="">-- Nama Kelas --</option>
								<option value="">Kelas 1- Zubair Bin Awwam </option>
								<option value="">Kelas 2- Abdurrahman Bin Auf </option>
								<option value="">Kelas 3- Bilal Bin Rabah </option>
								<option value="">Kelas 4- Amar Bin Yasir </option>
								<option value="">Kelas 5- Zaid Bin Tsabit </option>
								<option value="">Kelas 6- Nu'man Bin Basyir </option>
							</select>
						</div>
					</div>
					<label for="password">Tahun Angkatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="" data-validate-field="nama_ajaran" name="nama_ajaran" id="nama_ajaran" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-kelas">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<!-- <button type="button" class="btn btn-sm btn-primary" name="tambah_kelas" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/> -->
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>No Siswa</th>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Angkatan</th>
								<!-- <th>Aksi</th> -->

							</tr>
						    
						</thead>

					</table>

				</div>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#tahun_ajaran').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kelas/ajax_list')?>",
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
      $('#modal-form-kelas').fadeIn('slow');
      $('#modal-data-kelas').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-kelas').fadeOut('slow');
      $('#modal-data-kelas').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-kelas')[0].reset();
    }
	
	function edit(no_rincian){
		$.ajax({
			url:'<?= site_url(); ?>/kelas/data/',
			data: {'no_rincian':no_rincian},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_kelas);
				$('select[name="nama_kelas"]').val(msg.nama_kelas).change();
				// $('select[name="jenis_aset"]').val(msg.jenis_aset).change();
				// $('input[name="tahun_ajaran"]').val(msg.tahun_ajaran);
				
				$('#modal-form-kelas').fadeIn('slow');
				$('#modal-data-kelas').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_rincian){
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
				url:'<?= site_url(); ?>/kelas/hapus/',
				data: {'no_rincian':no_rincian},
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
	
	
	new window.JustValidate('.js-form-kelas', {
        rules: {
            nama_rincian: {
                required: true
            },
            transaksi_utama: {
                required: true
            },
            tahun_ajaran: {
                required: true
            }
        },
		messages: {
		  nama_rincian: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  transaksi_utama: 'Form Tidak Boleh Kosong',
		  tahun_ajaran: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('kelas/tambah'); ?>";
		}else{
			var url = "<?= site_url('kelas/ubah'); ?>";
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
