<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-beban">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-beban form" id="form-beban">
					<label for="email_address">Tanggal Pengeluaran Beban</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Tanggal Transaksi" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
						</div>
					</div>
					<label for="password">Nama Pengeluaran</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_beban" id="no_beban" data-validate-field="no_beban" class="form-control">
								<option value="">--Pilih Pengeluaran--</option>
								
							</select>
						</div>
					</div>
					<label for="password">Jumlah Pengeluaran</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" data-validate-field="total_pengeluaran" name="total_pengeluaran" id="total_pengeluaran" class="form-control">
						</div>
					</div>
					<label for="password">Keterangan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Keterangan" data-validate-field="keterangan" name="keterangan" id="keterangan" class="form-control">
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
<!-- basic table -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-beban">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_beban" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>No Transaksi</th>
								<th>Nama Beban</th>
								<th>Total Pengeluaran</th>
								<th>Keterangan</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- basic table -->
<!-- #END# Basic Examples -->
<script type="text/javascript">
$('#total_pengeluaran').number( true, 0,'', '' );
$('input[name="tanggal_transaksi"]').datetimepicker({
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

$(window).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('beban/ajax_list')?>",
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
	
	//selain detail transaksi
	function tambah() {
        $.ajax({
			type: 'POST',
			url: "<?= site_url('beban/list_beban/'); ?>",
			data: {'no_akses':"NULL"},
			cache: false,
			success: function(msg){
				$("#no_beban").html(msg);
			}
		});
	  
	  $('#modal-form-beban').fadeIn('slow');
      $('#modal-data-beban').fadeOut('slow');
	  $('#form-title').html("Tambah Pengeluaran Beban");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-beban').fadeOut('slow');
      $('#modal-data-beban').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-beban')[0].reset();
    }
	
	// function edit(no_beban){
		// $.ajax({
			// url:'<?= site_url(); ?>/beban/data/',
			// data: {'no_beban':no_beban},
            // type:'POST',
			// dataType:'JSON',
			// success:function(msg){
				// $('input[name="aksi"]').val(msg.no_beban);
				// $('input[name="nama_beban"]').val(msg.nama_beban);
				// $('input[name="alamat_beban"]').val(msg.alamat_beban);
				// $('input[name="no_telepon"]').val(msg.no_telepon);
				// $('select[name="jenis_kelamin"]').val(msg.jenis_kelamin).change();
				
				// $('#modal-form-beban').fadeIn('slow');
				// $('#modal-data-beban').fadeOut('slow');
				// $('#form-title').html("Edit Data");
			// }
		// });
	// }
	
	new window.JustValidate('.js-form-beban', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            no_beban: {
                required: true
            },
            total_pengeluaran: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  no_beban: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  total_pengeluaran: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('beban/tambah'); ?>";
		}else{
			var url = "<?= site_url('beban/ubah'); ?>";
		}
			var total_pengeluaran = $('#total_pengeluaran').val();
			if(parseInt(total_pengeluaran) === 0){
				$.toast({
					heading: 'Bahaya',
					text: 'Pengeluaran Tidak Boleh 0',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
				});
			} else {
				
				var formData = new FormData($("#form-beban")[0]);
				// formData.append('content', content);
				
				$.ajax({
				  url: url,
				  dataType : 'json',
				  type : 'POST',
				  data : formData,
				  contentType : false,
				  processData : false,
				  success: function(response) {
					if(response.status =="benar") {
						$.toast({
							heading: 'Info',
							text: 'Data Berhasil Ditambah!',
							position: 'top-right',
							showHideTransition: 'slide',
							icon: 'info'
						});
						$("#tbodyid").empty();
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
			}
        },
    });
</script>
