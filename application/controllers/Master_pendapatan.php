<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pendapatan extends CI_Controller {
	
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
        $this->load->model('model_master_pendapatan');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Master Pendapatan',
			'judul'=>'Master Pendapatan',
			'main_view'=>'view_master_pendapatan',
			'akun'	=> $this->db->order_by('no_akun','ASC')->get('akun')->result_array()
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_master_pendapatan->get_datatables();
		// print_r($list);exit;
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_pendapatan) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$master_pendapatan->no_pendapatan."</span>";

			if($this->session->userdata('jabatan') == 'Bendahara Yayasan'){
				$row[] = "<span class='size'>".$master_pendapatan->no_akun." - ".$master_pendapatan->nama_akun."</span>";
			}

			$row[] = "<span class='size'>".$master_pendapatan->nama_pendapatan."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $master_pendapatan->no_pendapatan.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $master_pendapatan->no_pendapatan.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_master_pendapatan->count_all(),
						"recordsFiltered" => $this->model_master_pendapatan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		$this->form_validation->set_rules('nama_pendapatan', 'Nama Pendapatan', 'required|is_unique[master_pendapatan.nama_pendapatan]');
	
		if($this->form_validation->run() == TRUE){
				$no_pendapatan = $this->model_master_pendapatan->kode();
				$data_master_pendapatan = array(
					'no_pendapatan' => $no_pendapatan,
					'nama_pendapatan' => $this->input->post("nama_pendapatan"),
					'delete' => "0",
					'input_by' => $this->session->userdata('jabatan')
				);

				if($this->session->userdata('jabatan') == 'Bendahara Yayasan'){
					$data_master_pendapatan['no_akun'] = $this->input->post('no_akun');
				}

				$q = $this->model_master_pendapatan->tambah('master_pendapatan', $data_master_pendapatan);
				if($q){
					$res = [
						'status'  => true,
						'message' => 'Data berhasil dimasukkan'
					];
				}else{
					$res = [
						'status'  => false,
						'message' => 'Data gagal dimasukkan'
					];
				}
		
		}else{
			$res = [
				'status'  => false,
				'message' => validation_errors()
			];
		}

		echo json_encode($res);

	}
	
	public function data()
	{
		$no_pendapatan = $this->input->post("no_pendapatan");
		$field = array('*');
		$condition = array(
			'no_pendapatan' => $no_pendapatan
		);
		$data = $this->model_master_pendapatan->get_row('master_pendapatan', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		// $no_akun = $this->input->post("aksi");
		// $list_cek = ['nama_pendapatan'];
		// print_r($list_cek);exit;

		// foreach ($list_cek as $row) {
		// 	if($p[$row] == $cek[$row]){
		// 		$s = true;
			
		// 	}else{
		// 		$cek = $this->model_master_pendapatan->get_detail($row, $p[$row])->num_rows();
		// 		if($cek == 0){
		// 			$s = true;
		// 		}else{
		// 			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> '.$row.' sudah ada','warning'));
		// 			$s = false;
		// 			$res = [
		// 				'status'  => false,
		// 				'message' => $row." Sudah Ada"
		// 			];
		// 			break;
		// 		}
		// 	}
		// }

		// if($s){
		// 	$no_pendapatan = $this->input->post("aksi");
		// 	$nama_pendapatan = $this->input->post("nama_pendapatan");
		// 	$field = array('*');
			
		// 	$data_master_pendapatan = array(
		// 		'nama_pendapatan' => $this->input->post("nama_pendapatan")
		// 	);
		// 	$q = $this->model_master_pendapatan->ubah("master_pendapatan", $data_master_pendapatan, "no_pendapatan = '$no_pendapatan' ");
		// 	if($q){
		// 		$res = [
		// 			'status'  => true,
		// 			'message' => 'Data berhasil diubah'
		// 		];
		// 	}else{
		// 		$res = [
		// 			'status'  => false,
		// 			'message' => 'Data gagal diubah'
		// 		];
		// 	}
		// }

		// echo json_encode($res);
		$no_pendapatan = $this->input->post("aksi");
		$nama_pendapatan = $this->input->post("nama_pendapatan");
		$field = array('*');
		
		$data_master_pendapatan = array(
			'nama_pendapatan' => $this->input->post("nama_pendapatan")
		);
		$q = $this->model_master_pendapatan->ubah("master_pendapatan", $data_master_pendapatan, "no_pendapatan = '$no_pendapatan' ");
		if($q){
			echo json_encode(array(
				'status' => true, 
				'message' => 'Data berhasil diubah'
			));
		}else{
			echo json_encode(array(
				'status'  => false,
				'message' => 'Data gagal diubah'
			));
		}
	}

	public function hapus()
	{
		$no_pendapatan = $this->input->post("no_pendapatan");
		$field = array('*');
		$data_master_pendapatan = array(
			'delete' => 1
		);
		$q = $this->model_master_pendapatan->hapus("master_pendapatan", $data_master_pendapatan, "no_pendapatan = '$no_pendapatan' ");
		if($q){
			$res = [
				'status'  => true,
				'message' => 'Data berhasil dihapus'
			];
		}else{
			$res = [
				'status'  => false,
				'message' => 'Data gagal dihapus'
			];
		}

		echo json_encode($res);
	}
}
