<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beban_beban extends CI_Controller {
	
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
        $this->load->model('model_beban_beban');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Beban beban',
			'judul'=>'Beban beban',
			'main_view'=>'view_beban_beban'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_beban_beban->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $beban_beban) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$beban_beban->nama_beban."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $beban_beban->no_beban.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $beban_beban->no_beban.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_beban_beban->count_all(),
						"recordsFiltered" => $this->model_beban_beban->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no_beban = $this->model_beban_beban->kode();
		$no_akun = $this->model_beban_beban->no_akun();
		$data_beban_beban = array(
			'no_beban' => $no_beban,
			'nama_beban' => $this->input->post("nama_beban"),
			'delete' => "0"
		);
		
		$data_akun = array(
			'no_akun' => $no_akun,
			'nama_akun' => $this->input->post("nama_beban"),
			'jenis_akun' => "aktiva"
		);
		
		$q = $this->model_beban_beban->tambah('beban_beban', $data_beban_beban);
		$q = $this->model_beban_beban->tambah('akun', $data_akun);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no_beban = $this->input->post("no_beban");
		$field = array('*');
		$condition = array(
			'no_beban' => $no_beban
		);
		$data = $this->model_beban_beban->get_row('beban_beban', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_beban = $this->input->post("aksi");
		$nama_beban = $this->input->post("nama_beban");
		$nama_beban_asli = $this->input->post("nama_beban_asli");
		
		$field = array('*');
		$condition = array(
			'nama_akun' => $nama_beban_asli
		);
		$query_akun = $this->model_beban_beban->get_row('akun', $field, $condition);
		$no_akun = $query_akun->no_akun;
		
		$data_akun = array(
			'nama_akun' => $nama_beban
		);
		$qw = $this->model_beban_beban->ubah("akun", $data_akun, "no_akun = '$no_akun' ");
		
		$data_beban_beban = array(
			'nama_beban' => $this->input->post("nama_beban")
		);
		$q = $this->model_beban_beban->ubah("beban_beban", $data_beban_beban, "no_beban = '$no_beban' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_beban = $this->input->post("no_beban");
		$field = array('*');
		$condition = array(
			'no_beban' => $no_beban
		);
		$query_beban = $this->model_beban_beban->get_row('beban_beban', $field, $condition);
		$nama_beban = $query_beban->nama_beban;
		
		$condition2 = array(
			'nama_akun' => $nama_beban
		);
		$query_akun = $this->model_beban_beban->get_row('akun', $field, $condition2);
		$no_akun = $query_akun->no_akun;
		
		
		$data_beban_beban = array(
			'delete' => 1
		);
		$qw = $this->model_beban_beban->hapus("akun", $data_beban_beban, "no_akun = '$no_akun' ");
		$q = $this->model_beban_beban->hapus("beban_beban", $data_beban_beban, "no_beban = '$no_beban' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
