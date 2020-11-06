<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
	
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
        $this->load->model('model_akun');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Akun',
			'judul'=>'Akun',
			'main_view'=>'view_akun'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_akun->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $akun) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$akun->no_akun."</span>";
			$row[] = "<span class='size'>".$akun->nama_akun."</span>";
			$row[] = "<span class='size'>".$akun->jenis_akun."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $akun->no_akun.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $akun->no_akun.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_akun->count_all(),
						"recordsFiltered" => $this->model_akun->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$data_akun = array(
			'no_akun' => $this->input->post("no_akun"),
			'nama_akun' => $this->input->post("nama_akun"),
			'jenis_akun' => $this->input->post("jenis_akun"),
			'delete' => "0"
		);
		
		$q = $this->model_akun->tambah('akun', $data_akun);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no_akun = $this->input->post("no_akun");
		$field = array('*');
		$condition = array(
			'no_akun' => $no_akun
		);
		$data = $this->model_akun->get_row('akun', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_akun = $this->input->post("aksi");
		$data_akun = array(
			'nama_akun' => $this->input->post("nama_akun"),
			'jenis_akun' => $this->input->post("jenis_akun")
		);
		$q = $this->model_akun->ubah("akun", $data_akun, "no_akun = '$no_akun' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_akun = $this->input->post("no_akun");
		$data_akun = array(
			'delete' => 1
		);
		$q = $this->model_akun->hapus("akun", $data_akun, "no_akun = '$no_akun' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
