		<h3>Bukti Transaksi</h3>
		<table class="table table-hover table-striped table-bordered">
			<tr>
				<th>Nama Siswa</th>
				<th>Tanggal Transaksi</th>
				<th>Biaya SPP Bulanan</th>

			</tr>
			<?php
				$total = 0;
				foreach($result as $data){
					
						echo "
							<tr>
								<td>".$data->nama_siswa."</td>
								<td>".$data->tanggal_transaksi."</td>
								<td align = 'right'>Rp.".number_format($data->biaya_spp)."</td>
							</tr>";
							$total += $data->biaya_spp;
				}
			?>
			<tr>
				<td colspan = 2>Total</td>
				<td align = 'right'>Rp.<?php echo number_format($total,0,',','.');?></td>
			</tr>
		</table>
