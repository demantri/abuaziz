<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-pengeluaran_dll">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-pengeluaran_dll form" id="form-pengeluaran_dll">
					<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">


					<label for="password">Tanggal Pengeluaran</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Tanggal Transaksi" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value = "<?php echo date('Y-m-d');?>" readonly >
						</div>
					</div>
					
					<label for="password">Nama Pengeluaran</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_pengeluaran" id="no_pengeluaran" data-validate-field="no_pengeluaran" class="form-control">
								<option value="">--Pilih Pengeluaran--</option>
								<?php foreach ($png as $row) { ?>
									<option value="<?= $row['no_pengeluaran'] ?>">
										<?= $row['no_pengeluaran']." / ".$row['nama_pengeluaran'] ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<label for="password">Jumlah Pengeluaran</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Jumlah Pengeluaran" data-validate-field="jumlah_pengeluaran" name="jumlah_pengeluaran" id="jumlah_pengeluaran" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-pengeluaran_dll">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_pengeluaran_dll" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>No Transaksi</th>
								<th>Tanggal Pengeluaran</th>
								<th>Nama Pengeluaran</th>
								<th>Jumlah Pengeluaran</th>
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
            "url": "<?php echo site_url('pengeluaran_dll/ajax_list')?>",
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

	/**$('input[name="tanggal_transaksi"]').datetimepicker({
        language:  'id',
        format:'yyyy-mm-dd',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		maxDate : 0
    });**/

	function tambah() {	  
		
	  $('#modal-form-pengeluaran_dll').fadeIn('slow');
      $('#modal-data-pengeluaran_dll').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
	    
      $('#modal-form-pengeluaran_dll').fadeOut('slow');
      $('#modal-data-pengeluaran_dll').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-pengeluaran_dll')[0].reset();
    }
	
	
	new window.JustValidate('.js-form-pengeluaran_dll', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            jumlah_pengeluaran: {
                required: true
            },
            no_pengeluaran: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  jumlah_pengeluaran: 'Form Tidak Boleh Kosong',
		  no_pengeluaran: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('pengeluaran_dll/tambah'); ?>";
		}else{
			var url = "<?= site_url('pengeluaran_dll/ubah'); ?>";
		}
            $.ajax({
			  url: url,
			  method: "POST",
			  data: values,
			  dataType: "JSON",
			  success: function(res){
			  	var status = 'error';
			  	if(res.status){
			  		status = 'success';
			  		table.ajax.reload();  //just reload table
					batal();  //just reload table
			  	}

			  	$.toast({
					heading: 'Info',
					text: res.message,
					position: 'top-right',
					showHideTransition: 'slide',
					icon: status
				});
				
			  }
			});
        },
    }); 
</script>
