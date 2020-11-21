<?php
/**
 * 
 */
class laporan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
		$this->load->model('m_laporan');
	}
	public function index(){
		$data = array(
			'pendapatan'=> $this->m_laporan->pendapatan(),
			'judul_form'=>'Laporan',
			'judul'=>'Pendapatan SPP',
			'main_view'=>'laporan'
		);
		$this->load->view('template/index', $data);

	}

	public function pendapatan()
	{
		$data = [
			'judul_form'=>'Laporan Pemasukan',
			'judul'=>'Laporan Pemasukan',
			'main_view'=>'view_laporan_pendapatan'
		];

		$find = [];
		if($this->input->get('tipe_laporan') == 'bulanan'){
			$find = [
				'MONTH(tanggal_transaksi)' => $this->input->get('bulan'),
				'YEAR(tanggal_transaksi)'  => $this->input->get('tahun')
			];

		}else if($this->input->get('tipe_laporan') == 'tahunan'){
			$find = [
				'YEAR(tanggal_transaksi)'  => $this->input->get('tahun')
			];

		}else if($this->input->get('tipe_laporan') == 'semester'){
			if($this->input->get('bulan') == '1'){
				$thn   = $this->input->get('tahun');
				$start = $thn."-07-01";
				$end   = $thn."-12-31";
				$find = 'tanggal_transaksi BETWEEN "'.$start.'" AND "'.$end.'"';
			}else{
				$thn   = $this->input->get('tahun') + 1;
				$start = $thn."-01-01";
				$end   = $thn."-06-31";
				$find = 'tanggal_transaksi BETWEEN "'.$start.'" AND "'.$end.'"';
			}
		}

		$data['list'] = $this->_laporan('pendapatan', $find);
		$this->load->view('template/index', $data);
	}

	public function pengeluaran()
	{
		$data = [
			'judul_form'=>'Laporan Pengeluaran',
			'judul'=>'Laporan Pengeluaran',
			'main_view'=>'view_laporan_pengeluaran'
		];

		$find = [];
		if($this->input->get('tipe_laporan') == 'bulanan'){
			$find = [
				'MONTH(tanggal_transaksi)' => $this->input->get('bulan'),
				'YEAR(tanggal_transaksi)'  => $this->input->get('tahun')
			];

		}else if($this->input->get('tipe_laporan') == 'tahunan'){
			$find = [
				'YEAR(tanggal_transaksi)'  => $this->input->get('tahun')
			];

		}else if($this->input->get('tipe_laporan') == 'semester'){
			if($this->input->get('bulan') == '1'){
				$thn   = $this->input->get('tahun');
				$start = $thn."-07-01";
				$end   = $thn."-12-31";
				$find = 'tanggal_transaksi BETWEEN "'.$start.'" AND "'.$end.'"';
			}else{
				$thn   = $this->input->get('tahun') + 1;
				$start = $thn."-01-01";
				$end   = $thn."-06-31";
				$find = 'tanggal_transaksi BETWEEN "'.$start.'" AND "'.$end.'"';
			}
		}

		$data['list'] = $this->_laporan('beban', $find);
		$this->load->view('template/index', $data);
	}

		private function _laporan($tipe, $find){
			$this->db->where($find)
					 ->order_by('transaksi.tanggal_transaksi', 'DESC');

			if($tipe == 'pendapatan_lain'){
				$this->db->join('pendapatan_lain_lain', 'pendapatan_lain_lain.no_transaksi = transaksi.no_transaksi')
						 ->join('master_pendapatan', 'master_pendapatan.no_pendapatan = pendapatan_lain_lain.no_pendapatan');
			
			}else if($tipe == 'beban'){
				$this->db->select('*, transaksi.no_transaksi AS no_trans')
						 ->join('pembayaran_beban', 'pembayaran_beban.no_transaksi = transaksi.no_transaksi','LEFT')
						 ->join('beban_beban', 'beban_beban.no_beban = pembayaran_beban.no_beban','LEFT')
						 ->join('pengeluaran_lain_lain', 'pengeluaran_lain_lain.no_transaksi = transaksi.no_transaksi', 'LEFT')
						 ->join('master_pengeluaran', 'master_pengeluaran.no_pengeluaran = pengeluaran_lain_lain.no_pengeluaran', 'LEFT')
						 ->group_start()
						 	->where('nama_transaksi', 'beban')
						 	->or_where('nama_transaksi', 'pengeluaran lain-lain')
						 ->group_end();
			
			}else if($tipe == 'pengeluaran_lain'){
				$this->db->join('pengeluaran_lain_lain', 'pengeluaran_lain_lain.no_transaksi = transaksi.no_transaksi')
						 ->join('master_pengeluaran', 'master_pengeluaran.no_pengeluaran = pengeluaran_lain_lain.no_pengeluaran');
			
			}else if($tipe == 'pendapatan'){
				$this->db->select('*, transaksi.no_transaksi AS no_trans, master_pendapatan.nama_pendapatan AS nama_master_pendapatan, 
					pendapatan_lain_lain.jumlah_pendapatan AS jumlah_master_pendapatan,
					pendapatan.nama_pendapatan AS nama_pendek_pendapatan,
					pendapatan.jumlah_pendapatan AS jumlah_pendek_pendapatan')
						 ->join('pendapatan', 'pendapatan.no_transaksi = transaksi.no_transaksi', 'LEFT')
						 ->join('pendapatan_lain_lain', 'pendapatan_lain_lain.no_transaksi = transaksi.no_transaksi', 'LEFT')
						 ->join('master_pendapatan', 'master_pendapatan.no_pendapatan = pendapatan_lain_lain.no_pendapatan', 'LEFT')
						 ->join('daftar_ulang', 'daftar_ulang.no_transaksi = transaksi.no_transaksi','LEFT')
						 ->join('spp', 'spp.no_transaksi = transaksi.no_transaksi', 'LEFT')
						 ->group_start()
						 	->where('nama_transaksi', 'pendapatan')
						 	->or_where('nama_transaksi', 'daftar ulang')
						 	->or_where('nama_transaksi', 'spp')
						 	->or_where('nama_transaksi', 'pendapatan lain-lain')
						 ->group_end();
			}
			return $this->db->get('transaksi')->result_array();
		}
}