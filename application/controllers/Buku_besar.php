<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_besar extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
        $this->load->model('model_buku_besar');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Buku Besar',
			'query'=>$this->model_buku_besar->custom_query("select * from akun where no_akun in(select jurnal.no_akun from jurnal)"),
			'judul'=>'Buku Besar',
			'main_view'=>'view_buku_besar'
		];
		$this->load->view('template/index', $data);
	}
	
	public function get_bukubesar()
	{
		$id = $this->input->post('no_akun');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		// $tahun=substr($periode,0,4);
		// $bulan=substr($periode,5,2);
		$hari = 01;
		$batas =  date("$tahun-$bulan-01");
		if($bulan=="01"){
			$namabulan="Januari";
		}else if($bulan=="02"){
			$namabulan="Februari";
		}else if($bulan=="03"){
			$namabulan="Maret";
		}else if($bulan=="04"){
			$namabulan="April";
		}else if($bulan=="05"){
			$namabulan="Mei";
		}else if($bulan=="06"){
			$namabulan="Juni";
		}else if($bulan=="07"){
			$namabulan="Juli";
		}else if($bulan=="08"){
			$namabulan="Agustus";
		}else if($bulan=="09"){
			$namabulan="September";
		}else if($bulan=="10"){
			$namabulan="Oktober";
		}else if($bulan=="11"){
			$namabulan="November";
		}else if($bulan=="12"){
			$namabulan="Desember";
		}
		
		$saldo_awal = $this->model_buku_besar->custom_query("select akun.no_akun,akun.nama_akun,akun.jenis_akun,
										jurnal.no_jurnal,jurnal.nominal,jurnal.posisi,
										transaksi.no_transaksi,transaksi.nama_transaksi,transaksi.tanggal_transaksi
										from jurnal left join akun on jurnal.no_akun=akun.no_akun
										left join transaksi on jurnal.no_transaksi=transaksi.no_transaksi
										where akun.no_akun = '$id' and transaksi.tanggal_transaksi < '$batas' 
										order by jurnal.no_jurnal");
		
		$buku_besar = $this->model_buku_besar->custom_query("select akun.no_akun,akun.nama_akun,akun.jenis_akun,jurnal.no_jurnal,jurnal.nominal,jurnal.posisi,transaksi.no_transaksi,transaksi.nama_transaksi,transaksi.tanggal_transaksi
								from jurnal left join akun on jurnal.no_akun=akun.no_akun
								left join transaksi on jurnal.no_transaksi=transaksi.no_transaksi
								where jurnal.no_akun = '$id' and YEAR( transaksi.tanggal_transaksi ) = '$tahun' 
								and MONTH( transaksi.tanggal_transaksi ) = '$bulan' ");
		$saldoawal=0;
		$akun = $this->model_buku_besar->custom_query("select * from akun where no_akun='$id'");
		$hasilquery = $akun->row();
		$nama_akun = $hasilquery->nama_akun;
		$no_akun = $hasilquery->no_akun;
		foreach( $saldo_awal->result() as $b){
			if($b->jenis_akun=="aktiva"){
				if($b->posisi=="debit"){
					$saldoawal=$saldoawal+$b->nominal; 
					
				}else{
					$saldoawal=$saldoawal-$b->nominal;
								
				}
			}else{
				if($b->posisi=="debit"){
					$saldoawal=$saldoawal-$b->nominal;
					
				}else{
					$saldoawal=$saldoawal+$b->nominal;
									
				}
			}		
		 
		}
		
			echo "<center>
			        <h2>SD Abu Aziz</h2>
					<h2>Buku Besar ".$nama_akun."</h2>
					<h2>Periode ".$namabulan." ".$tahun." </h2>
					</br>
				  </center>";
		
			echo "<table class='table table-striped table-bordered table-hover'>
				<thead>
					<tr>
						<th rowspan=2>no</th>
						<th rowspan=2>tanggal</th>
						<th rowspan=2>nama akun</th>
						<th rowspan=2>ref</th>
						<th colspan=2></th>
						<th colspan=2>saldo</th>
					</tr>
					<tr>
						<th>debit</th>
						<th>kredit</th>
						<th>debit</th>
						<th>kredit</th>
					</tr>
					<tr>
						<th colspan=6 >Saldo Awal ".$nama_akun." - ".$id."</th>
						<th colspan=2 style='text-align:right;'>Rp.".number_format($saldoawal, 2,',','.')."</th>
					</tr>
				</thead>";
				echo "<tbody>";
				$no=1;
				$saldo=$saldoawal;
				foreach( $buku_besar->result() as $row){
						if($row->posisi=="debit"){ 
							echo"<td>".$no."</td>";
							echo"<td>".$row->tanggal_transaksi."</td>";
							echo"<td>".$row->nama_akun."</td>";
							echo"<td>".$row->no_akun."</td>";
							echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($row->nominal, 2,',','.'))."</td>";
							echo"<td></td>";
							if($row->jenis_akun =="aktiva"){
								if($row->posisi =="debit"){
								$saldo=$saldo+$row->nominal;
								}else{
								$saldo=$saldo-$row->nominal;
								}
								if($saldo>0){
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								echo"<td style='text-align:right;'></td>";
								}else{
								echo"<td style='text-align:right;'></td>";
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								}
							}else{
								if($row->posisi =="kredit"){
								$saldo=$saldo+$row->nominal;
								}else{
								$saldo=$saldo-$row->nominal;
								}
								if($saldo>0){
								echo"<td style='text-align:right;'></td>";
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								}else{
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								echo"<td style='text-align:right;'></td>";
								}
							}
						}else{
							echo"<td>".$no."</td>";
							echo"<td>".$row->tanggal_transaksi."</td>";
							echo"<td>".$row->nama_akun."</td>";
							echo"<td>".$row->no_akun."</td>";
							echo"<td></td>";
							echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
							if($row->jenis_akun =="aktiva"){
								if($row->posisi =="debit"){
								$saldo=$saldo-$row->nominal;
								}else{
								$saldo=$saldo+$row->nominal;
								}
								if($saldo>0){
								echo"<td style='text-align:right;'></td>";
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								}else{
								echo"<td style='text-align:right;'></td>";
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								}
							}else{
								if($row->posisi =="kredit"){
								$saldo=$saldo+$row->nominal;
								}else{
								$saldo=$saldo-$row->nominal;
								}
								if($saldo>0){
								echo"<td style='text-align:right;'></td>";
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								}else{
								echo"<td style='text-align:right;'>Rp. ".str_replace('-','',number_format($saldo, 2,',','.'))."</td>";
								echo"<td style='text-align:right;'></td>";
								}
							}
						}
					echo"</tr>"	;	
					$no++;
				}
				echo "</tbody>";
			echo "</table>";
	}
}
