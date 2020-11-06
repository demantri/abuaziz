		<h3>Bukti Transaksi Daftar Ulang </h3>
		<h4><?php echo $siswa?></h4>
		<table class="table table-hover table-striped table-bordered">
			<tr>
				<!-- <th>NIS</th>
				<th>Nama Siswa</th> -->
				<th>Tanggal Transaksi</th>
				<th>Biaya Daftar Ulang</th>
				<th>Pembayaran</th>
				<th>Sisa Pembayaran</th>

			</tr>
			<?php
				$total = 0;
				foreach($result as $data){
					
						echo "
							<tr>

								<td>".date('d F Y', strtotime($data->tanggal_transaksi))."</td>
								<td align = 'right'>".number_format($data->biaya_daftar_ulang)."</td>
								<td align = 'right'>".number_format($data->pembayaran)."</td>
								<td align = 'right'>".number_format($data->sisa_pembayaran)."</td>
							</tr>";
							$total += $data->pembayaran;
				}
			?>
			<tr>
				<td colspan = 2>Total</td>
				<td align = 'right'><?php echo number_format($total,0,',','.');?></td>
				<td></td>
			</tr>
		</table>
		<p align="right">SD ABU AZIZ
			<br>
		<?php echo date('d-m-Y');?>
		&ensp;
		</p>
		<br>
		<br>
		<br>
		<p align="right">(&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;)
		</p>