<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-pendaftaran">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div> 
		</div>

		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-pendaftaran form" id="form-pendaftaran">
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<br>
						<label for="password">Tanggal Daftar</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Tanggal Daftar" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" value = "<?php echo date('d F Y');?>" readonly ">
							</div>
						</div>
					</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<br>
					<label for="password">Nama Ibu</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Nama Ibu" data-validate-field="nama_ibu" name="nama_ibu" id="nama_ibu" class="form-control">
							</div>
						</div>
					</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="email_address">Jam</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Tanggal Transaksi" data-validate-field="jam" name="jam" id="jam" class="form-control" value = "<?php echo date('H:i:s');?>" readonly>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Nama Ayah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Nama Ayah" data-validate-field="nama_ayah" name="nama_ayah" id="nama_ayah" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">NIK</label>
						<div class="form-group">
							<div class="form-group-line">
								<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
								<input type="text" placeholder="NIK" data-validate-field="nis" name="nis" id="nis" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">No Telepon Orang Tua (Ayah/Ibu)</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="No Telepon Orang Tua" data-validate-field="no_telepon_ortu" name="no_telepon_ortu" id="no_telepon_ortu" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Nama Siswa</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Nama Siswa" data-validate-field="nama_siswa" name="nama_siswa" id="nama_siswa" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Biaya Pendaftaran</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Biaya Pendaftaran" data-validate-field="biaya_pendaftaran" name="biaya_pendaftaran" id="biaya_pendaftaran" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Jenis Kelamin</label>
						<div class="form-group">
							<div class="form-line">
								<input type="radio" name="jenis_kelamin" value="Laki-laki" id="jenis_kelamin" data-validate-field="jenis_kelamin" > Laki-laki
								<input type="radio" name="jenis_kelamin" value="Perempuan" id="jenis_kelamin" data-validate-field="jenis_kelamin" > Perempuan
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Potongan</label>
					<div class="form-group">
						<div class="form-line">
							<select name="no_potongan" id="no_potongan" class="form-control">
								<option value="">--Pilih Potongan--</option>
							</select>
						</div>
					</div>
				</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Tempat Lahir</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Tempat Lahir" data-validate-field="tempat_lahir" name="tempat_lahir" id="tempat_lahir" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Total Biaya Pendaftaran</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Total Biaya Pendaftaran" data-validate-field="tbiaya_pendaftaran" name="tbiaya_pendaftaran" id="tbiaya_pendaftaran" class="form-control" readonly>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<label for="password">Tanggal Lahir</label>
					<div class="form-group">
						<div class="form-line">
							<input type="date" placeholder="Tanggal Lahir" data-validate-field="tanggal_lahir" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
							<script>
								$(document).ready(function(){
										$("#depart").datepicker({
											showAnim : 'drop'
										});
								});	
							</script>
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
<!-- 					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Potongan</label>
						<div class="form-group">
							<div class="form-line">
								<select name="no_potongan" id="no_potongan" class="form-control">
									<option value="">--Pilih Potongan--</option>
								</select>
							</div>
						</div>
					</div>
 -->
				

<!-- 					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Tanggal Lahir</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" readonly placeholder="Tanggal Lahir" data-validate-field="tanggal_lahir" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
								<script>
									$(document).ready(function(){
											$("#depart").datepicker({
												showAnim : 'drop'
											});
									});	
								</script>
							</div>
						</div>
					</div> -->

				

					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="password">Alamat Pendaftaran</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" placeholder="Alamat Siswa" data-validate-field="alamat_siswa" name="alamat_siswa" id="alamat_siswa" class="form-control">
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
						<label for="password">Tahun Angkatan</label>
						<div class="form-group">
							<div class="form-line">
								<select name="no_ajaran" id="no_ajaran" data-validate-field="no_ajaran" class="form-control" style="width: 100%">
									<option value="">--Pilih Angkatan--</option>
								</select>
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
					<div style="display:none" id="field_kembalian">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<label for="password">Kembalian</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" placeholder="Kembalian" data-validate-field="kembalian" name="kembalian" id="kembalian" class="form-control" readonly>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" id="totalbiaya_pendaftaran">
					<div class="modal-footer">
						<button type="button" name="simpan" class="btn btn-sm btn-default" onclick="batal()">Batal</button>
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" id="save" >Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-pendaftaran">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_pendaftaran" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>NIK</th>
								<th>Nama Pendaftaran</th>
								<th>Pembayaran</th>
								<th>Sisa Pembayaran</th>
								<th>Status</th>								
								<th>Aksi</th>
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
					<input type="hidden" name="no_pendaftaran" id="no_pendaftaran">
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
$('#nis').number( true, 0,'', '' );
$('#biaya_pendaftaran').number( true, 0,'', '' );
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

function getpotongan() {
	$.ajax({
		type: 'POST',
		url:  "<?= site_url('pendaftaran/getpotongan'); ?>",
		data: {'no_akses':"NULL"},
		cache: false,
		success: function(msg){
			$("#no_potongan").html(msg);
		}
	});
}

