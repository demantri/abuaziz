  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jurnal Umum
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=site_url('Welcome')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Jurnal Umum</a></li>
      </ol>
    </section>

    <!-- Main content -->
   <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">x
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border text-center">
           <!-- Button trigger modal -->
			<h3>SD ABU AZIZ</h3>
			<h3>JURNAL UMUM</h3>
			<h4>Periode <?=$this->input->post('bulan')." - ".$this->input->post('tahun')?> </h4>
        </div>
        <div class="box-body">
	   <div class="row">
	   
		<div class="col-md-8">
			<h4>Pilih Periode :</h4>
			<form method="POST" action="<?=site_url('Laporan')?>">
				<div class="col-md-4">
					<label for="">Bulan (Ex.11)</label>
					<input type="text" name="bulan" class="form-control" >
				</div>
				<div class="col-md-4">
					<label for="">Tahun (Ex.2019)</label>
					<input type="text" name="tahun" class="form-control" >
				</div>
				<br>
				<button type="submit" class="btn btn-primary"> Tampilkan</button>
			</form>
			</div>
	   </div>
	   <br><br>
            <table id="table2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Ref</th>
                        <th>Debet</th>
				    	<th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
			 <?php foreach($all as $row){ ?>
				<tr>
					<td><?=$row->tgl_jurnal?></td>
					<td><?=$row->no_akun?></td>
					<!-- posisi debet -->
					<?php if($row->posisi_dr_cr == 'dr'){ ?>
					<td class="text-left" ><?=$row->nama?></td>
					<?php } ?>
					<!-- posisi kredit -->
					<?php if($row->posisi_dr_cr == 'cr'){ ?>
					<td class="text-right" ><?=$row->nama?></td>
					<?php } ?>
					<td></td>
					<!-- posisi debet -->
					<?php if($row->posisi_dr_cr == 'dr'){ ?>
					<td class="text-left" ><?=$row->nominal?></td>
					<?php } ?>
					<td></td>
					<!-- posisi kredit -->
					<?php if($row->posisi_dr_cr == 'cr'){ ?>
					<td class="text-right" ><?=$row->nominal?></td>
					<?php } ?>
				
				</tr>
			 <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>