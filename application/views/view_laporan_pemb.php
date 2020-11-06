<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-laporan-pemb form" id="form-laporan-pemb">
					<label for="email_address">Pilih Bulan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<select data-validate-field="bulan" id="bulan"  name="bulan" class="form-control" >
								<option value="">Pilih Bulan</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>
					<label for="password">Pilih Tahun : </label>
					<div class="form-group">
						<div class="form-line">
							<select data-validate-field="tahun" id="tahun"  name="tahun" class="form-control" >
								<option value="">Pilih Tahun</option>
									<?php 
									$no = date('Y')+1;
									while($no>=2018){
										echo "<option value='$no'>$no</option>";
										$no--;
									} 
									?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" >Lihat Laporan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-laporan-pemb">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<div class="table-responsive" id="get-laporan-pemb"> 
				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Basic Examples -->
<script type="text/javascript">
$('#total_pengeluaran').number( true, 0,'', '' );
	
	new window.JustValidate('.js-form-laporan-pemb', {
        rules: {
            bulan: {
                required: true
            },
            tahun: {
                required: true
            }
        },
		messages: {
		  bulan: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  tahun: {
			required: 'Form Tidak Boleh Kosong'
		  }
		},

        submitHandler: function (form, values, ajax) {
			var url = "<?= site_url('laporan_pemb/get_laporan_pemb'); ?>";
			var formData = new FormData($("#form-laporan-pemb")[0]);
			// formData.append('content', content);
			$('#modal-laporan-pemb').fadeIn('slow');
			$.ajax({
			  url: url,
			  type : 'POST',
			  method: "POST",
			  data : formData,
			  contentType : false,
			  processData : false,
			  cache: false,
			  success: function(msg){
				//alert(msg);
				$("#get-laporan-pemb").html(msg);
			  }
			});
        },
    });
</script>
