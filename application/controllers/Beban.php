<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beban extends CI_Controller {
	
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
        $this->load->model('model_beban');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Pengeluaran Beban',
			'judul'=>'Pengeluaran Beban',
			'main_view'=>'view_beban'
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_beban()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$q = $this->model_beban->get_where('beban_beban', $field, $condition);
		
		if($q){
			echo "<select name='no_beban' id='no_beban' class='form-control'>
            <option value =''>--Pilih Pengeluaran--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_beban'>$row->nama_beban</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_beban->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $beban) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$beban->no_transaksi."</span>";
			$row[] = "<span class='size'>".$beban->nama_beban."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($beban->total_pengeluaran,2,',','.')."</span>";
			$row[] = "<span class='size'>".$beban->keterangan."</span>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_beban->count_all(),
						"recordsFiltered" => $this->model_beban->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no_transaksi = $this->model_beban->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "beban",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_beban->tambah('transaksi', $data_transaksi);
		
		
		$data_beban = array(
			'no_transaksi' => $no_transaksi,
			'no_beban' => $this->input->post("no_beban"),
			'total_pengeluaran' => $this->input->post("total_pengeluaran"),
			'keterangan' => $this->input->post("keterangan")
		);
		
		$beban = $this->model_beban->tambah('pembayaran_beban', $data_beban);
		
		$field = array('*');
		$condition = array(
			'no_beban' => $this->input->post("no_beban")
		);
		$querybeban = $this->model_beban->get_row('beban_beban', $field, $condition);
		$nama_beban = $querybeban->nama_beban;
		
		$condition2 = array(
			'nama_akun' => $nama_beban
		);
		$queryakun = $this->model_beban->get_row('akun', $field, $condition2);
		$no_akun = $queryakun->no_akun;
		
		$jurnal1 = array(
			'no_transaksi' => $no_transaksi,
			'no_akun' => $no_akun,
			'posisi' => "debit",
			'nominal' => $this->input->post("total_pengeluaran")
		);
		$query_jurnal1 = $this->model_beban->tambah("jurnal", $jurnal1);
		
		$jurnal2 = array(
			'no_transaksi' => $no_transaksi,
			'no_akun' => "111",
			'posisi' => "kredit",
			'nominal' => $this->input->post("total_pengeluaran")
		);
		$query_jurnal2 = $this->model_beban->tambah("jurnal", $jurnal2);
		if($beban){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
	
	// public function data()
	// {
		// $no_produk = $this->input->post("no_produk");
		// $field = array('*');
		// $condition = array(
			// 'no_produk' => $no_produk
		// );
		// $data = $this->model_produk->get_row('produk', $field, $condition);
		// echo json_encode($data);
	// }
	
	// public function ubah()
	// {
		// $no_produk = $this->input->post("aksi");
		// $field = array('*');
		// $data_produk = array(
			// 'nama_produk' => $this->input->post("nama_produk"),
			// 'satuan_produk' => $this->input->post("satuan_produk"),
			// 'jenis_produk' => $this->input->post("jenis_produk"),
			// 'harga_produk' => $this->input->post("harga_produk")
		// );
		// $q = $this->model_produk->ubah("produk", $data_produk, "no_produk = '$no_produk' ");
		// if($q){
			// echo json_encode(array('status' => "benar"));
		// }else{
			// echo json_encode(array('status' => "salah"));
		// }
	// }

	// public function hapus()
	// {
		// $no_produk = $this->input->post("no_produk");
		// $field = array('*');
		// $data_produk = array(
			// 'delete' => 1
		// );
		// $q = $this->model_produk->hapus("produk", $data_produk, "no_produk = '$no_produk' ");
		// if($q){
			// echo json_encode(array('status' => "benar"));
		// }else{
			// echo json_encode(array('status' => "salah"));
		// }
	// }
}
