<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-penjualan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-penjualan form" id="form-penjualan">
				<div class="row" >
					<div class="col-lg-3" >
						<div class="panel panel-primary" >
							<div class="panel-heading"><i class='fa fa-file-text-o fa-fw'></i> Informasi Penjualan</div>
							<div class="panel-body">
								<label for="email_address">Tanggal Penjualan</label>
								<div class="form-group">
									<div class="form-line">
										<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
										<input type="text" placeholder="Tanggal Transaksi" data-validate-field="tanggal_transaksi" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control">
									</div>
								</div>
								<label for="email_address">Nama Pelanggan</label>
								<div class="form-group">
									<div class="form-line">
										<select name="no_pelanggan" id="no_pelanggan" data-validate-field="no_pelanggan" class="form-control">
											<option value="NULL">--Pilih Pelanggan--</option>
											
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9">
						<table class='table table-bordered' id='TabelTransaksi'>
							<thead>
								<tr>
									<th style='width:35px;'>#</th>
									<th style='width:210px;'>No Produk</th>
									<th style='width:210px;'>Jenis Produk</th>
									<th>Nama Produk</th>
									<th style='width:120px;'>Harga</th>
									<th style='width:75px;'>Qty</th>
									<th style='width:125px;'>Sub Total</th>
									<th style='width:40px;'></th>
								</tr>
							</thead>
							<tbody id="tbodyid"></tbody>
						</table>
						<div class="alert alert-info TotalBayar">
							<button type="button" id="BarisBaru" class="btn btn-primary pull-left"><i class="icon-plus"></i> Baris Baru</button>
							<h2 align="right">Total : <span id='TotalBayar'>Rp. 0</span></h2>
							<input type="hidden" name='total_harga' id='TotalBayarHidden'>
						</div>
					</div>
				</div>
					
					<label for="password">Catatan Khusus</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" placeholder="Catatan" data-validate-field="catatan" name="catatan" id="catatan" class="form-control">
						</div>
					</div>
					<label for="password">Jumlah Bayar</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" data-validate-field="pembayaran" name="pembayaran" id="UangCash" class="form-control" onkeypress="return check_int(event)">
						</div>
					</div>
					<label for="password">Kembalian</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" data-validate-field="kembalian" name="kembalian" id="UangKembali" class="form-control" readonly>
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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-penjualan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_penjualan" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>No Transaksi</th>
								<th>Nama Pelanggan</th>
								<th>Total Harga</th>
								<th>Pembayaran</th>
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
<!-- basic table -->
<!-- #END# Basic Examples -->
<script type="text/javascript">
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
            "url": "<?php echo site_url('penjualan/ajax_list')?>",
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
	
	//tabel detail
	for(B=1; B<=1; B++){
		BarisBaru();
	}

	$("#TabelTransaksi tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
});
	//detail transaksi
	$('#BarisBaru').click(function(){
		BarisBaru();
	});
	
	function BarisBaru()
	{
		var Nomor = $('#TabelTransaksi tbody tr').length + 1;
		var Baris = "<tr>";
			Baris += "<td>"+Nomor+"</td>";
			Baris += "<td>";
				Baris += "<input type='text' class='form-control' name='kode_barang[]' id='pencarian_kode' placeholder='Nama / Kode'>";
				Baris += "<div id='hasil_pencarian'></div>";
			Baris += "</td>";
			Baris += "<td></td>";
			Baris += "<td></td>";
			Baris += "<td>";
				Baris += "<input type='hidden' name='harga_satuan[]'>";
				Baris += "<span></span>";
			Baris += "</td>";
			Baris += "<td><input type='text' class='form-control' id='jumlah_beli' name='jumlah_beli[]' onkeypress='return check_int(event)' disabled></td>";
			Baris += "<td>";
				Baris += "<input type='hidden' name='sub_total[]'>";
				Baris += "<span></span>";
			Baris += "</td>";
			Baris += "<td><button class='btn btn-default' id='HapusBaris'><i class='fa fa-trash' style='color:red;'></i></button></td>";
			Baris += "</tr>";

		$('#TabelTransaksi tbody').append(Baris);

		$('#TabelTransaksi tbody tr').each(function(){
			$(this).find('td:nth-child(2) input').focus();
		});

		HitungTotalBayar();
	}

	$(document).on('click', '#HapusBaris', function(e){
		e.preventDefault();
		$(this).parent().parent().remove();

		var Nomor = 1;
		$('#TabelTransaksi tbody tr').each(function(){
			$(this).find('td:nth-child(1)').html(Nomor);
			Nomor++;
		});

		HitungTotalBayar();
	});
	
	function AutoCompleteGue(Lebar, KataKunci, Indexnya)
	{
		$('div#hasil_pencarian').hide();
		var Lebar = Lebar + 25;

		var Registered = '';
		$('#TabelTransaksi tbody tr').each(function(){
			if(Indexnya !== $(this).index())
			{
				if($(this).find('td:nth-child(2) input').val() !== '')
				{
					Registered += $(this).find('td:nth-child(2) input').val() + ',';
				}
			}
		});

		if(Registered !== ''){
			Registered = Registered.replace(/,\s*$/,"");
		}

		$.ajax({
			url: "<?php echo site_url('penjualan/ajax_kode'); ?>",
			type: "POST",
			cache: false,
			data:'keyword=' + KataKunci + '&registered=' + Registered,
			dataType:'json',
			success: function(json){
				if(json.status == 1)
				{
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').html(json.datanya);
				}
				if(json.status == 0)
				{
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html('');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val('');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html('');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').prop('disabled', true).val('');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(0);
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html('');
				}
			}
		});

		HitungTotalBayar();
	}

	$(document).on('keyup', '#pencarian_kode', function(e){
		if($(this).val() !== '')
		{
			var charCode = e.which || e.keyCode;
			if(charCode == 40)
			{
				if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
				{
					var Selanjutnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').next();
					$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');

					Selanjutnya.addClass('autocomplete_active');
				}
				else
				{
					$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
				}
			} 
			else if(charCode == 38)
			{
				if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
				{
					var Sebelumnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').prev();
					$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
				
					Sebelumnya.addClass('autocomplete_active');
				}
				else
				{
					$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
				}
			}
			else if(charCode == 13)
			{
				var Field = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)');
				var Kodenya = Field.find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
				var Barangnya = Field.find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();
				var Harganya = Field.find('div#hasil_pencarian li.autocomplete_active span#harganya').html();
				var Barcodenya = Field.find('div#hasil_pencarian li.autocomplete_active span#barcodenya').html();
				
				Field.find('div#hasil_pencarian').hide();
				Field.find('input').val(Kodenya);

				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(3)').html(Barcodenya);
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4)').html(Barangnya);
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').val(Harganya);
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) span').html(to_rupiah(Harganya));
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) input').removeAttr('disabled').val(1);
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(7) input').val(Harganya);
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(7) span').html(to_rupiah(Harganya));
				
				var IndexIni = $(this).parent().parent().index() + 1;
				var TotalIndex = $('#TabelTransaksi tbody tr').length;
				if(IndexIni == TotalIndex){
					BarisBaru();

					$('html, body').animate({ scrollTop: $(document).height() }, 0);
				}
				else {
					$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').focus();
				}
			}
			else 
			{
				AutoCompleteGue($(this).width(), $(this).val(), $(this).parent().parent().index());
			}
		}
		else
		{
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian').hide();
		}

		HitungTotalBayar();
	});

	$(document).on('click', '#daftar-autocomplete li', function(){
		$(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());
		
		var Indexnya = $(this).parent().parent().parent().parent().index();
		var NamaBarang = $(this).find('span#barangnya').html();
		var Harganya = $(this).find('span#harganya').html();
		var Barcodenya = $(this).find('span#barcodenya').html();

		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').hide();
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html(Barcodenya);
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4)').html(NamaBarang);
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val(Harganya);
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) span').html(to_rupiah(Harganya));
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').removeAttr('disabled').val(1);
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) input').val(Harganya);
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) span').html(to_rupiah(Harganya));

		var IndexIni = Indexnya + 1;
		var TotalIndex = $('#TabelTransaksi tbody tr').length;
		if(IndexIni == TotalIndex){
			BarisBaru();
			$('html, body').animate({ scrollTop: $(document).height() }, 0);
		}
		else {
			$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').focus();
		}

		HitungTotalBayar();
	});
	
	$(document).on('keyup', '#jumlah_beli', function(){
		var Indexnya = $(this).parent().parent().index();
		var Harga = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val();
		var JumlahBeli = $(this).val();
		var no_produk = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2) input').val();

		$.ajax({
			url: "<?php echo site_url('penjualan/cek_stok'); ?>",
			type: "POST",
			cache: false,
			data: "no_produk="+encodeURI(no_produk)+"&jumlah_beli="+JumlahBeli,
			dataType:'json',
			success: function(data){
				if(data.status == 1)
				{
					var harga_baru = data.harga_produk;
					var SubTotal = parseInt(harga_baru) * parseInt(JumlahBeli);
					if(SubTotal > 0){
						var SubTotalVal = SubTotal;
						SubTotal = to_rupiah(SubTotal);
					} else {
						SubTotal = '';
						var SubTotalVal = 0;
					}
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) span').html(to_rupiah(data.harga_produk));
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val(data.harga_produk);
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) input').val(SubTotalVal);
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) span').html(SubTotal);
					HitungTotalBayar();
				}
				if(data.status == 0)
				{
					$.toast({
						heading: 'Info',
						text: data.pesan,
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'error',
						hideAfter: false
					});
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) span').html(to_rupiah(data.harga_produk));
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val(data.harga_produk);
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val('1');
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) input').val(data.harga_produk);
					$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(7) span').html(to_rupiah(data.harga_produk));
					HitungTotalBayar();
				}
			}
		});
	});

	$(document).on('keydown', '#jumlah_beli', function(e){
		var charCode = e.which || e.keyCode;
		if(charCode == 9){
			var Indexnya = $(this).parent().parent().index() + 1;
			var TotalIndex = $('#TabelTransaksi tbody tr').length;
			if(Indexnya == TotalIndex){
				BarisBaru();
				return false;
			}
		}

		HitungTotalBayar();
	});

	$(document).on('keyup', '#UangCash', function(){
		HitungTotalKembalian();
	});

	function HitungTotalBayar()
	{
		var Total = 0;
		$('#TabelTransaksi tbody tr').each(function(){
			if($(this).find('td:nth-child(7) input').val() > 0)
			{
				var SubTotal = $(this).find('td:nth-child(7) input').val();
				Total = parseInt(Total) + parseInt(SubTotal);
			}
		});

		$('#TotalBayar').html(to_rupiah(Total));
		$('#TotalBayarHidden').val(Total);

		$('#UangCash').val('0');
		$('#UangKembali').val('0');
	}

	function HitungTotalKembalian()
	{
		var Cash = $('#UangCash').val();
		var TotalBayar = $('#TotalBayarHidden').val();

		if(parseInt(Cash) >= parseInt(TotalBayar)){
			var Selisih = parseInt(Cash) - parseInt(TotalBayar);
			$('#UangKembali').val(to_rupiah(Selisih));
		} else {
			$('#UangKembali').val('0');
		}
	}

	function to_rupiah(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp. ' + rev2.split('').reverse().join('');
	}

	function check_int(evt) {
		var charCode = ( evt.which ) ? evt.which : event.keyCode;
		return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
	}
	
	//selain detail transaksi
	function tambah() {
      $.ajax({
			type: 'POST',
			url: "<?= site_url('penjualan/list_pelanggan/'); ?>",
			data: {'no_akses':"NULL"},
			cache: false,
			success: function(msg){
				$("#no_pelanggan").html(msg);
			}
		});
	  $('#modal-form-penjualan').fadeIn('slow');
      $('#modal-data-penjualan').fadeOut('slow');
	  $('#form-title').html("Tambah Penjualan");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-penjualan').fadeOut('slow');
      $('#modal-data-penjualan').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-penjualan')[0].reset();
    }
	
	// function edit(no_penjualan){
		// $.ajax({
			// url:'<?= site_url(); ?>/penjualan/data/',
			// data: {'no_penjualan':no_penjualan},
            // type:'POST',
			// dataType:'JSON',
			// success:function(msg){
				// $('input[name="aksi"]').val(msg.no_penjualan);
				// $('input[name="nama_penjualan"]').val(msg.nama_penjualan);
				// $('input[name="alamat_penjualan"]').val(msg.alamat_penjualan);
				// $('input[name="no_telepon"]').val(msg.no_telepon);
				// $('select[name="jenis_kelamin"]').val(msg.jenis_kelamin).change();
				
				// $('#modal-form-penjualan').fadeIn('slow');
				// $('#modal-data-penjualan').fadeOut('slow');
				// $('#form-title').html("Edit Data");
			// }
		// });
	// }
	
	new window.JustValidate('.js-form-penjualan', {
        rules: {
            tanggal_transaksi: {
                required: true
            },
            pembayaran: {
                required: true
            },
            kembalian: {
                required: true
            }
        },
		messages: {
		  tanggal_transaksi: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  pembayaran: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  kembalian: 'Form Tidak Boleh Kosong'
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('penjualan/tambah'); ?>";
		}else{
			var url = "<?= site_url('penjualan/ubah'); ?>";
		}
			var Cash = $('#UangCash').val();
			var TotalBayar = $('#TotalBayarHidden').val();

			if(parseInt(Cash) === 0){
				$.toast({
					heading: 'Bahaya',
					text: 'Pembayaran Tidak Boleh 0',
					position: 'top-right',
					showHideTransition: 'slide',
					icon: 'error',
					hideAfter: false
				});
			} else {
				
				var formData = new FormData($("#form-penjualan")[0]);
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
