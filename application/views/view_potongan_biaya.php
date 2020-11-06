<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-potongan_biaya">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-potongan_biaya" id="form-potongan_biaya">
					<label for="password">Nama Potongan Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Nama Potongan Biaya" data-validate-field="nama_potongan" name="nama_potongan" id="nama_potongan" class="form-control">
						</div>
					</div>
<!-- 					<label for="password">Nama Rincian Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_rincian" id="no_rincian" data-validate-field="no_rincian" class="select2" style="width: 100%">
								<option value="">--Pilih Nama Rincian--</option>
							</select>
						</div>
					</div> -->
					<label for="password">Nama Rincian Biaya</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_rincian" id="no_rincian" data-validate-field="no_rincian" class="form-control" style="width: 100%">
								<option value="">--Pilih Nama Rincian--</option>
							</select>
						</div>
					</div>
					<label for="password">Jumlah Potongan (%)</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Potongan biaya dalam persen" data-validate-field="potongan" name="potongan" id="potongan" class="form-control">
						</div>
					</div>
<!-- 					<label for="password">Biaya Yang Dipotong(%)</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Biaya yang dipotong" data-validate-field="biaya_potong" name="biaya_potong" id="biaya_potong" class="form-control">
						</div>
					</div> -->
					<div class="modal-footer">
						<button type="button" name="simpan" class="btn btn-sm btn-default" onclick="batal()">Batal</button>
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" >Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-potongan_biaya">
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
								<th>Nama Potongan Biaya</th>
								<th>Potongan (%)</th>
								<th>Nama Rincian</th>
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
//$('#harga_rincian').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('potongan_biaya/ajax_list')?>",
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

	// function tambah() {
 //      $('#modal-form-potongan_biaya').fadeIn('slow');
 //      $('#modal-data-potongan_biaya').fadeOut('slow');
	//   $('#form-title').html("Tambah Data");
	//   $('#aksi').val("tambah");
 //    }

	function tambah() {
        $.ajax({
			type: 'POST',
			url: "<?= site_url('potongan_biaya/list_rincian/'); ?>",
			data: {'no_akses':"NULL"},
			cache: false,
			success: function(msg){
				$("#no_rincian").html(msg);
			}
		});
	  
      $('#modal-form-potongan_biaya').fadeIn('slow');
      $('#modal-data-potongan_biaya').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-potongan_biaya').fadeOut('slow');
      $('#modal-data-potongan_biaya').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-potongan_biaya')[0].reset();
    }
	
	function edit(no_potongan){
		$.ajax({
			url:'<?= site_url(); ?>/potongan_biaya/data',
			data: { 'no_potongan': no_potongan },
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_potongan);
				$('input[name="nama_potongan"]').val(msg.nama_potongan);
				// $('select[name="potongan"]').val(msg.potongan).change();
				$('input[name="potongan"]').val(msg.potongan);
				$('#no_rincian').val(msg.no_rincian).trigger('change');
				//$('input[name="biaya_potong"]').val(msg.biaya_potong);
				$('#modal-form-potongan_biaya').fadeIn('slow');
				$('#modal-data-potongan_biaya').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_potongan){
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
				url:'<?= site_url(); ?>/potongan_biaya/hapus/',
				data: {'no_potongan	':no_potongan	},
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
	
	
	new window.JustValidate('.js-form-potongan_biaya', {
        rules: {
            nama_potongan: {
                required: true
            },
            potongan: {
                required: true
            }
            // biaya_potong: {
            //     required: true
            // }
        },
		messages: {
		  nama_potongan: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  potongan: 'Form Tidak Boleh Kosong',
		  // biaya_potong: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('potongan_biaya/tambah'); ?>";
		}else{
			var url = "<?= site_url('potongan_biaya/ubah'); ?>";
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
