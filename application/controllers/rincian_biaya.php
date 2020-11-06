<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rincian_biaya extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		//$this->load->library('form_validation');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
        //$data['sum'] = $this->Model_rincian_biaya->getsum();
        $this->load->model('Model_rincian_biaya');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Rincian Biaya',
			'judul'=>'Rincian Biaya',
			'main_view'=>'view_rincian_biaya'
		];
		$data['result'] = $this->Model_rincian_biaya->GetDataTransaksi();
		$data['sum'] = $this->Model_rincian_biaya->getsum();
		$this->load->view('template/index', $data);

	}
	
	public function ajax_list()
	{
		$list = $this->Model_rincian_biaya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rincian_biaya) {
			$no++;
			$spasi = "&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;";
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$rincian_biaya->nama_rincian."</span>";
			$row[] = "<span class='size'>".$rincian_biaya->transaksi_utama."</span>";
			// $row[] = "<span class='size'>".$aset->jenis_aset."</span>";
			$row[] = $spasi."<span class='size'>Rp. ".number_format($rincian_biaya->harga_rincian,2,',','.')."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $rincian_biaya->no_rincian.'\')">
				<i class="fa fa-pencil"></i></a>';
			
				$aksi.='
				<a class="btn btn-xs btn-danger" href="javascript:void()" title="Hapus" onclick="hapus(\''. $rincian_biaya->no_rincian.'\')">
				<i class="fa fa-trash"></i></a>';
			$row[] = $aksi;

			
			$data[] = $row; 
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_rincian_biaya->count_all(),
						"recordsFiltered" => $this->Model_rincian_biaya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		//  $this->form_validation->set_rules('nama_rincian', 'Nama Rincian', 'required|trim|is_unique[rincian_biaya.nama_rincian]', array('required' => '%s Tidak boleh kosong', 'is_unique' => 'Nama Rincian telah tersedia'));
		//  $this->form_validation->set_rules('harga_rincian', 'Harga Rincian', 'required|trim|numeric', array('required' => '%s Tidak Boleh kosong', 'numeric' => '%s Harus berupa angka'));

		// if ($this->form_validation->run() == TRUE) {

		$no_rincian = $this->Model_rincian_biaya->kode();
		$data_rincian_biaya = array(
			'no_rincian' => $no_rincian,
			'nama_rincian' => $this->input->post("nama_rincian"),
			'transaksi_utama' => $this->input->post("transaksi_utama"),
			'harga_rincian' => $this->input->post("harga_rincian"),
			'delete' => "0"
		);
		
		$q = $this->Model_rincian_biaya->tambah('rincian_biaya', $data_rincian_biaya);
			if($q){
				echo json_encode(array('status' => "benar"));
			}else{
			echo json_encode(array('status' => "salah"));
			}
	// 	} else {
	// 		$errors = validation_errors();
	// 		$this->session->set_flashdata('formErr', $errors);
	// 	}
	// 	redirect('rincian_biaya');
	 }
	
	
	public function data()
	{
		$no_rincian = $this->input->post("no_rincian");
		$field = array('*');
		$condition = array(
			'no_rincian' => $no_rincian
		);
		$data = $this->Model_rincian_biaya->get_row('rincian_biaya', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_rincian = $this->input->post("aksi");
		$field = array('*');
		$data_rincian_biaya = array(
			'nama_rincian' => $this->input->post("nama_rincian"),
			'transaksi_utama' => $this->input->post("transaksi_utama"),
			// 'jenis_aset' => $this->input->post("jenis_aset"),
			'harga_rincian' => $this->input->post("harga_rincian")
		);
		$q = $this->Model_rincian_biaya->ubah("rincian_biaya", $data_rincian_biaya, "no_rincian = '$no_rincian' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_rincian = $this->input->post("no_rincian");
		$field = array('*');
		$data_rincian_biaya = array(
			'delete' => 1
		);
		$q = $this->Model_rincian_biaya->hapus("rincian_biaya", $data_rincian_biaya, "no_rincian = '$no_rincian' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
