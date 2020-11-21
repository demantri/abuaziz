<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_dll extends CI_Controller {
	
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
        $this->load->model('model_pengeluaran_dll');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Pengeluaran Lain-lain',
			'judul'=>'Pengeluaran Lain-lain',
			'main_view'=>'view_pengeluaran_dll'
		];

		$data['png'] = $this->db->get('master_pengeluaran')->result_array();
		$this->load->view('template/index', $data);
	}
	
	public function list_pengeluaran_dll()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$q = $this->model_pengeluaran_dll->get_where('master_pengeluaran', $field, $condition);
		
		if($q){
			echo "<select name='no_pengeluaran' id='no_pengeluaran' data-validate-field='no_pengeluaran' class='form-control'>
            <option value =''>--Pilih Pengeluaran--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_pengeluaran'>$row->nama_pengeluaran</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_pengeluaran_dll->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pengeluaran_dll) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$pengeluaran_dll->no_transaksi."</span>";
			$row[] = "<span class='size'>".date('d F Y', strtotime($pengeluaran_dll->tanggal_transaksi))."</span>";
			$row[] = "<span class='size'>".$pengeluaran_dll->nama_pengeluaran."</span>";
			$row[] = "<span class='size pull-right'>Rp. ".number_format($pengeluaran_dll->jumlah_pengeluaran,2,',','.')."</span>";
			$row[] = "<span class='size'>".$pengeluaran_dll->keterangan."</span>";
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_pengeluaran_dll->count_all(),
						"recordsFiltered" => $this->model_pengeluaran_dll->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$p = $this->input->post();
		if($p['jumlah_pengeluaran'] == '' || $p['jumlah_pengeluaran'] <= 0){
			$res = [
				'status'  => false,
				'message' => 'Nominal pengeluaran harus diatas 0'
			];

		}else{
			$no_transaksi = $this->model_pengeluaran_dll->kode();
			$this->db->trans_begin();

			$data_transaksi = array(
				'no_transaksi' 		=> $no_transaksi,
				'tanggal_transaksi' => date('Y-m-d'),
				'nama_transaksi'	 => "pengeluaran lain-lain",
				'no_user' 		    => $this->session->userdata('no_user')
			);
			
			$transaksi = $this->model_pengeluaran_dll->tambah('transaksi', $data_transaksi);
			
			$data_pengeluaran = array(
				'no_transaksi' => $no_transaksi,
				'no_pengeluaran' => $this->input->post("no_pengeluaran"),
				'jumlah_pengeluaran' => $this->input->post("jumlah_pengeluaran"),
				'tanggal_pengeluaran' => date('Y-m-d'),
				'keterangan' => $this->input->post("keterangan")
			);
			
			$pengeluaran_dll = $this->model_pengeluaran_dll->tambah('pengeluaran_lain_lain', $data_pengeluaran);
			
			$cek = $this->db->where('no_pengeluaran', $this->input->post('no_pengeluaran'))->get('master_pengeluaran')->row_array();
			if($cek['jenis'] == 'perlengkapan'){
				$no_akun = '123';
			
			}else{
				$no_akun = '124';
			}

			$jurnal1 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => $no_akun,
				'posisi' => "debit",
				'nominal' => $this->input->post("jumlah_pengeluaran")
			);
			$query_jurnal1 = $this->model_pengeluaran_dll->tambah("jurnal", $jurnal1);
			
			$jurnal2 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "111",
				'posisi' => "kredit",
				'nominal' => $this->input->post("jumlah_pengeluaran")
			);
			$query_jurnal2 = $this->model_pengeluaran_dll->tambah("jurnal", $jurnal2);

			if($this->db->trans_status()){
				$this->db->trans_commit();
				$res = [
					'status' => true,
					'message' => 'Data berhasil dimasukkan'
				];

			}else{
				$this->db->trans_rollback();
				$res = [
					'status' => false,
					'message' => 'Data gagal dimasukkan'
				];
			}

		}

		echo json_encode($res);
	}
}
