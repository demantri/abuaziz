<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {
	
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
        $this->load->model('model_pembelian');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Pembelian',
			'judul'=>'Pembelian',
			'main_view'=>'view_pembelian'
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_supplier()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$q = $this->model_pembelian->get_where('supplier', $field, $condition);
		
		if($q){
			echo "<select name='no_supplier' id='no_supplier' class='form-control'>
            <option value =''>--Pilih Supplier--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_supplier'>$row->nama_supplier</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_pembelian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pembelian) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$pembelian->no_transaksi."</span>";
			$row[] = "<span class='size'>".$pembelian->nama_supplier."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($pembelian->total_harga,2,',','.')."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($pembelian->pembayaran,2,',','.')."</span>";
			$row[] = "<span class='size'>".$pembelian->status_pembayaran."</span>";
			$aksi = '';
				$aksi.='
				<a class="btn btn-xs btn-primary" href="javascript:void()" title="Lihat" onclick="edit(\''. $pembelian->no_transaksi.'\')">
				<i class="fa fa-eye"></i></a>';
			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_pembelian->count_all(),
						"recordsFiltered" => $this->model_pembelian->count_filtered(),
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

			$barang = $this->model_pembelian->cari_barang($keyword, $registered);

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
	
	public function tambah(){
		
		$no_transaksi = $this->model_pembelian->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "pembelian",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_pembelian->tambah('transaksi', $data_transaksi);
		$no_supplier = $this->input->post("no_supplier");
		if($no_supplier==''){
			$no_supplier = NULL;
		}
		
		$data_pembelian = array(
			'no_transaksi' => $no_transaksi,
			'no_supplier' => $no_supplier,
			'pembayaran' => $this->input->post("pembayaran"),
			'total_harga' => $this->input->post("total_harga"),
			'sisa_pembayaran' => $this->input->post("total_harga")-$this->input->post("pembayaran"),
			'status' => "selesai",
			'status_pembayaran' => "hutang",
			'catatan' => $this->input->post("catatan")
		);
		
		$pembelian = $this->model_pembelian->tambah('pembelian', $data_pembelian);
		
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
					'sisa_barang' => $_POST['jumlah_beli'][$no_array],
					'harga_barang' => $_POST['harga_satuan'][$no_array],
					'total_harga' => $_POST['sub_total'][$no_array],
					'retur_barang' => "0",
					'status' => "masih ada"
				);
				$subtotal	= $subtotal+$_POST['sub_total'][$no_array];
				
				$insert_detail	= $this->model_pembelian->tambah('detail_pembelian', $data_detail);
				if($insert_detail)
				{
					$this->model_pembelian->update_stok($_POST['kode_barang'][$no_array], $_POST['jumlah_beli'][$no_array]);
					$inserted++;
				}
			}

			$no_array++;
		}
		
		
		if($inserted > 0){
			echo json_encode(array('status' => "benar"));
		}else{
			$q = $this->model_pembelian->hapus("transaksi", "no_transaksi = '$no_transaksi' ");
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
