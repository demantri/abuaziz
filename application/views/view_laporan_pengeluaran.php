<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="modal-form-pengeluaran_dll">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title">Laporan Pengeluaran</h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<hr>
			<form method="GET">
                <div class="row">
                  <div class="col-md-2">
                  	<label><b>Tipe Laporan</b></label>
                  	<select class="form-control" id="tipe_laporan" required="" name="tipe_laporan">
                  		<option value="">Pilih</option>
                  		<option <?php if($this->input->get('tipe_laporan') == 'bulanan'){ echo "selected='selected'"; } ?> value="bulanan">Bulanan</option>
                  		<option <?php if($this->input->get('tipe_laporan') == 'semester'){ echo "selected='selected'"; } ?> value="semester">Semester</option>
                  		<option <?php if($this->input->get('tipe_laporan') == 'tahunan'){ echo "selected='selected'"; } ?> value="tahunan">Tahunan</option>
                  	</select>
                  </div>

                  <div id="bulanan">
                  	<div class="col-md-2">
	                    <label><b>Bulan</b></label>
	                    <select class="form-control filter" id="bulanan_bulan">
	                      <?php for ($i = 1 ; $i <= 12 ; $i++){ ?>
	                          <option <?php if($this->input->get('bulan') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo get_monthname($i) ?></option>
	                      <?php } ?>
	                    </select>
	                  </div>

	                  <div class="col-md-2">
	                    <label><b>Tahun</b></label>
	                    <select class="form-control filter" id="bulanan_tahun">
	                      <?php for ($i = 2019 ; $i <= (date('Y')+ 1) ; $i++){ ?>
	                          <option <?php if($this->input->get('tahun') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
	                      <?php } ?>
	                    </select>
	                  </div>
                  </div>

                  <div id="semester">
                  	<div class="col-md-2">
	                    <label><b>Semester</b></label>
	                    <select class="form-control filter" id="semester_bulan">
	                      <option value="1" <?php if($this->input->get('bulan') == '1'){ echo "selected='selected'"; } ?>>1</option>
	                      <option value="2"<?php if($this->input->get('bulan') == '2'){ echo "selected='selected'"; } ?>>2</option>
	                    </select>
	                  </div>

	                  <div class="col-md-2">
	                    <label><b>Tahun</b></label>
	                    <select class="form-control filter" id="semester_tahun">
	                      <?php for ($i = 2019 ; $i <= (date('Y')+ 1) ; $i++){
	                      			$next = $i + 1; 
	                      ?>
	                          <option <?php if($this->input->get('tahun') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i." / ".$next ?></option>
	                      <?php } ?>
	                    </select>
	                  </div>
                  </div>

                  <div id="tahunan">
	                  <div class="col-md-2">
	                    <label><b>Tahun</b></label>
	                    <select class="form-control filter" id="tahunan_tahun">
	                      <?php for ($i = 2019 ; $i <= (date('Y')+ 1) ; $i++){ ?>
	                          <option <?php if($this->input->get('tahun') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
	                      <?php } ?>
	                    </select>
	                  </div>
                  </div>
                  

                  <div class="col-md-1">
                    <br>
                    <button style="margin-top: 8px" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i></button>
                  </div>
                </div>

              </form>

              <br>

              <?php if($this->input->get('tipe_laporan')){ 
              			$tipe = $this->input->get('tipe_laporan');
              			if($tipe == 'bulanan'){
              				$txt = 'Periode Bulan '. get_monthname($this->input->get('bulan'))." Tahun ".$this->input->get('tahun');
              			
              			}else if($tipe == 'tahunan'){
              				$txt = 'Periode Tahun '.$this->input->get('tahun');
              			
              			}else if($tipe == 'semester'){
              				$next = $this->input->get('tahun') + 1;
              				$txt = 'Periode Semester '.$this->input->get('bulan')." Tahun ".$this->input->get('tahun')." / ".$next;
              			}
              ?>

              		<center>
	                  <hr>
	                    <h6>LAPORAN PENGELUARAN </h6>
	                    <h5>YAYASAN MA'HAD ABU AZIZ</h5>
	                    <?= $txt ?>
	                    
	                  <hr>
	                </center>

	                <table class="table">
	                	<thead>
	                		<tr>
	                			<th style="width: 5%">No</th>
	                			<th>No Transaksi</th>
	                			<th>Tanggal Transaksi</th>
	                			<th>Beban</th>
	                			<th class="text-center">Nominal</th>
	                		</tr>
	                	</thead>

	                	<tbody>
	                		<?php 
	                		$no = 0; $total = 0;
	                		foreach ($list as $row) { $no++;
	                			if($row['nama_transaksi'] == 'beban'){
	                				$nama_transaksi = $row['nama_beban'];
	                				$total_pengeluaran = format_rp($row['total_pengeluaran']);
	                				$total += $row['total_pengeluaran'];
	                			
	                			}else{
	                				$nama_transaksi = $row['nama_pengeluaran'];
	                				$total_pengeluaran = format_rp($row['jumlah_pengeluaran']);
	                				$total += $row['jumlah_pengeluaran'];
	                			}
	                			
	                		?>
	                			<tr>
	                				<td><?= $no ?></td>
	                				<td><?= $row['no_trans'] ?></td>
	                				<td><?= date('d F Y', strtotime($row['tanggal_transaksi'])) ?></td>
	                				<td><?= $nama_transaksi ?></td>
	                				<td class="text-right"><?= $total_pengeluaran ?></td>
	                			</tr>
	                		<?php } ?>

	                		<tr>
	                			<th colspan="4">TOTAL</th>
	                			<th class="text-right"><?= format_rp($total) ?></th>
	                		</tr>
	                	</tbody>
	                </table>
              <?php } ?>
               

		</div>
	</div>
</div>

<script type="text/javascript">
	var tipe_laporan = "<?= $this->input->get('tipe_laporan') ?>";
	
	show_filter(tipe_laporan);

	$(document).on('change', '#tipe_laporan', function(){
		show_filter($(this).val());
	});

	function hide_all(){
		$('#bulanan').hide();
		$('#semester').hide();
		$('#tahunan').hide();
	}

	function show_filter(tipe){
		$('.filter').removeAttr('name');

		if(tipe != ''){
			$('#' + tipe + "_bulan").attr('name','bulan');
			$('#' + tipe + "_tahun").attr('name','tahun');
		}

		if(tipe == 'bulanan'){
			$('#bulanan').show();
			$('#semester').hide();
			$('#tahunan').hide();

		}else if(tipe == 'semester'){
			$('#bulanan').hide();
			$('#semester').show();
			$('#tahunan').hide();
		
		}else if(tipe == 'tahunan'){
			$('#bulanan').hide();
			$('#semester').hide();
			$('#tahunan').show();
		}else{
			hide_all();
		}
	}
</script>