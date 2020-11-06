<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-rincian_biaya">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-rincian_biaya" id="form-rincian_biaya">
					<label for="password">Nama Rincian Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Nama Rincian Biaya" data-validate-field="nama_rincian" name="nama_rincian" id="nama_rincian" class="form-control">
						</div>
					</div>
					<label for="password">Transaksi Utama</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" data-validate-field="transaksi_utama" name="transaksi_utama" id="transaksi_utama">
								<option value="">-- Transaksi Utama --</option>
								<option value="pendaftaran">Pendaftaran</option>
								<option value="daftar_ulang">Daftar Ulang</option>
							</select>
						</div>
					</div>
					<label for="password">Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Biaya" data-validate-field="harga_rincian" name="harga_rincian" id="harga_rincian" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-rincian_biaya">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_rincian_biaya" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Rincian</th>
								<th>Transaksi Utama</th>
								<!-- <th>Jenis Rincian</th> -->
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
$('#harga_rincian').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('rincian_biaya/ajax_list')?>",
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


function formatNumber(num) {
	return accounting.formatNumber(num, 0, "."); // 9 876 543.210
}

// function formatRupiah(angka, prefix){
// 	var number_string = angka.replace(/[^,\d]/g, '').toString(),
// 	split   		= number_string.split(','),
// 	sisa     		= split[0].length % 3,
// 	rupiah     		= split[0].substr(0, sisa),
// 	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

// 	// tambahkan titik jika yang di input sudah menjadi angka ribuan
// 	if(ribuan){
// 		separator = sisa ? '.' : '';
// 		rupiah += separator + ribuan.join('.');
// 	}

// 	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
// 	return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
// }

	function tambah() {
      $('#modal-form-rincian_biaya').fadeIn('slow');
      $('#modal-data-rincian_biaya').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-rincian_biaya').fadeOut('slow');
      $('#modal-data-rincian_biaya').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-rincian_biaya')[0].reset();
    }
	
	function edit(no_rincian){
		$.ajax({
			url:'<?= site_url(); ?>/rincian_biaya/data/',
			data: {'no_rincian':no_rincian},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_rincian);
				$('input[name="nama_rincian"]').val(msg.nama_rincian);
				$('select[name="transaksi_utama"]').val(msg.transaksi_utama).change();
				// $('select[name="jenis_aset"]').val(msg.jenis_aset).change();
				$('input[name="harga_rincian"]').val(msg.harga_rincian);
				
				$('#modal-form-rincian_biaya').fadeIn('slow');
				$('#modal-data-rincian_biaya').fadeOut('slow');
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
				url:'<?= site_url(); ?>/rincian_biaya/hapus/',
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
	
	
	new window.JustValidate('.js-form-rincian_biaya', {
        rules: {
            nama_rincian: {
                required: true
            },
            transaksi_utama: {
                required: true
            },
            harga_rincian: {
                required: true
            }
        },
		messages: {
		  nama_rincian: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  transaksi_utama: 'Form Tidak Boleh Kosong',
		  harga_rincian: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('rincian_biaya/tambah'); ?>";
		}else{
			var url = "<?= site_url('rincian_biaya/ubah'); ?>";
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
