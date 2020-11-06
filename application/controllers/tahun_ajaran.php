<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tahun_ajaran extends CI_Controller {
	
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
        $this->load->model('Model_tahun_ajaran');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Tahun Angkatan',
			'judul'=>'Tahun Angkatan',
			'main_view'=>'view_tahun_ajaran'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->Model_tahun_ajaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $tahun_ajaran) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$tahun_ajaran['nama_ajaran']."</span>";
			// $row[] = "<span class='size'>".$aset->jenis_aset."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($tahun_ajaran['harga_ajaran'],2,',','.')."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $tahun_ajaran['no'].'\')">
				<i class="fa fa-pencil"></i></a>';
			
				// $aksi.='
				// <a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $tahun_ajaran->no.'\')">
				// <i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row; 
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_tahun_ajaran->count_all(),
						"recordsFiltered" => $this->Model_tahun_ajaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no = $this->Model_tahun_ajaran->kode();
		$data_tahun_ajaran = array(
			'no' => $no,
			'nama_ajaran' => $this->input->post("nama_ajaran"),
			'harga_ajaran' => $this->input->post("harga_ajaran"),
			'delete' => "0"
		);
		
		$q = $this->Model_tahun_ajaran->tambah('tahun_ajaran', $data_tahun_ajaran);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no = $this->input->post("no");
		$field = array('*');
		$condition = array(
			'no' => $no
		);
		$data = $this->Model_tahun_ajaran->get_row('tahun_ajaran', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no = $this->input->post("aksi");
		$field = array('*');
		$data_tahun_ajaran = array(
			'nama_ajaran' => $this->input->post("nama_ajaran"),
			// 'jenis_aset' => $this->input->post("jenis_aset"),
			'harga_ajaran' => $this->input->post("harga_ajaran")
		);
		$q = $this->Model_tahun_ajaran->ubah("tahun_ajaran", $data_tahun_ajaran, "no = '$no' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no = $this->input->post("no");
		$field = array('*');
		$data_tahun_ajaran = array(
			'delete' => 1
		);
		$q = $this->Model_tahun_ajaran->hapus("tahun_ajaran", $data_tahun_ajaran, "no = '$no' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
