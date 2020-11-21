<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_tung extends CI_Controller {
	
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
        $this->load->model('model_laporan_tung');
        $this->load->model('model_spp');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Laporan Tunggakan SPP',
			'judul'=>'Laporan Tunggakan SPP',
			'main_view'=>'view_laporan_tung'
		];
		$this->load->view('template/index', $data);
	}
	
	public function get_laporan_tung()
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

		$qw = $this->db->where(array('status_siswa' => 'Siswa', 'delete' => 0))->get('siswa')->result_array();
		// echo "<pre>"; print_r($qw); echo "</pre>"; die();

		$array = array();
		foreach ($qw as $data) {
			$count = $this->db->where(array('no_siswa' => $data['no_siswa'], 'YEAR(tanggal_transaksi)' => $tahun, 'MONTH(tanggal_transaksi)' => $bulan))->from('transaksi a')->join('spp b','a.no_transaksi = b.no_transaksi')->get()->num_rows();
			// var_dump($count." ".$data['no_siswa']);
			if ($count == 0) {
				$data['tanggal_transaksi']	= $data['tanggal_transaksi'];
				$data['nominal']			= 800000;
				$array[] = $data;
			}
		}
		// die('a');
		// echo "<pre>"; print_r($array); echo "</pre>"; die();
		
		echo "<center>
			    <h2>SD Abu Aziz</h2>
				<h2>Laporan Tunggakan SPP</h2>
				<h2>Periode ".$namabulan." ".$tahun." </h2>
				</br>
			  </center>";
		echo "<table class='table table-striped table-bordered table-hover'>
			<thead> 
				<tr>
					<th rowspan=2>No</th>
					<th rowspan=2>Tanggal Transaksi</th>
					<th rowspan=2>NIS</th>
					<th rowspan=2>Nama Siswa</th>
					<th rowspan=2>Biaya SPP</th>
					<th rowspan=2>Status Pembayaran</th>
				</tr> 
			</thead>";
			echo "<tbody>";
            $c=1; $total = 0;
			foreach($array as $row) {
				
					echo"<tr>";
		            echo"<td>".$c++."</td>";
		            echo"<td>".$row['tanggal_transaksi']."</td>";
					echo"<td>".$row['nis']."</td>";
					echo"<td>".$row['nama_siswa']."</td>";
					echo"<td align='right'>Rp. ".number_format($row['nominal'],2,',','.')."</td>";
					echo"<td>Belum Bayar</td>";	
					"<td></td>";
				}
				echo "<tfoot>
				<tr>
					<th colspan=4>Total</th>
					<th colspan=1 style='text-align:right;'>Rp. ". number_format($total, 2,',','.') ."</th>
					<th></th>
				</tr> 
			</tfoot>";
			echo "</tbody>";
		echo "</table>";
	}
}
