<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_pemb extends CI_Controller {
	
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
        $this->load->model('model_laporan_pemb');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Laporan Pendapatan SPP',
			'judul'=>'Laporan Pendapatan SPP',
			'main_view'=>'view_laporan_pemb'
		];
		$this->load->view('template/index', $data);
	}
	
	public function get_laporan_pemb()
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
		
		$this->db->select('a.no_akun, nama_akun, no_jurnal, nominal, posisi, a.no_transaksi, nama_transaksi, c.tanggal_transaksi, d.no_siswa, nis, nama_siswa');
		$this->db->from('jurnal a');
		$this->db->join('akun b','a.no_akun = b.no_akun');
		$this->db->join('transaksi c','c.no_transaksi = a.no_transaksi');
		$this->db->join('spp d','d.no_transaksi = a.no_transaksi');
		$this->db->join('siswa e','e.no_siswa = d.no_siswa');
		$this->db->where(array('MONTH(c.tanggal_transaksi)' => $bulan, 'YEAR(c.tanggal_transaksi)' => $tahun, 'nama_transaksi' => 'spp', 'a.no_akun' => '111'));
		$this->db->order_by('no_jurnal,tanggal_transaksi');
		$qw = $this->db->get()->result_array();
		
		$array = array();
		foreach ($qw as $data) {
			$count = $this->db->where(array('no_siswa' => $data['no_siswa'], 'YEAR(tanggal_transaksi)' => $tahun, 'MONTH(tanggal_transaksi)' => $bulan))->from('transaksi a')->join('spp b','a.no_transaksi = b.no_transaksi')->get()->num_rows();
			// var_dump($count." ".$data['no_siswa']);
			if ($count > 0) {
				$array[] = $data;
			}
		}
		
		echo "<center>
			    <h2>SD Abu Aziz</h2>
				<h2>Laporan Pendapatan SPP</h2>
				<h2>Periode ".$namabulan." ".$tahun." </h2>
				</br>
			  </center>";
		echo "<table class='table table-striped table-bordered table-hover'>
			<thead> 
				<tr>
					<th rowspan=2>No</th>
					<th rowspan=2>Tanggal Transaksi</th>
					<th rowspan=2>No Transaksi</th>
					<th rowspan=2>Biaya SPP</th>
				</tr> 
			</thead>";
			echo "<tbody>";
  			$c = 1; $total = 0;
			foreach($array as $row) {
					echo"<tr>";
					echo"<td>".$c++."</td>";
					echo"<td>".$row['tanggal_transaksi']."</td>";
					echo"<td>".$row['no_transaksi']."</td>";
					echo"<td>Rp. ".number_format($row['nominal'],2,',','.')."</td>";	
					echo"</tr>";
					$total=$total+$row['nominal'];	
				}

			echo "<tfoot>
				<tr>
					<th colspan=3>Total</th>
					<th colspan=1 style='text-align:right;'>Rp. ". number_format($total, 2,',','.') ."</th>
				</tr> 
			</tfoot>";
			echo "</tbody>";
		echo "</table>";
	}
}
