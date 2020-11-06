<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Daftar_ulang extends CI_Controller {
	
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
        $this->load->model('model_daftar_ulang');
	}


	public function index()
	{
		$data = [
			'judul_form'=>'Data Daftar Ulang',
			'judul'=>'Daftar Ulang',
			'main_view'=>'view_daftar_ulang'
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_siswa()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0",
			'status_siswa' => "Siswa"
		);
		$q = $this->model_daftar_ulang->get_where('siswa', $field, $condition);
		
		if($q){
			echo "<select name='no_siswa' id='no_siswa' data-validate-field='no_siswa' class='form-control'>
            <option value =''>--Pilih Siswa--</option>";
			foreach($q as $row){
				$count = $this->db->select('count(a.no_transaksi) as no')->from('daftar_ulang a')->join('transaksi b','a.no_transaksi = b.no_transaksi')->where(array('YEAR(tanggal_transaksi)' => date('Y'), 'no_siswa' => $row->no_siswa))->get()->row_array()['no'];
				if ($count == 0) {
					echo "<option  value='$row->no_siswa'>$row->nama_siswa</option>";					
				}
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_daftar_ulang->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $siswa) {
			$hasil_cek = $this->model_daftar_ulang->cek_daftar_ulang($siswa->no_siswa);
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$siswa->nis."</span>";
			$row[] = "<span class='size'>".$siswa->nama_siswa."</span>";
			// $row[] = "<span class='size'>".$siswa->alamat_siswa."</span>";
			// $row[] = "<span class='size'>".$siswa->no_telepon."</span>";
			// $row[] = "<span class='size'>".$siswa->jenis_kelamin."</span>";
			// $row[] = "<span class='size'>".$siswa->tempat_lahir." - ".$siswa->tanggal_lahir."</span>";
			// $row[] = "<span class='size'>Nama Ibu: ".$siswa->nama_ibu." <br/> Nama Ayah: ".$siswa->nama_ayah." <br/> No Telepon Ortu: ".$siswa->no_telepon_ortu."</span>";
			$row[] = "<span class='size'>".$siswa->kelas."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($siswa->biaya_daftar_ulang,2,',','.')."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($siswa->pembayaran,2,',','.')."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($siswa->sisa_pembayaran,2,',','.')."</span>";

			$row[] = "<span class='size'>".$siswa->status_pembayaran."</span>";

			// $row[] = "<span class='size'>".$hasil_cek."</span>";
			$aksi = '';

			if ($hasil_cek == 'Sudah Bayar') {
			$aksi ='<a class="btn btn-xs btn-warning" title="Cetak" href='.site_url('daftar_ulang/printpdf/'.$siswa->no_siswa).' target="_blank">
				<i class="fa fa-print"></i></a>';
				}
			// $aksi.='
			// 	<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $siswa->no_siswa.'\')">
			// 	<i class="fa fa-pencil"></i></a>';
			if ($siswa->status_pembayaran == 'Belum Lunas') {
			$aksi.='&nbsp<a class="btn btn-xs btn-info bayar" sisa="'.$siswa->sisa_pembayaran.'" kd="'.$siswa->no_transaksi.'" no="'.$siswa->no_siswa.'" title="Bayar">
				<i class="fa fa-money"></i></a>';
				}
			$row[] = $aksi;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_daftar_ulang->count_all(),
						"recordsFiltered" => $this->model_daftar_ulang->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		$no_transaksi = $this->model_daftar_ulang->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "daftar ulang",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_daftar_ulang->tambah('transaksi', $data_transaksi);
		
		$jenis_pembayaran=$this->input->post("jenis_pembayaran");
		if($jenis_pembayaran == "tunai"){
			$status="Lunas";
		}else{
			$status="Belum Lunas";
		}
		$data_daftar_ulang = array(
			'no_transaksi' => $no_transaksi,
			'no_siswa' => $this->input->post("no_siswa"),
			'kelas' => $this->input->post("kelas"),
			'biaya_daftar_ulang' => $this->input->post("biaya_daftar_ulang"),
			'pembayaran' => $this->input->post("pembayaran"),
			'sisa_pembayaran' => $this->input->post("sisa_pembayaran"),
			// 'keterangan' => $this->input->post("keterangan"),
			'status_pembayaran' => $status
		);

		$vali = $this->db->where('no_siswa',$_POST['no_siswa'])->get('kelas')->num_rows();
		if ($vali > 0) {
			$this->db->where('no_siswa', $_POST['no_siswa'])->set('nama_kelas', $_POST['kelas'])->update('kelas');
		} else {
			$in['no_siswa']		= $_POST['no_siswa'];
			$in['nama_kelas']	= $_POST['kelas'];
			$this->db->insert('kelas', $in);
		}
		
		$daftar_ulang = $this->model_daftar_ulang->tambah('daftar_ulang', $data_daftar_ulang);
		if($daftar_ulang){
			$jurnal1 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "111",
				'posisi' => "debit",
				'nominal' => $this->input->post("pembayaran")
			);
			$query_jurnal1 = $this->model_daftar_ulang->tambah("jurnal", $jurnal1);
			
			if($jenis_pembayaran != "tunai"){
				$jurnal1 = array(
					'no_transaksi' => $no_transaksi,
					'no_akun' => "122",
					'posisi' => "debit",
					'nominal' => $this->input->post("sisa_pembayaran")
				);
				$query_jurnal1 = $this->model_daftar_ulang->tambah("jurnal", $jurnal1);
			}
			
			$jurnal2 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "422",
				'posisi' => "kredit",
				'nominal' => $this->input->post("biaya_daftar_ulang")
			);
			$query_jurnal2 = $this->model_daftar_ulang->tambah("jurnal", $jurnal2);
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function printpdf($id)
	{
		$data['main_view']	= 'bukti_transaksi3';
		$data['result']		= $this->getDatatrx($id);
		$this->load->view('template/print', $data);
	}

	public function getDatatrx($id)
	{
		return $this->db->select('*')->from('siswa a')->join('daftar_ulang b', 'a.no_siswa = b.no_siswa')->join('transaksi c', 'b.no_transaksi = c.no_transaksi')->where('b.no_siswa', $id)->get()->result();
	}

	public function search(){
		$keyword = $this->input->post('keyword');
		$data['siswa']=$this->model_daftar_ulang->get_keyword($keyword);
		//$this->load->view('daftar_ulang/index', $data);
		$data = [
			'judul_form'=>'Data Daftar Ulang',
			'judul'=>'Daftar Ulang',
			'main_view'=>'view_daftar_ulang'
		];
		$this->load->view('template/index', $data);

	}

	public function bayar()
	{
		// echo "<pre>"; print_r($_POST); echo "</pre>";die();
		$bayar 	= str_replace('.', '', $_POST['bayar']);
		$sisa 	= str_replace('.', '', $_POST['sisa']);
		if ($bayar > $sisa) {
			$return = 1;
		} else {
			$data['pembayaran'] 		= $bayar;
			$data['sisa_pembayaran']	= $sisa - $bayar;
			if ($bayar == $sisa) {		
				$data['status_pembayaran']			= 'Lunas'; 
				$status = 'Lunas';
			} else {
				$status = 'Belum Lunas';
			}

			$b = $this->db->where('no_transaksi', $_POST['kd'])->get('daftar_ulang')->row_array();

			$data['pembayaran']	= $b['pembayaran'] + $bayar;
			
			$this->db->where('no_transaksi', $_POST['kd'])->update('daftar_ulang', $data);
			$return = 0;

			$input['no_transaksi']		= $_POST['kd'];
			$input['tanggal_transaksi']	= date('Y-m-d');
			$input['pembayaran']		= $bayar;
			$input['sisa_pembayaran']	= $sisa;
			$input['status_pembayaran']	= $status;
			// echo "<pre>"; print_r($input); echo "</pre>";die();
			$this->db->insert('detail_pembayaran', $input);

			$jurnal1 = array(
				'no_transaksi' => $_POST['kd'],
				'no_akun' => "111",
				'posisi' => "debit",
				'nominal' => $bayar
			);
			$query_jurnal1 = $this->model_pendaftaran->tambah("jurnal", $jurnal1);
			
			$jurnal2 = array(
				'no_transaksi' => $_POST['kd'],
				'no_akun' => "122",
				'posisi' => "kredit",
				'nominal' => $bayar
			);
			$query_jurnal2 = $this->model_pendaftaran->tambah("jurnal", $jurnal2);
		}

		echo json_encode($return);	
	}
}
