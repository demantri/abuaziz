<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spp extends CI_Controller {
	
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
        $this->load->model('model_spp');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data SPP Bulanan',
			'judul'=>'SPP Bulanan',
			'main_view'=>'view_spp'
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_siswa()
	{
		$q = $this->db->where(array('a.delete' => 0, 'status_siswa' => 'Siswa'))->from('siswa a')->join('tahun_ajaran b','a.angkatan = b.no')->join('kelas c','a.no_siswa = c.no_siswa')->get()->result();
		
		if($q){
			echo "<select name='no_siswa' id='no_siswa' data-validate-field='no_siswa' class='form-control'>
            <option value =''>--Pilih Siswa--</option>";
			foreach($q as $row){
				$count = $this->db->select('count(a.no_transaksi) as no')->from('daftar_ulang a')->join('transaksi b','a.no_transaksi = b.no_transaksi')->where(array('YEAR(tanggal_transaksi)' => date('Y'), 'no_siswa' => $row->no_siswa))->get()->row_array()['no'];
				if ($count > 0) {
					echo "<option value='".$row->no_siswa."'>".$row->nama_siswa." - Angkatan ".$row->nama_ajaran." - Kelas ".$row->nama_kelas."</option>";
				}
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}

	public function listajaran()
	{
		$q = $this->db->where('delete', 0)->get('tahun_ajaran')->result();
		
		if($q){
			echo "<select name='no_ajaran' id='no_ajaran' data-validate-field='no_ajaran' class='form-control'>
            <option value =''>--Pilih Tahun Ajaran--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_ajaran'>$row->nama_ajaran</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}

	public function get_harga()
	{
		$data = $this->db->where('no_ajaran', $_POST['no'])->get('tahun_ajaran')->row()->harga_ajaran;
		echo json_encode($data);
	}
	
	public function ajax_list()
	{
		if ($_POST['bulan'] != null AND $_POST['tahun'] != null) {
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}
		
		$list = $this->model_spp->get_datatables();
		$arr = array();
		foreach ($list as $row) {
			$count = $this->db->select('sum(a.no_transaksi) as total, tanggal_transaksi')->where(array('no_siswa' => $row['no_siswa'], 'YEAR(tanggal_transaksi)' => $tahun, 'MONTH(tanggal_transaksi)' => $bulan))->from('transaksi a')->join('spp b','a.no_transaksi = b.no_transaksi')->get()->row_array();
			
			if ($count['total'] != null) {
				$row['status']  = 'Sudah Bayar';
				$row['tgl'] 	= $count['tanggal_transaksi'];
				$row['periode']	= date('F Y', strtotime($count['tanggal_transaksi']));
				$arr[]			= $row;
			} else {
				$arr[]	= array(
					'nis' 		=> $row['nis'],
					'nama_siswa'=> $row['nama_siswa'],
					'no_siswa'	=> $row['no_siswa'],
		            'biaya_spp' => 800000,
					'status'	=> 'Belum Bayar',
					'tgl' 		=> '',
					'periode'	=> date('F Y', strtotime($tahun."-".$bulan."-01"))
				);
			}
		}
		
		$data = array();
		$no = $_POST['start'];
		foreach ($arr as $siswa) {
			$no++;
			$spasi = "&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;";
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$siswa['nis']."</span>";
			$row[] = "<span class='size'>".$siswa['nama_siswa']."</span>";
			$row[] = "<span class='size'>".$siswa['tgl']."</span>";
			// $row[] = "<span class='size'>".date($siswa->tanggal_transaksi)."</span>";
			$row[] = $spasi."<span class='size'>Rp.".number_format($siswa['biaya_spp'],2,',','.')."</span>";
			$row[] = "<span class='size'>".$siswa['periode']."</span>";
			$row[] = "<span class='size'>".$siswa['status']."</span>";
			$aksi = '';
			if ($siswa['status'] == 'Sudah Bayar') {
			$aksi ='<a class="btn btn-xs btn-info" title="Cetak" href='.site_url('spp/printpdf/'.$siswa['no_siswa']).' target="_blank">
				<i class="fa fa-print"></i></a>';
				}
			$row[] = $aksi;
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_spp->count_all(),
						"recordsFiltered" => $this->model_spp->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function printpdf($id)
	{
		$data['main_view']	= 'bukti_transaksi';
		$data['result']		= $this->getDatatrx($id);
		$this->load->view('template/print', $data);
	}

	public function getDatatrx($id)
	{
		return $this->db->select('*')->from('siswa a')->join('spp b', 'a.no_siswa = b.no_siswa')->join('transaksi c', 'b.no_transaksi = c.no_transaksi')->where('b.no_siswa', $id)->get()->result();
	}

	public function tambah(){
		
		$no_transaksi = $this->model_spp->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "spp",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_spp->tambah('transaksi', $data_transaksi);
		
		$data_spp = array(
			'no_transaksi' => $no_transaksi,
			'no_siswa' => $this->input->post("no_siswa"),
			'biaya_spp' => $this->input->post("biaya_spp"),
			'keterangan' => date('F')
		);
		
		$spp = $this->model_spp->tambah('spp', $data_spp);
		if($spp){
			$jurnal1 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "111",
				'posisi' => "debit",
				'nominal' => $this->input->post("biaya_spp")
			);
			$query_jurnal1 = $this->model_spp->tambah("jurnal", $jurnal1);
			
			$jurnal2 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "411",
				'posisi' => "kredit",
				'nominal' => $this->input->post("biaya_spp")
			);
			$query_jurnal2 = $this->model_spp->tambah("jurnal", $jurnal2);
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function print_excel_(){
	    header("Content-type=appalication/vnd.ms.excel");
	    header("Content-disposition: attachment; filename=bukti_transaksi.xls");
	    $data['result'] = $this->model_spp->cek_spp();
	    $this->load->view('bukti_transaksi', $data);
	    //$this->template->load('template', 'laporan_pnj', $data);
  	} 

  	public function validasi()
  	{
		$count = $this->db->where(array('no_siswa' => $_POST['no_siswa'], 'YEAR(tanggal_transaksi)' => date('Y', strtotime($_POST['tgl'])), 'MONTH(tanggal_transaksi)' => date('m', strtotime($_POST['tgl']))))->from('transaksi a')->join('spp b','a.no_transaksi = b.no_transaksi')->get()->num_rows();
		  
		$biaya = $this->db->where('no_siswa', $_POST['no_siswa'])->from('siswa a')->join('tahun_ajaran b','a.angkatan = b.no')->get()->row_array()['harga_ajaran'];
  		echo json_encode(array('vali' => $count, 'biaya' => $biaya));
  	}

}
