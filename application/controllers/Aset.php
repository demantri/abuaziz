





	
	
	
	
		
		
			
						"data" => $data,
						"draw" => $_POST['draw'],
						"recordsFiltered" => $this->model_aset->count_filtered(),
						"recordsTotal" => $this->model_aset->count_all(),
				$aksi.='
				$aksi.='
				);
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $aset->no_aset.'\')">
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $aset->no_aset.'\')">
				<i class="fa fa-pencil"></i></a>';
				<i class="fa fa-trash"></i></a>';
			$aksi = '';
			$data[] = $row;
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$aset->jenis_aset."</span>";
			$row[] = "<span class='size'>".$aset->nama_aset."</span>";
			$row[] = "<span class='size'>".$aset->satuan_aset."</span>";
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($aset->harga_aset,2,',','.')."</span>";
			$row[] = $aksi;
			'delete' => "0"
			'delete' => 1
			'harga_aset' => $this->input->post("harga_aset")
			'harga_aset' => $this->input->post("harga_aset"),
			'jenis_aset' => $this->input->post("jenis_aset"),
			'jenis_aset' => $this->input->post("jenis_aset"),
			'judul'=>'Aset',
			'judul_form'=>'Data Aset',
			'main_view'=>'view_aset'
			'nama_aset' => $this->input->post("nama_aset"),
			'nama_aset' => $this->input->post("nama_aset"),
			'no_aset' => $no_aset
			'no_aset' => $no_aset,
			'satuan_aset' => $this->input->post("satuan_aset"),
			'satuan_aset' => $this->input->post("satuan_aset"),
			echo json_encode(array('status' => "benar"));
			echo json_encode(array('status' => "benar"));
			echo json_encode(array('status' => "benar"));
			echo json_encode(array('status' => "salah"));
			echo json_encode(array('status' => "salah"));
			echo json_encode(array('status' => "salah"));
		$condition = array(
		$data = $this->model_aset->get_row('aset', $field, $condition);
		$data = [
		$data = array();
		$data_aset = array(
		$data_aset = array(
		$data_aset = array(
		$field = array('*');
		$field = array('*');
		$field = array('*'); 
		$list = $this->model_aset->get_datatables();
		$no = $_POST['start'];
		$no_aset = $this->input->post("aksi");
		$no_aset = $this->input->post("no_aset");
		$no_aset = $this->input->post("no_aset");
		$no_aset = $this->model_aset->kode();
		$output = array(
		$q = $this->model_aset->hapus("aset", $data_aset, "no_aset = '$no_aset' ");
		$q = $this->model_aset->tambah('aset', $data_aset);
		$q = $this->model_aset->ubah("aset", $data_aset, "no_aset = '$no_aset' ");
		$this->load->view('template/index', $data);
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Pragma: no-cache');
		);
		);
		);
		);
		//output to json format
		];
		echo json_encode($data);
		echo json_encode($output);
		foreach ($list as $aset) {
		if(!$this->session->userdata('no_user'))
		if($q){
		if($q){
		if($q){
		parent::__construct(); 
		}
		}
		}
		}
		}else{
		}else{
		}else{
	public function __construct(){
	public function ajax_list()
	public function data()
	public function hapus()
	public function index()
	public function tambah(){
	public function ubah()
	{
	{
	{
	{
	{
	}
	}
	}
	}
	}
	}
	}
        	redirect('auth');
        $this->load->model('model_aset');
        {
        }
<?php
class Aset extends CI_Controller {
defined('BASEPATH') OR exit('No direct script access allowed');
}