function listajaran() {
	$.ajax({
		type: 'POST',
		url: "<?= site_url('pendaftaran/listajaran/'); ?>",
		data: {'no_akses':"NULL"},
		cache: false,
		success: function(msg){
			$("#no_ajaran").html(msg);
		}
	});
}

$(document).ready(function(){
	$(document).on('click','.bayar', function () {
		var sisa = $(this).attr('sisa');
		var no	 = $(this).attr('no'); 
		var kd	 = $(this).attr('kd'); 
		$('#sisa_bayar').val(formatNumber(sisa));
		$('#nomor_siswa').val(no);
		$('#no_pendaftaran').val(kd);
		$('#modal-bayar').modal('show');
	});

	listajaran();

	$(document).on('click','#reset', function () {
		$('#bayar').val();
		$('#reset').attr('hidden', true);
		$('#btnSave').removeAttr('hidden');
	});

	$(document).on('change','#no_potongan', function () {
		biaya  = $('#biaya_pendaftaran').val();
		diskon = $('#no_potongan').val();

		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('pendaftaran/getdiskon')?>",
			data : {
				diskon : diskon
			},
			dataType: "JSON",
			success : function (res) {
				total = biaya - ((res / 100) * biaya);
				$('#tbiaya_pendaftaran').val(formatNumber(total)); 
				$('#totalbiaya_pendaftaran').val(total); 
			}
		});
	})


	$(document).on('click','#btnSave', function () {
		var sisa 	= $('#sisa_bayar').val().replace(/[.]+/gi, "");
		var bayar	= $('#bayar').val();

	// $(document).on('click','#btnSave', function () {
	// 	var sisa 	= $('#sisa_bayar').val(formatNumber(sisa));
	// 	var bayar	= $('#bayar').val();

		$.ajax({
			type 	: "POST",
			url 	: "<?php echo site_url('pendaftaran/bayar')?>",
			//data	: { bayar : bayar, sisa : sisa, no : $('#nomor_siswa').val() },
			data	: { bayar : bayar, kd : $('#no_pendaftaran').val(), sisa : sisa, no : $('#nomor_siswa').val() },

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

	getpotongan();


// $(document).ready(function(){

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pendaftaran/ajax_list')?>",
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
	 $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
     });
	// table.ajax.reload();  //just reload table
});

	$('input[name="tanggal_lahir"]').datetimepicker({
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
	
	$('#tanggal_lahir').datetimepicker('setEndDate', new Date());

	$('#tanggal_lahir').datetimepicker({
		changeYear: true,
        minDate: '-3Y',
        maxDate: '-5Y'
	})


	// $('input[name="tanggal_transaksi"]').datetimepicker({
 //        language:  'id',
 //        format:'yyyy-mm-dd',
 //        weekStart: 1,
 //        todayBtn:  1,
	// 	autoclose: 1,
	// 	todayHighlight: 1,
	// 	startView: 2,
	// 	minView: 2,
	// 	forceParse: 0
 //    });
	
	function biaya_pendaftaran() {
		$.ajax({
    		type 	: "POST",
    		url 	: "<?php echo site_url();?>/pendaftaran/get_biaya",
    		dataType: "JSON",
    		success : function (res) {
    			// console.log(res['total']);
    			$('#biaya_pendaftaran').val(res['total']).attr('readonly', true);
    		}
    	});

	}

	function tambah() {
      $('#modal-form-pendaftaran').fadeIn('slow');
      $('#modal-data-pendaftaran').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
	  biaya_pendaftaran();
    }
	
	function batal() {
      $('#modal-form-pendaftaran').fadeOut('slow');
      $('#modal-data-pendaftaran').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-pendaftaran')[0].reset();
    }
	
	function edit(no_siswa){
		$.ajax({
			url:'<?= site_url(); ?>/pendaftaran/data/',
			data: {'no_siswa':no_siswa},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="tanggal_transaksi"]').prop('readonly', true).val(msg.tanggal_transaksi);
				$('input[name="aksi"]').val(msg.no_siswa);
				$('input[name="nis"]').val(msg.nis);
				$('input[name="nama_siswa"]').val(msg.nama_siswa);
				$('input[name="alamat_siswa"]').val(msg.alamat_siswa);
				//$('input[name="no_telepon"]').val(msg.no_telepon);
				$('select[name="jenis_kelamin"]').val(msg.jenis_kelamin).change();
				$('input[name="tempat_lahir"]').val(msg.tempat_lahir);
				$('input[name="tanggal_lahir"]').val(msg.tanggal_lahir);
				$('input[name="nama_ayah"]').val(msg.nama_ayah);
				$('input[name="nama_ibu"]').val(msg.nama_ibu);
				$('input[name="no_telepon_ortu"]').val(msg.no_telepon_ortu);
				$('select[name="jenis_pembayaran"]').prop('disabled', true).val('').change();
				$('input[name="biaya_pendaftaran"]').prop('readonly', true).val(msg.biaya_pendaftaran);
				$('input[name="pembayaran"]').prop('readonly', true).val(msg.pembayaran);
				$('input[name="sisa_pembayaran"]').prop('readonly', true).val(msg.sisa_pembayaran);
				$('input[name="kembalian"]').prop('readonly', true).val(msg.kembalian);
				
				$('#modal-form-pendaftaran').fadeIn('slow');
				$('#modal-data-pendaftaran').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_siswa){
		Swal.fire({
		  title: 'Hapus Data Ini?',
		  text: "Anda yakin ingin menghapus?",
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
				url:'<?= site_url(); ?>/pendaftaran/hapus/',
				data: {'no_siswa':no_siswa},
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
	
	$("#jenis_pembayaran").change(function(){
		var jp = $("#jenis_pembayaran").val();
		biaya  = $('#totalbiaya_pendaftaran').val();
		if(jp=="tunai") {
			$("#pembayaran").val(biaya);
			$("#field_kembalian").fadeIn("slow");
			$("#field_sisa_pembayaran").fadeOut("slow");
			$("#sisa_pembayaran").val("0");
			$('#pembayaran').attr('readonly', true);
			$('#kembalian').val('0');
		} else {
			$('#pembayaran').removeAttr('readonly');
			$("#field_sisa_pembayaran").fadeIn("slow");
			$("#field_kembalian").fadeOut("slow");
		}
	});
	
	$("#pembayaran").keyup(function(){
		var pembayaran = $("#pembayaran").val();
		var biaya_pendaftaran = $("#totalbiaya_pendaftaran").val();
		$("#sisa_pembayaran").val(biaya_pendaftaran - pembayaran);
		$("#kembalian").val(pembayaran - biaya_pendaftaran);
	})

	$(document).on('keyup','#nis',function() {
		$.ajax({
			type:"post",
			url:"<?php echo site_url("pendaftaran/validasi") ?>",
			data:{
				nis:$('#nis').val()
			},
			dataType:"JSON",
			success:function(H){
				// alert(H);
				if(H>0){
				$.toast({
					heading: 'Bahaya',
					text: 'Data "'+$('#nis').val()+'" Telah Tersedia',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
					});
				$('#save').attr('disabled',true);
				}
				else{
				$('#save').attr('disabled',false);
				//$('#save').removeAttr('disabled')

				}
			}

		})
	})
	
	new window.JustValidate('.js-form-pendaftaran', {
        rules: {
            nama_siswa: {
                required: true
            },
            nis: {
                required: true,
                // remote: {
                // 	type:"post",
                // 	url:"<?php echo site_url('pendaftaran/validasi') ?>",
                // 	data:{
                // 		nis:function(){
                // 			$('#nis').val()
                // 		}
                // 	}
                // }
            },
			no_ajaran: {
                required: true
            },
            alamat_siswa: {
                required: true
            },
            no_telepon: {
                required: true
            },
            jenis_kelamin: {
                required: true
            },
            tanggal_lahir: {
                required: true
            },
            tempat_lahir: {
                required: true
            },
            nama_ayah: {
                required: true
            },
            nama_ibu: {
                required: true
            },
            no_telepon_ortu: {
                required: true
            },
            biaya_pendaftaran: {
                required: true
            },
            pembayaran: {
                required: true
            }
        },
		messages: {
		  nama_siswa: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  nis: 'Form Tidak Boleh Kosong',
		  no_ajarab: 'Form Tidak Boleh Kosong',
		  alamat_siswa: 'Form Tidak Boleh Kosong',
		  no_telepon: 'Form Tidak Boleh Kosong',
		  jenis_kelamin: 'Form Tidak Boleh Kosong',
		  tanggal_lahir: 'Form Tidak Boleh Kosong',
		  tempat_lahir: 'Form Tidak Boleh Kosong',
		  nama_ayah: 'Form Tidak Boleh Kosong',
		  nama_ibu: 'Form Tidak Boleh Kosong',
		  biaya_pendaftaran: 'Form Tidak Boleh Kosong',
		  pembayaran: 'Form Tidak Boleh Kosong',
		  no_telepon_ortu: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('pendaftaran/tambah'); ?>";
		}else{
			var url = "<?= site_url('pendaftaran/ubah'); ?>";
		}
			var jp = $("#jenis_pembayaran").val();
			var pembayaran = $("#pembayaran").val();
			var biaya_pendaftaran = $("#totalbiaya_pendaftaran").val();
		

			if(jp=="tunai" && parseInt(pembayaran) < parseInt(biaya_pendaftaran) ){
				$.toast({
					heading: 'Bahaya',
					text: 'Pembayaran Kurang',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
				});
			} else if(jp=="kredit" && parseInt(pembayaran) >= parseInt(biaya_pendaftaran) ){
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
</script>
