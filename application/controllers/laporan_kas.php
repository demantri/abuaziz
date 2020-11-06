<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_kas extends CI_Controller {
	
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
        $this->load->model('model_laporan_kas');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Laporan Penerimaan',
			'judul'=>'Laporan Penerimaan Kas',
			'main_view'=>'view_laporan_kas'
		];
		$this->load->view('template/index', $data);
	}
	
	public function get_jurnal()
	{
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		// $tahun=substr($periode,0,4);
		// $bulan=substr($periode,5,2);
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
		
		$qw = $this->model_laporan_kas->custom_query("select akun.no_akun,akun.nama_akun,jurnal.no_jurnal,
						jurnal.nominal,jurnal.posisi,transaksi.no_transaksi,transaksi.nama_transaksi,
						transaksi.tanggal_transaksi,siswa.nama_siswa,daftar_ulang.no_siswa
						from jurnal 
						left join akun on jurnal.no_akun=akun.no_akun
						left join transaksi on jurnal.no_transaksi=transaksi.no_transaksi
						left join daftar_ulang on jurnal.no_transaksi=daftar_ulang.no_transaksi
						left join pendaftaran on jurnal.no_transaksi=pendaftaran.no_transaksi
						left join siswa on pendaftaran.no_siswa=pendaftaran.no_siswa
						
						where jurnal.no_transaksi like 'Npd%' OR jurnal.no_transaksi like 'Pdll%' OR jurnal.no_transaksi like 'Dfu%' 
						AND YEAR( transaksi.tanggal_transaksi ) = '$tahun' 
						and MONTH( transaksi.tanggal_transaksi ) = '$bulan' order by jurnal.no_jurnal")->result_array();
		
		$array = array();
		foreach ($qw as $data) {
			if ($data['no_akun'] == '111') {
				$array[]	= $data;
			}
		}
		// echo "<pre>"; print_r($array); echo "</pre>"; die();
		echo "<center>
				<h2>Laporan Kas Masuk</h2>
				<h2>Periode ".$namabulan." ".$tahun." </h2>
				</br>
			  </center>";
		echo "<table class='table table-striped table-bordered table-hover'>
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Transaksi</th>
					<th>Deskripsi</th>
					<th>Ref</th>
					<th>Nominal</th>
				</tr>
			</thead>";
			echo "<tbody>";
			$c=1;
			$total=0;
			foreach($array as $row){
					echo"<tr>";
						echo"<td>".$c."</td>";
						echo"<td>".date('d-m-Y', strtotime($row['tanggal_transaksi']))."</td>";
						echo"<td>".$row['nama_transaksi']." ".date('F Y', strtotime($row['tanggal_transaksi']))." - ".$row['no_siswa']."</td>";
						echo"<td>".$row['no_akun']."</td>";
						echo"<td style='text-align:right;'>Rp. ". number_format($row['nominal'], 2,',','.') ."</td>";
					echo"</tr>"	;
					$total=$total+$row['nominal'];						
			$c++;
			}

			echo "</tbody>";
			echo "<tfoot>
				<tr>
					<th colspan=4>Total</th>
					<th style='text-align:right;'>Rp. ". number_format($total, 2,',','.') ."</th>
				</tr> 
			</tfoot>";
		echo "</table>";
	}
}
