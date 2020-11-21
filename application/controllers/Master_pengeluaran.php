<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pengeluaran extends CI_Controller {
	
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
        $this->load->model('model_master_pengeluaran');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Master Pengeluaran',
			'judul'=>'Master Pengeluaran',
			'main_view'=>'view_master_pengeluaran'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_master_pengeluaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $master_pengeluaran) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$master_pengeluaran->nama_pengeluaran."</span>";
			$row[] = "<span class='size'>".$master_pengeluaran->jenis."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $master_pengeluaran->no_pengeluaran.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $master_pengeluaran->no_pengeluaran.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_master_pengeluaran->count_all(),
						"recordsFiltered" => $this->model_master_pengeluaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		$this->form_validation->set_rules('nama_pengeluaran', 'Nama Pengeluaran', 'required|is_unique[master_pengeluaran.nama_pengeluaran]');
	
		if($this->form_validation->run() == TRUE){
			$no_pengeluaran = $this->model_master_pengeluaran->kode();
			$data_master_pengeluaran = array(
				'no_pengeluaran' => $no_pengeluaran,
				'nama_pengeluaran' => $this->input->post("nama_pengeluaran"),
				'jenis'	=> $this->input->post('jenis'),
				'delete' => "0"
			);
			$q = $this->model_master_pengeluaran->tambah('master_pengeluaran', $data_master_pengeluaran);
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
		$no_pengeluaran = $this->input->post("no_pengeluaran");
		$field = array('*');
		$condition = array(
			'no_pengeluaran' => $no_pengeluaran
		);
		$data = $this->model_master_pengeluaran->get_row('master_pengeluaran', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$list_cek = ['nama_pengeluaran'];

		foreach ($list_cek as $row) {
			if($p[$row] == $cek[$row]){
				$s = true;
			
			}else{
				$cek = $this->model_master_pengeluaran->get_detail($row, $p[$row])->num_rows();
				if($cek == 0){
					$s = true;
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> '.$row.' sudah ada','warning'));
					$s = false;
					$res = [
						'status'  => false,
						'message' => $row." Sudah Ada"
					];
					break;
				}
			}
		}

		if($s){
			$no_pengeluaran = $this->input->post("aksi");
			$nama_pengeluaran = $this->input->post("nama_pengeluaran");
			$field = array('*');
			
			$data_master_pengeluaran = array(
				'nama_pengeluaran' => $this->input->post("nama_pengeluaran"),
				'jenis' => $this->input->post('jenis')
			);
			$q = $this->model_master_pengeluaran->ubah("master_pengeluaran", $data_master_pengeluaran, "no_pengeluaran = '$no_pengeluaran' ");
			if($q){
				$res = [
					'status'  => true,
					'message' => 'Data berhasil diubah'
				];
			}else{
				$res = [
					'status'  => false,
					'message' => 'Data gagal diubah'
				];
			}
		}
		
	}

	public function hapus()
	{
		$no_pengeluaran = $this->input->post("no_pengeluaran");
		$field = array('*');
		$data_master_pengeluaran = array(
			'delete' => 1
		);
		$q = $this->model_master_pengeluaran->hapus("master_pengeluaran", $data_master_pengeluaran, "no_pengeluaran = '$no_pengeluaran' ");
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
