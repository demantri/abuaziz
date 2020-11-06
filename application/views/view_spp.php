<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-spp">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-spp form" id="form-spp">
					<label for="email_address">Tanggal SPP Bulanan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Tanggal Bayar" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi"  class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
						</div>
					</div>
					<label for="password">Nama Siswa</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_siswa" id="no_siswa" data-validate-field="no_siswa" class="form-control">
								<option value="">--Pilih Siswa--</option>
								
							</select>
						</div>
					</div>
					<label for="password">Biaya SPP</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Biaya SPP" data-validate-field="biaya_spp" name="biaya_spp" id="biaya_spp" class="form-control" readonly>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" name="simpan" class="btn btn-sm btn-default" onclick="batal()">Batal</button>
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" id="simpan">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-spp">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_spp" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					
					<div class="panel panel-default">
						<div class="row">
							<div class="col-sm-4">
								<select name="bulan" id="bulan" class="form-control">
									<option value="">--Pilih Bulan--</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
							</div>
							<div class="col-sm-4">
								<select name="tahun" id="tahun" class="form-control">
									<option value="">--Pilih Tahun--</option>
									<?php for ($i=2019; $i < 2026; $i++) { 
										echo "<option value='".$i."'>".$i."</option>";
									} ?>
								</select>
							</div>
							<div class="col-sm-4">
								<button type="button" class="btn btn-info" id="btn" name="btn">Filter</button>
							</div>
						</div>
						<br><br>
						</div>
							<table class="table table-striped table-bordered table-hover" id="table">
								<thead>
									<tr>
										<th>No</th>
										<th>NIS</th>
										<th>Nama Siswa</th>
										<th>Tanggal Transaksi</th>
										<th>Biaya SPP Bulanan</th>
										<th>Periode</th>
										<th>Status Pembayaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <a <?php echo site_url()."/spp/print_excel_bukti_transaksi"?>"class="btn btn-xs btn-info" title="Cetak"><i class="fa fa-print"></i></a>'; -->
<script type="text/javascript">
$('#biaya_spp').number( true, 0,'', '' );
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('spp/ajax_list')?>",
            "type": "POST", 
            "data": function ( data ) {
                data.bulan = $('#bulan').val();
                data.tahun = $('#tahun').val();
            }
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
	 $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });

    $('#no_ajaran').change(function () {
    	$.ajax({
    		type 	: "POST",
    		url 	: "<?php echo site_url();?>/spp/get_harga",
    		data 	: {
    			no : $('#no_ajaran').val(),
    		},
    		dataType: "JSON",
    		success : function (res) {
    			$('#biaya_spp').val(res);
    		}
    	});
    });

	$(document).on('click','#btn', function () {
        table.ajax.reload();  //just reload table
	});

    // no_siswa merupakan id dari box input siswa pada saat pilih siswa
    $('#no_siswa').change(function () {
    	$.ajax({
    		type 	: "POST",
    		url 	: "<?php echo site_url();?>/spp/validasi",
    		data 	: {
    			no_siswa    : $('#no_siswa').val(),
				tgl 		: $('#tanggal_transaksi').val()
    		},
    		dataType: "JSON",
    		success : function (res) {
    			if (res['vali'] > 0) {
    				$.toast({
						heading: 'Info',
						text: 'Sudah melakukkan pembayaran!',
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'warning'
					});
					$('#simpan').attr('disabled', true);
    			}
				$('#biaya_spp').val(res['biaya']);
    		}
    	});
    })
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

    function listajaran() {
    	$.ajax({
    		type 	: "POST",
    		url 	: "<?php echo site_url('spp/listajaran');?>",
    		success : function (msg) {
				$("#no_ajaran").html(msg);
    		}
    	});
    }
	
	function tambah() {
        $.ajax({
			type: 'POST',
			url: "<?= site_url('spp/list_siswa/'); ?>",
			data: {'no_akses':"NULL"},
			cache: false,
			success: function(msg){
				$("#no_siswa").html(msg);
			}
		});

		listajaran();
	  
	  $('#modal-form-spp').fadeIn('slow');
      $('#modal-data-spp').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
	    
      $('#modal-form-spp').fadeOut('slow');
      $('#modal-data-spp').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-spp')[0].reset();
    }
	
	
	new window.JustValidate('.js-form-spp', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            no_ajaran: {
                required: true
            },
            biaya_spp: {
                required: true
            },
            no_siswa: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  no_ajaran: 'Form Tidak Boleh Kosong',
		  biaya_spp: 'Form Tidak Boleh Kosong',
		  no_siswa: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
			var url = "<?= site_url('spp/tambah'); ?>";
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
