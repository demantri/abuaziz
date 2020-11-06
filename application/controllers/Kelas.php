<?php
defined('BASEPATH') OR exit('no_kelas direct script access allowed');

class kelas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no_kelas-store, no_kelas-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no_kelas-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
        $this->load->model('Model_kelas');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Kelas',
			'judul'=>'Kelas',
			'main_view'=>'view_kelas'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->Model_kelas->get_datatables();
		$data = array();
		$no_kelas = $_POST['start'];
		foreach ($list as $kelas) {
			$no_kelas++;
			$row = array();
			$row[] = "<span class='size'>".$no_kelas."</span>";
			$row[] = "<span class='size'>".$kelas['no_siswa']."</span>";
			$row[] = "<span class='size'>".$kelas['nama_siswa']."</span>";
			$row[] = "<span class='size'>".$kelas['nama_kelas']."</span>";
			$row[] = "<span class='size'>".$kelas['nama_ajaran']."</span>";
			// $aksi = '';
			// 	$aksi.='
			// 	<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $kelas['no_kelas'].'\')">
			// 	<i class="fa fa-pencil"></i></a>';
			
			// 	// $aksi.='
			// 	// <a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $kelas->no_kelas.'\')">
			// 	// <i class="fa fa-trash"></i></a>';
			// $row[] = $aksi;

			$data[] = $row; 
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_kelas->count_all(),
						"recordsFiltered" => $this->Model_kelas->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	// public function tambah(){
		
	// 	$no_kelas = $this->Model_kelas->kode();
	// 	$data_kelas = array(
	// 		'no_kelas' => $no_kelas,
	// 		'no_siswa' => $this->input->post("no_siswa"),
	// 		'nama_kelas' => $this->input->post("nama_kelas"),
	// 		'delete' => "0"
	// 	);
		
	// 	$q = $this->Model_kelas->tambah('kelas', $data_kelas);
	// 	if($q){
	// 		echo json_encode(array('status' => "benar"));
	// 	}else{
	// 		echo json_encode(array('status' => "salah"));
	// 	}
	// }
	
	public function data()
	{
		$no_kelas = $this->input->post("no_kelas");
		$field = array('*');
		$condition = array(
			'no_kelas' => $no_kelas
		);
		$data = $this->Model_kelas->get_row('kelas', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_kelas = $this->input->post("aksi");
		$field = array('*');
		$data_kelas = array(
			'no_siswa' => $this->input->post("no_siswa"),
			// 'jenis_aset' => $this->input->post("jenis_aset"),
			'nama_kelas' => $this->input->post("nama_kelas")
		);
		$q = $this->Model_kelas->ubah("kelas", $data_kelas, "no_kelas = '$no_kelas' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_kelas = $this->input->post("no_kelas");
		$field = array('*');
		$data_kelas = array(
			'delete' => 1
		);
		$q = $this->Model_kelas->hapus("kelas", $data_kelas, "no_kelas = '$no_kelas' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
