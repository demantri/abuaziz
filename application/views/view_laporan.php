<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary" align="center">Laporan Pendapatan SPP</h5>
                </div>
                <div class="table-responsive">
                	<table class="table table-bordered">
                		<thead>
                			<tr>
                				<th>Tanggal Transaksi</th>
                				<th>NIS</th>
                				<th>Nama Siswa</th>
                				<th>Tahun Ajaran</th>
                				<th>Biaya SPP</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php $total=0; foreach($pendapatan as $row) { ?>
                			<tr>
                				<td><?= $row->tanggal_transaksi ?></td>
                				<td><?= $row->nis?></td>
                				<td><?= $row->nama_siswa?></td>
                				<td><?= $row->biaya_spp?></td>
                			</tr>
                		<?php $total=$total+$row->biaya_spp; }?>
                		</tbody>
                		<tfoot>
                			<tr>
                				<td colspan="4">Total</td>
                				<td><?= $total?>.</td>
                			</tr>
                		</tfoot>
                	</table>
                </div>
            </div>
        </div>
