<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	
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
        $this->load->model('model_siswa');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Siswa',
			'judul'=>'Siswa',
			'main_view'=>'view_siswa'
		];
		$this->load->view('template/index', $data);
	}
	
	public function ajax_list()
	{
		$list = $this->model_siswa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $siswa) {
			$no++;
			$row = array();
			$text_notif = ('');
            $encode = urlencode($text_notif);		
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".date('d F Y', strtotime($siswa->tanggal_transaksi))."</span>";
			$row[] = "<span class='size'>".$siswa->nis."</span>";
			$row[] = "<span class='size'>".$siswa->nama_siswa."</span>";
			$row[] = "<span class='size'>".$siswa->alamat_siswa."</span>";
			// $row[] = "<span class='size'>".$siswa->no_telepon."</span>";
			$row[] = "<span class='size'>".$siswa->jenis_kelamin."</span>";
			$row[] = "<span class='size'>".$siswa->tempat_lahir." <br> ".$siswa->tanggal_lahir."</span>";
			$row[] = "<span class='size'>".$siswa->nama_ayah."</span>";
			$row[] = "<span class='size'>".$siswa->nama_ibu."</span>";
			$row[] = "<span class='size'>".$siswa->no_telepon_ortu."</span>";
				
			$aksi = '<a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone='.$siswa->no_telepon_ortu.'"><i class="fa fa-bell" style="color:green" data-toggle="tooltip" title="Send Whatsapp"></i></a>';
				
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $siswa->no_siswa.'\')">
				<i class="fa fa-pencil"></i></a>';

			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_siswa->count_all(),
						"recordsFiltered" => $this->model_siswa->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function data()
	{
		$no_siswa = $this->input->post("no_siswa");
		$field = array('*');
		$condition = array(
			'no_siswa' => $no_siswa
		);
		$data = $this->model_siswa->get_row('siswa', $field, $condition);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_siswa = $this->input->post("aksi");
		$field = array('*');
		$data_siswa = array(
			'nis' => $this->input->post("nis"),
			'nama_siswa' => $this->input->post("nama_siswa"),
			'alamat_siswa' => $this->input->post("alamat_siswa"),
			// 'no_telepon' => $this->input->post("no_telepon"),
			'jenis_kelamin' => $this->input->post("jenis_kelamin"),
			'tanggal_lahir' => $this->input->post("tanggal_lahir"),
			'tempat_lahir' => $this->input->post("tempat_lahir"),
			'nama_ayah' => $this->input->post("nama_ayah"),
			'nama_ibu' => $this->input->post("nama_ibu"),
			'no_telepon_ortu' => $this->input->post("no_telepon_ortu")
		);
		$q = $this->model_siswa->ubah("siswa", $data_siswa, "no_siswa = '$no_siswa' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
