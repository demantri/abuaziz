<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-pendapatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-pendapatan form" id="form-pendapatan">
					<label for="email_address">Tanggal Pendapatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Tanggal Transaksi" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
						</div>
					</div>
					<label for="password">Nama Pendapatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Nama Pendapatan" data-validate-field="nama_pendapatan" name="nama_pendapatan" id="nama_pendapatan" class="form-control">
						</div>
					</div>
					<label for="password">Sumber Pendapatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Sumber Pendapatan" data-validate-field="sumber_pendapatan" name="sumber_pendapatan" id="sumber_pendapatan" class="form-control">
						</div>
					</div>
					<label for="password">Jumlah Pendapatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Jumlah Pendapatan" data-validate-field="jumlah_pendapatan" name="jumlah_pendapatan" id="jumlah_pendapatan" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-pendapatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_pendapatan" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Pendapatan</th>
								<th>Nama Pendapatan</th>
								<th>Sumber Pendapatan</th>
								<th>Jumlah Pendapatan</th>
								<th>Keterangan</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#jumlah_pendapatan').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pendapatan/ajax_list')?>",
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
	
	function tambah() {
	  
	  $('#modal-form-pendapatan').fadeIn('slow');
      $('#modal-data-pendapatan').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
	    
      $('#modal-form-pendapatan').fadeOut('slow');
      $('#modal-data-pendapatan').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-pendapatan')[0].reset();
    }
	
	
	new window.JustValidate('.js-form-pendapatan', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            jumlah_pendapatan: {
                required: true
            },
            nama_pendapatan: {
                required: true
            },
            sumber_pendapatan: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  jumlah_pendapatan: 'Form Tidak Boleh Kosong',
		  sumber_pendapatan: 'Form Tidak Boleh Kosong',
		  nama_pendapatan: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('pendapatan/tambah'); ?>";
		}else{
			var url = "<?= site_url('pendapatan/ubah'); ?>";
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
