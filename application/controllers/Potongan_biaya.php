<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potongan_biaya extends CI_Controller {
	
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
        //$data['sum'] = $this->Model_potongan_biaya->getsum();
        $this->load->model('Model_potongan_biaya');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Potongan Biaya',
			'judul'=>'Potongan Biaya',
			'main_view'=>'view_potongan_biaya'
		];
		$data['result'] = $this->Model_potongan_biaya->GetDataTransaksi();
		$data['rincian_biaya'] = $this->Model_potongan_biaya->GetDataRincian();
		//$data['sum'] = $this->Model_potongan_biaya->getsum();
		$this->load->view('template/index', $data);
	}

	public function list_rincian()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
			// 'status_siswa' => "Siswa"
		);
		$q = $this->Model_potongan_biaya->get_where('rincian_biaya', $field, $condition);
		
		if($q){
			echo "<select name='no_rincian' id='no_rincian' data-validate-field='no_rincian' class='form-control'>
            <option value =''>--Pilih Rincian Biaya--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_rincian'>$row->nama_rincian</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->Model_potongan_biaya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $potongan_biaya) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$potongan_biaya->nama_potongan."</span>";
			$row[] = "<span class='size'>".$potongan_biaya->potongan."</span>";
			$row[] = "<span class='size'>".$potongan_biaya->nama_rincian."</span>";


			// $row[] = "<span class='size'>Rp. ".number_format($potongan_biaya->harga_rincian,2,',','.')."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $potongan_biaya->no_potongan.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $potongan_biaya->no_potongan.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			
			$data[] = $row; 
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_potongan_biaya->count_all(),
						"recordsFiltered" => $this->Model_potongan_biaya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);

	}

	public function tambah(){
		
		$no_potongan = $this->Model_potongan_biaya->kode();
		$data_potongan_biaya = array(
			'no_potongan' => $no_potongan,
			'no_rincian' => $_POST['no_rincian'],
			'nama_potongan' => $this->input->post("nama_potongan"),
			'potongan' => $this->input->post("potongan"),
			//'biaya_potong' => $this->input->post("biaya_potong"),
			'delete' => "0"
		);
		
		$q = $this->Model_potongan_biaya->tambah('potongan_biaya', $data_potongan_biaya);
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	public function data()
	{
		$no_potongan = $this->input->post("no_potongan");
		$field = array('*');
		$condition = array(
			'no_potongan' => $no_potongan
		);
		$data = $this->Model_potongan_biaya->get_row('potongan_biaya', $field, $condition);
		echo json_encode($data);
	}

	public function getDatatrx($id)
	{
		return $this->db->select('*')->from('rincian_biaya a')->join('potongan_biaya b', 'a.no_rincian = b.no_rincian')->where('b.no_rincian', $id)->get()->result();
	}

	public function ubah()
	{
		$no_potongan = $this->input->post("aksi");
		$field = array('*');
		$data_potongan_biaya = array(
			'nama_potongan' => $this->input->post("nama_potongan"),
			'potongan' => $this->input->post("potongan"),
			//'biaya_potong' => $this->input->post("biaya_potong")
		);
		$q = $this->Model_potongan_biaya->ubah("potongan_biaya", $data_potongan_biaya, "no_potongan = '$no_potongan' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_potongan = $this->input->post("no_potongan");
		$field = array('*');
		$data_potongan_biaya = array(
			'delete' => 1
		);
		$q = $this->Model_potongan_biaya->hapus("potongan_biaya", $data_potongan_biaya, "no_potongan = '$no_potongan' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
