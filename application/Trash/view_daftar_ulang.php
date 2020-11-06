<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-daftar_ulang">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-daftar_ulang form" id="form-daftar_ulang">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<br>
					<label for="email_address">Tanggal Daftar Ulang</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Tanggal Transaksi" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value = "<?php echo date('y-m-d');?>" readonly>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<br>
					<label for="password">Biaya Daftar Ulang</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Setoran Biaya Daftar Ulang" data-validate-field="biaya_daftar_ulang" name="biaya_daftar_ulang" id="biaya_daftar_ulang" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Nama Siswa</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_siswa" id="no_siswa" class="form-control" data-validate-field="no_siswa" style="width: 100%">
								<option value="">--Pilih Siswa--</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Jenis Pembayaran</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran" >
							  <option value="">- Pilih -</option>
							  <option value="tunai">Tunai</option>
							  <option value="kredit">Kredit</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Kelas</label>
					<div class="form-group">
						<div class="form-line">
							<select class="form-control" name="kelas" id="kelas" >
							  <option value="">- Pilih Kelas -</option>
							  <option value="kelas 2">kelas 2</option>
							  <option value="kelas 3">kelas 3</option>
							  <option value="kelas 4">kelas 4</option>
							  <option value="kelas 5">kelas 5</option>
							  <option value="kelas 6">kelas 6</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Pembayaran</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Pembayaran" data-validate-field="pembayaran" name="pembayaran" id="pembayaran" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div style="display:none" id="field_sisa_pembayaran">
					<label for="password">Sisa Pembayaran</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Sisa Pembayaran" data-validate-field="sisa_pembayaran" name="sisa_pembayaran" id="sisa_pembayaran" class="form-control" readonly>
						</div>
					</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div style="display:none" id="field_kembalian">
					<label for="password">Kembalian</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Kembalian" data-validate-field="kembalian" name="kembalian" id="kembalian" class="form-control" readonly>
						</div>
					</div>
					</div>
				</div>
<!-- 					<label for="password">Keterangan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Keterangan" data-validate-field="keterangan" name="keterangan" id="keterangan" class="form-control">
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

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-daftar_ulang">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_daftar_ulang" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					
		<!-- TAMBAHAN CUSTOM FILTER-->	
<!-- 		<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" >Custom Filter : </h3>
					</div>
					<div class="panel-body">
						<form id="form-filter" class="form-horizontal">
							<div class="form-group">
								<label for="LastName" class="col-sm-2 control-label">Kelas</label>
								<div class="col-sm-4">
									<select id="bulan" class="form-control" required>
											<option value="">Pilih Kelas</option>
											<option value="01">Kelas 1</option>
											<option value="02">Kelas 2</option>
											<option value="03">Kelas 3</option>
											<option value="04">Kelas 4</option>
											<option value="05">Kelas 5</option>
											<option value="06">Kelas 6</option>
											<option value="07">Kelas 7</option>
											<option value="08">Kelas 8</option>
											<option value="09">Kelas 9</option>
											<option value="10">Kelas 10</option>
											<option value="11">Kelas 11</option>
											<option value="12">Kelas 12</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="LastName" class="col-sm-2 control-label"></label>
								<div class="col-sm-4">
									<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
									<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div> -->

				<!-- Batas custom filter-->

<!-- 				<div class="navbar-form navbar-right">
						<?php echo form_open('daftar_ulang/search') ?>
						<input type="text" name="keyword" class="form-control" placeholder="Search">
						<button type="submit" class="btn btn-success">Cari</button>

						<?php echo form_close() ?>
				</div> -->


					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Biaya Daftar Ulang</th>
								<th>Pembayaran</th>
								<th>Sisa Pembayaran</th>
								<th>Status Pembayaran</th>
								<th>aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-bayar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">#Pembayaran</h5>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="form-pembayaran">
					<input type="hidden" name="no_siswa" id="nomor_siswa">
					<input type="hidden" name="no_daftar_ulang" id="no_daftar_ulang">
					<div class="form-group row">
						<label class="col-sm-3">Sisa Bayar</label>
						<div class="col-sm-9">
							<input type="text" name="sisa_pembayaran" id="sisa_bayar" class="form-control" readonly style="background-color:#fff">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3">Bayar</label>
						<div class="col-sm-9">
							<input type="text" name="bayar" id="bayar" class="form-control" placeholder="masukan pembayaran disini">
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btnSave">Save</button>
				<button type="button" class="btn btn-primary" id="reset" hidden>Reset</button>
			</div>
				</form>				
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
<script type="text/javascript">
$('#biaya_daftar_ulang').number( true, 0,'', '' );
$('#pembayaran').number( true, 0,'', '' );
$('#sisa_pembayaran').number( true, 0,'', '' );


function formatNumber(num) {
	return accounting.formatNumber(num, 0, "."); // 9 876 543.210
}

