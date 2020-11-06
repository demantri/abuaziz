		<h3>Detail Pendaftaran siswa</h3>
		<table class="table table-hover table-striped table-bordered">
			<tr>
				<th>NIS</th>
				<th>Nama Siswa</th>
				<th>Tanggal Transaksi</th>
				<th>Biaya Pendaftaran Yang dibayarkan</th>
				<th>Pembayaran</th>
				<th>Sisa Pembayaran</th>

			</tr>
			<?php
				$total = 0;
				foreach($result as $data){
					
						echo "
							<tr>
								<td>".$data->no_siswa."</td>
								<td>".$data->nama_siswa."</td>
								<td>".date('d F Y', strtotime($data->tanggal_transaksi))."</td>
								<td align = 'right'>".number_format($data->biaya_pendaftaran)."</td>
								<td align = 'right'>".number_format($data->pembayaran)."</td>
								<td align = 'right'>".number_format($data->sisa_pembayaran)."</td>
							</tr>";
							$total += $data->pembayaran;
				}
			?>
			<tr>
				
				<td colspan = 4>Total</td>
				<strong><td align = 'right'><?php echo number_format($total,0,',','.');?></td></strong>
				<td></td>
			</tr>
		</table>
