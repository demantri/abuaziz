<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	
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
        $this->load->model('model_penjualan');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Penjualan',
			'judul'=>'Penjualan',
			'main_view'=>'view_penjualan'
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_pelanggan()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$q = $this->model_penjualan->get_where('pelanggan', $field, $condition);
		
		if($q){
			echo "<select name='no_pelanggan' id='no_pelanggan' class='form-control'>
            <option value =''>--Pilih Pelanggan--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_pelanggan'>$row->nama_pelanggan</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_penjualan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penjualan) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$penjualan->no_transaksi."</span>";
			$row[] = "<span class='size'>".$penjualan->nama_pelanggan."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($penjualan->total_harga,2,',','.')."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($penjualan->pembayaran,2,',','.')."</span>";
			$row[] = "<span class='size'>".$penjualan->status_pembayaran."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Lihat" onclick="edit(\''. $penjualan->no_transaksi.'\')">
				<i class="fa fa-eye"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_penjualan->count_all(),
						"recordsFiltered" => $this->model_penjualan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_kode()
	{
		if($this->input->is_ajax_request())
		{
			$keyword 	= $this->input->post('keyword');
			$registered	= $this->input->post('registered');

			$barang = $this->model_penjualan->cari_barang($keyword, $registered);

			if($barang->num_rows() > 0)
			{
				$json['status'] 	= 1;
				$json['datanya'] 	= "<ul id='daftar-autocomplete' class='list-group'>";
				foreach($barang->result() as $b)
				{
					$harga_awal=$b->harga_produk;
					$harga_baru=$harga_awal;
					$json['datanya'] .= "
						<li class='list-group-item'>
							<b>Kode</b> : 
							<span id='kodenya'>".$b->no_produk."</span> <br />
							<span id='barangnya'>".$b->nama_produk."</span>
							<span id='harganya' style='display:none;'>".$b->harga_produk."</span>
							<span id='barcodenya' style='display:none;'>".$b->jenis_produk."</span>
						</li>
					";
				}
				$json['datanya'] .= "</ul>";
			}
			else
			{
				$json['status'] 	= 0;
			}

			echo json_encode($json);
		}
	}
	
	public function cek_stok()
	{
		if($this->input->is_ajax_request())
		{
			$no_produk = $this->input->post('no_produk');
			$jumlah_beli = $this->input->post('jumlah_beli');

			$get_stok = $this->model_penjualan->get_stok($no_produk);
			if($jumlah_beli > $get_stok->row()->jumlah_produk)
			{
				echo json_encode(array('status' => 0, 'pesan' => "Stok untuk <b>".$get_stok->row()->nama_produk."</b> saat ini hanya tersisa <b>".$get_stok->row()->jumlah_produk."</b> !",'harga_produk' => $get_stok->row()->harga_produk));
			}
			else
			{
				echo json_encode(array('status' => 1,'harga_produk' => $get_stok->row()->harga_produk));
			}
		}
	}

	public function tambah(){
		
		$no_transaksi = $this->model_penjualan->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "penjualan",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_penjualan->tambah('transaksi', $data_transaksi);
		$no_pelanggan = $this->input->post("no_pelanggan");
		if($no_pelanggan==''){
			$no_pelanggan = NULL;
		}
		
		$data_penjualan = array(
			'no_transaksi' => $no_transaksi,
			'no_pelanggan' => $no_pelanggan,
			'pembayaran' => $this->input->post("pembayaran"),
			'total_harga' => $this->input->post("total_harga"),
			'sisa_pembayaran' => $this->input->post("total_harga")-$this->input->post("pembayaran"),
			'status' => "selesai",
			'status_pembayaran' => "hutang",
			'catatan' => $this->input->post("catatan")
		);
		
		$penjualan = $this->model_penjualan->tambah('penjualan', $data_penjualan);
		
		$no_array	= 0;
		$subtotal	= 0;
		$inserted	= 0;
		foreach($_POST['kode_barang'] as $k)
		{
			if( ! empty($k))
			{
				$data_detail = array(
					'no_transaksi' => $no_transaksi,
					'no_produk' => $_POST['kode_barang'][$no_array],
					'total_barang' => $_POST['jumlah_beli'][$no_array],
					'harga_barang' => $_POST['harga_satuan'][$no_array],
					'total_harga' => $_POST['sub_total'][$no_array]
				);
				$subtotal	= $subtotal+$_POST['sub_total'][$no_array];
				
				$insert_detail	= $this->model_penjualan->tambah('detail_penjualan', $data_detail);
				if($insert_detail)
				{
					$this->model_penjualan->update_stok($_POST['kode_barang'][$no_array], $_POST['jumlah_beli'][$no_array]);
					$inserted++;
				}
			}

			$no_array++;
		}
		
		
		if($inserted > 0){
			echo json_encode(array('status' => "benar"));
		}else{
			$q = $this->model_penjualan->hapus("transaksi", "no_transaksi = '$no_transaksi' ");
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
