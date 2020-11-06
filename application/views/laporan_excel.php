
	<head>
	</head>
	<body>
		<h3>Laporan Penj</h3>
		<table border="1">
			<tr>
				<th>Id Transaksi</th>
				<th>Tanggal Transaksi</th>
				<th>Total Transaksi</th>
			</tr>
			<?php
				$total = 0;
				foreach($result as $data){
					
						echo "
							<tr>
								<td>".$data['no_transaksi']."</td>
								<td>".$data['tanggal']."</td>
								<td align = 'right'>".format_rp($data['total'])."</td>
							</tr>";
					
					$total = $total + $data['total'];
				}
			?>
			<tr>
				<td colspan = 2></td>
				<td align = 'right'><?php echo format_rp($total);?></td>
			</tr>
		</table>
	</body>
</html>
