<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	
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
        $this->load->model('model_pegawai');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Pegawai',
			'judul'=>'Pegawai',
			'main_view'=>'view_pegawai'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_pegawai->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pegawai) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$pegawai->nip."</span>";
			$row[] = "<span class='size'>".$pegawai->nama_pegawai."</span>";
			$row[] = "<span class='size'>".$pegawai->alamat_pegawai."</span>";
			$row[] = "<span class='size'>".$pegawai->no_telepon."</span>";
			$row[] = "<span class='size'>".$pegawai->jenis_kelamin."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $pegawai->no_pegawai.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $pegawai->no_pegawai.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_pegawai->count_all(),
						"recordsFiltered" => $this->model_pegawai->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no_pegawai = $this->model_pegawai->kode();
		$data_pegawai = array(
			'no_pegawai' => $no_pegawai,
			'nip' => $this->input->post("nip"),
			'nama_pegawai' => $this->input->post("nama_pegawai"),
			'alamat_pegawai' => $this->input->post("alamat_pegawai"),
			'no_telepon' => $this->input->post("no_telepon"),
			'jenis_kelamin' => $this->input->post("jenis_kelamin"),
			'delete' => "0"
		);
		
		$q = $this->model_pegawai->tambah('pegawai', $data_pegawai);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no_pegawai = $this->input->post("no_pegawai");
		$field = array('*');
		$condition = array(
			'no_pegawai' => $no_pegawai
		);
		$data = $this->model_pegawai->get_row('pegawai', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_pegawai = $this->input->post("aksi");
		$field = array('*');
		$data_pegawai = array(
			'nip' => $this->input->post("nip"),
			'nama_pegawai' => $this->input->post("nama_pegawai"),
			'alamat_pegawai' => $this->input->post("alamat_pegawai"),
			'no_telepon' => $this->input->post("no_telepon"),
			'jenis_kelamin' => $this->input->post("jenis_kelamin")
		);
		$q = $this->model_pegawai->ubah("pegawai", $data_pegawai, "no_pegawai = '$no_pegawai' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_pegawai = $this->input->post("no_pegawai");
		$field = array('*');
		$data_pegawai = array(
			'delete' => 1
		);
		$q = $this->model_pegawai->hapus("pegawai", $data_pegawai, "no_pegawai = '$no_pegawai' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
