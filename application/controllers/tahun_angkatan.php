<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tahun_angkatan extends CI_Controller {
	
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
        $this->load->model('Model_tahun_angkatan');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Tahun Angkatan',
			'judul'=>'Tahun Angkatan',
			'main_view'=>'view_tahun_angkatan'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->Model_tahun_angkatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $tahun_angkatan) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$tahun_angkatan->nama_angkatan."</span>";
			// $row[] = "<span class='size'>".$aset->jenis_aset."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($tahun_angkatan->harga_angkatan,2,',','.')."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $tahun_angkatan->no_angkatan.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				// $aksi.='
				// <a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $tahun_angkatan->no_angkatan.'\')">
				// <i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row; 
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_tahun_angkatan->count_all(),
						"recordsFiltered" => $this->Model_tahun_angkatan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no_angkatan = $this->Model_tahun_angkatan->kode();
		$data_tahun_angkatan = array(
			'no_angkatan' => $no_angkatan,
			'nama_angkatan' => $this->input->post("nama_angkatan"),
			'harga_angkatan' => $this->input->post("harga_angkatan"),
			'delete' => "0"
		);
		
		$q = $this->Model_tahun_angkatan->tambah('tahun_angkatan', $data_tahun_angkatan);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no_angkatan = $this->input->post("no_angkatan");
		$field = array('*');
		$condition = array(
			'no_angkatan' => $no_angkatan
		);
		$data = $this->Model_tahun_angkatan->get_row('tahun_angkatan', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_angkatan = $this->input->post("aksi");
		$field = array('*');
		$data_tahun_angkatan = array(
			'nama_angkatan' => $this->input->post("nama_angkatan"),
			// 'jenis_aset' => $this->input->post("jenis_aset"),
			'harga_angkatan' => $this->input->post("harga_angkatan")
		);
		$q = $this->Model_tahun_angkatan->ubah("tahun_angkatan", $data_tahun_angkatan, "no_angkatan = '$no_angkatan' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_angkatan = $this->input->post("no_angkatan");
		$field = array('*');
		$data_tahun_angkatan = array(
			'delete' => 1
		);
		$q = $this->Model_tahun_angkatan->hapus("tahun_angkatan", $data_tahun_angkatan, "no_angkatan = '$no_angkatan' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