var rupiah = document.getElementById('bayar');
rupiah.addEventListener('keyup', function(e){
	// tambahkan 'Rp.' pada saat form di ketik
	// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	rupiah.value = formatRupiah(this.value, '');
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}

$(document).ready(function(){
	$(document).on('click','.bayar', function () {
		var sisa = $(this).attr('sisa');
		var no	 = $(this).attr('no'); 
		var kd	 = $(this).attr('kd'); 
		$('#sisa_bayar').val(formatNumber(sisa));
		$('#nomor_siswa').val(no);
		$('#no_daftar_ulang').val(kd);
		$('#modal-bayar').modal('show');
	});

	$(document).on('click','#reset', function () {
		$('#bayar').val('');
		$('#reset').attr('hidden', true);
		$('#btnSave').removeAttr('hidden');
	});

	$(document).on('click','#btnSave', function () {
		var sisa 	= $('#sisa_bayar').val();
		var bayar	= $('#bayar').val();

		$.ajax({
			type 	: "POST",
			url 	: "<?php echo site_url('daftar_ulang/bayar')?>",
			data	: { bayar : bayar, kd : $('#no_daftar_ulang').val(), sisa : sisa, no : $('#nomor_siswa').val() },
			dataType: "JSON",
			success	: function (data) {
				if (data == 0) {
					Swal.fire(
						'Tersimpan!',
						'Data Telah Berhasil Disimpan',
						'success'
					);
					$('#table').DataTable().ajax.reload();
					$('#modal-bayar').modal('hide');
				} else {
					$('#btnSave').attr('hidden', true);
					$('#reset').removeAttr('hidden');
					Swal.fire(
						'Perhatian!',
						'Tidak Boleh Lebih Besar Dari Sisa Bayar',
						'warning'
					);
				}
			}
		});
	});


// $(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('daftar_ulang/ajax_list')?>",
            "type": "POST",
            //Custom filter
            "data": function ( data ) {
                data.bulan = $('#kelas').val();
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

	//custom filter
	$('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
	});
	
	$('#kelas_id').change(function () {
		listsiswa($('#kelas_id').val());
	})


});

	$('input[name="tanggal_transaksi"]').datetimepicker({
        language:  'id',
        format:'dd-mm-yyyy',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	
	function tambah() {
        $.ajax({
			type: 'POST',
			url: "<?= site_url('daftar_ulang/list_siswa/'); ?>",
			data: {'no_akses':"NULL"},
			cache: false,
			success: function(msg){
				$("#no_siswa").html(msg);
			}
		});
	  
	  $('#modal-form-daftar_ulang').fadeIn('slow');
      $('#modal-data-daftar_ulang').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
	    
      $('#modal-form-daftar_ulang').fadeOut('slow');
      $('#modal-data-daftar_ulang').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-daftar_ulang')[0].reset();
    }

	function biaya_daftar_ulang() { 
		$.ajax({
    		type 	: "POST",
    		url 	: "<?php echo site_url();?>/daftar_ulang/get_biaya",
    		dataType: "JSON",
    		success : function (res) {
    			console.log(res['total']);
    			$('#biaya_daftar_ulang').val(res['total']).attr('readonly', true);
    		}
    	});

	}
	
	$("#jenis_pembayaran").change(function(){
		var jp = $("#jenis_pembayaran").val();
		if(jp=="tunai") {
			var biaya_daftar_ulang = $("#biaya_daftar_ulang").val();
			$("#pembayaran").val(biaya_daftar_ulang);
			$("#field_kembalian").fadeIn("slow");
			$("#field_sisa_pembayaran").fadeOut("slow");
			$("#sisa_pembayaran").val("0");
		} else {
			$("#field_sisa_pembayaran").fadeIn("slow");
			$("#field_kembalian").fadeOut("slow");
		}
	});
	
	$("#pembayaran").change(function(){
		var pembayaran = $("#pembayaran").val();
		var biaya_daftar_ulang = $("#biaya_daftar_ulang").val();
		$("#sisa_pembayaran").val(biaya_daftar_ulang - pembayaran);
		$("#kembalian").val(pembayaran - biaya_daftar_ulang);
	})
	
	new window.JustValidate('.js-form-daftar_ulang', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            biaya_daftar_ulang: {
                required: true
            },
            no_siswa: {
                required: true
            },
			kelas: {
                required: true
            },
            biaya_daftar_ulang: {
                required: true
            },
            pembayaran: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  biaya_daftar_ulang: 'Form Tidak Boleh Kosong',
		  pembayaran: 'Form Tidak Boleh Kosong',
		  no_siswa: 'Form Tidak Boleh Kosong',
		  kelas: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('daftar_ulang/tambah'); ?>";
		}else{
			var url = "<?= site_url('daftar_ulang/ubah'); ?>";
		}
            var jp = $("#jenis_pembayaran").val();
			var pembayaran = $("#pembayaran").val();
			var biaya_daftar_ulang = $("#biaya_daftar_ulang").val();
		

			if(jp=="tunai" && parseInt(pembayaran) < parseInt(biaya_daftar_ulang) ){
				$.toast({
					heading: 'Bahaya',
					text: 'Pembayaran Kurang',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
				});
			} else if(jp=="kredit" && parseInt(pembayaran) >= parseInt(biaya_daftar_ulang) ){
				$.toast({
					heading: 'Bahaya',
					text: 'Pembayaran Melebihi Biaya',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
				});
			} else{
				
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
			}
        },
    });

	// select2
	$(document).ready(function() {
		$('.select2').select2();
	})
</script>
