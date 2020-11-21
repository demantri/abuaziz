<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	
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
        $this->load->model('model_pendaftaran');
	}

	public function index()
	{
		$data = [
			'judul_form'=>'Data Pendaftaran',
			'judul'=>'Pendaftaran',
			'main_view'=>'view_pendaftaran'
		];
		$this->load->view('template/index', $data);
	}

	public function listajaran()
	{
		$q = $this->db->where('delete', 0)->get('tahun_ajaran')->result();
		
		if($q){
			echo "<select name='no_ajaran' id='no_ajaran' data-validate-field='no_ajaran' class='form-control'>
            <option value =''>- Pilih Angkatan -</option>";
			foreach($q as $row){
				echo "<option  value='$row->no'>$row->nama_ajaran</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list()
	{
		$list = $this->model_pendaftaran->get_datatables();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $siswa) {
			$hasil_cek = $this->model_pendaftaran->cek_pendaftaran($siswa->no_siswa);
			$no++;
			$spasi = "&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;";
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".date('d F Y', strtotime($siswa->tanggal_transaksi))."</span>";
			//$row[] = "<span class='size'>".$tanggal_transaksi."</span>";
			$row[] = "<span class='size'>".$siswa->nis."</span>";
			$row[] = "<span class='size'>".$siswa->nama_siswa."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($siswa->pembayaran,2,',','.')."</span>";
			//$row[] = $spasi."<span class='size'>Rp.".number_format($siswa['biaya_spp'],2,',','.')."</span>";
			$row[] = "<span class='size'>Rp. ".number_format($siswa->sisa_pembayaran,2,',','.')."</span>";
			$row[] = "<span class='size'>".$siswa->status_pembayaran."</span>";

			// $row[] = "<span class='size'>".$hasil_cek."</span>";
			$aksi = '';

			if ($hasil_cek == 'Sudah Bayar') {
			$aksi ='<a class="btn btn-xs btn-warning" title="Cetak" href='.site_url('pendaftaran/printpdf/'.$siswa->no_siswa).' target="_blank">
				<i class="fa fa-print"></i></a>';
				}

			// $aksi = '';
			// 	$aksi.='
			// 	<a class="btn btn-xs btn-primary" href="javascript:void()" title="Edit" onclick="edit(\''. $siswa->no_siswa.'\')">
			// 	<i class="fa fa-pencil"></i></a>';
			if ($siswa->status_pembayaran == 'Belum Lunas') {
					$aksi.='&nbsp <a class="btn btn-xs btn-info bayar" sisa="'.$siswa->sisa_pembayaran.'" no="'.$siswa->no_siswa.'" kd="'.$siswa->no_transaksi.'" title="Bayar">
					<i class="fa fa-money"></i></a>';
				}
		 	$row[] = $aksi;


			$data[] = $row;
			

		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_pendaftaran->count_all(),
						"recordsFiltered" => $this->model_pendaftaran->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function printpdf($id)
	{
		$data['main_view']	= 'bukti_transaksi2';
		$data['siswa'] = $this->db->where('no_siswa', $id)->get('siswa')->row_array()['nama_siswa'];
		$data['result']		= $this->getDatatrx($id);
		$this->load->view('template/print', $data);
	}


	public function get_biaya()
	{
		$data = $this->db->select('sum(harga_rincian) as total')->where('transaksi_utama', 'pendaftaran')->get('rincian_biaya')->row_array();
		echo json_encode($data);
	}

	public function getDatatrx($id)
	{
		return $this->db->select('*')->from('siswa a')->join('pendaftaran b', 'a.no_siswa = b.no_siswa')->join('detail_pembayaran c', 'b.no_transaksi = c.no_transaksi')->where('b.no_siswa', $id)->get()->result();
	}

	public function tambah(){

		//  $this->form_validation->set_rules('no_siswa', 'Nomor Siswa', 'required|trim|is_unique[siswa.nama_siswa]', array('required' => '%s Tidak boleh kosong', 'is_unique' => 'Nomor siswa telah tersedia'));
		//  $this->form_validation->set_rules('no_telepon_ortu', 'No Telepon', 'required|trim|numeric', array('required' => '%s Tidak Boleh kosong', 'numeric' => '%s Harus berupa angka'));

		// if ($this->form_validation->run() == TRUE) {
		
		$no_siswa = $this->model_pendaftaran->kode();
		$data_pendaftaran = array(
			'no_siswa' => $no_siswa,
			'tanggal_transaksi' => date('Y-m-d', strtotime($this->input->post("tanggal_transaksi"))),
			'nis' => $this->input->post("nis"),
			'nama_siswa' => $this->input->post("nama_siswa"),
			'alamat_siswa' => $this->input->post("alamat_siswa"),
			// 'no_telepon' => $this->input->post("no_telepon"),
			'jenis_kelamin' => $this->input->post("jenis_kelamin"),
			'tanggal_lahir' => $this->input->post("tanggal_lahir"),
			'tempat_lahir' => $this->input->post("tempat_lahir"),
			'nama_ayah' => $this->input->post("nama_ayah"),
			'nama_ibu' => $this->input->post("nama_ibu"),
			'no_telepon_ortu' => $this->input->post("no_telepon_ortu"),
			'status_siswa' => 'Siswa',
			'delete' => "0",
			'angkatan'	=> $_POST['no_ajaran']
		);
		print_r($data_pendaftaran);exit;
		$q = $this->model_pendaftaran->tambah('siswa', $data_pendaftaran);
		
		$no_transaksi = $this->model_pendaftaran->kode_tr();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			// 'tanggal_transaksi' => date('Y-m-d', strtotime($this->input->post("tanggal_transaksi"))),
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			// 'jam' => $this->input->post("jam"),
			'nama_transaksi' => "pendaftaran",
			'no_user' => $this->session->userdata('no_user')
		);
		
		$transaksi = $this->model_pendaftaran->tambah('transaksi', $data_transaksi);

		// record data after processing pendaftaran into kelas
		$data_kelas = array (
			'no_siswa' => $no_siswa,
			'nama_kelas' => $this->input->post('kelas')
		);
		$record_kelas = $this->model_pendaftaran->tambah('kelas', $data_kelas);
		
		$jenis_pembayaran=$this->input->post("jenis_pembayaran");
		if($jenis_pembayaran == "tunai"){
			$status="Lunas";
		}else{
			$status="Belum Lunas";
		}
		
		$data_pendaftaran = array(
			'no_transaksi' => $no_transaksi,
			'no_siswa' => $no_siswa,
			// 'tanggal_transaksi' => date('Y-m-d', strtotime($this->input->post("tanggal_transaksi"))),
			'biaya_pendaftaran' => $this->input->post("pembayaran"),
			'pembayaran' => $this->input->post("pembayaran"),
			'sisa_pembayaran' => $this->input->post("sisa_pembayaran"),
			'status_pembayaran' => $status
		);
		
		$pendaftaran = $this->model_pendaftaran->tambah('pendaftaran', $data_pendaftaran);

		if($pendaftaran){
			$jurnal1 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "111",
				'posisi' => "debit",
				'nominal' => $this->input->post("pembayaran")
			);
			$query_jurnal1 = $this->model_pendaftaran->tambah("jurnal", $jurnal1);
			
			if($jenis_pembayaran == "tunai"){
				$jurnal1 = array(
					'no_transaksi' => $no_transaksi,
					'no_akun' => "425",
					'posisi' => "debit",
					'nominal' => $_POST["biaya_pendaftaran"]-$_POST["pembayaran"]
				);
				$query_jurnal1 = $this->model_pendaftaran->tambah("jurnal", $jurnal1);
				$status = 'Lunas';
			} else {
				$jurnal1 = array(
					'no_transaksi' => $no_transaksi,
					'no_akun' => "425",
					'posisi' => "debit",
					'nominal' => $_POST["biaya_pendaftaran"]-str_replace('.', '', $_POST["tbiaya_pendaftaran"])
				);
				$query_jurnal1 = $this->model_pendaftaran->tambah("jurnal", $jurnal1);
			
				$jurnal1 = array(
					'no_transaksi' => $no_transaksi,
					'no_akun' => "121",
					'posisi' => "debit",
					'nominal' => $this->input->post("sisa_pembayaran")
				);
				$query_jurnal1 = $this->model_pendaftaran->tambah("jurnal", $jurnal1);

				$status = 'Belum Lunas';
			}
			
			$jurnal2 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "421",
				'posisi' => "kredit",
				'nominal' => $this->input->post("biaya_pendaftaran")
			);
			
			$query_jurnal2 = $this->model_pendaftaran->tambah("jurnal", $jurnal2);

			$input['no_transaksi']		= $no_transaksi;
			$input['tanggal_transaksi']	= date('Y-m-d', strtotime($this->input->post("tanggal_transaksi")));
			$input['pembayaran']		= $this->input->post("pembayaran");
			$input['sisa_pembayaran']	= $this->input->post("sisa_pembayaran");
			$input['status_pembayaran']	= $status;
			//echo "<pre>"; print_r($input); echo "</pre>";die();
			$this->db->insert('detail_pembayaran', $input);
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	
		// } else {
		// 	$errors = validation_errors();
		// 	$this->session->set_flashdata('formErr', $errors);
		// }
	}
	public function validasi()
	{
		$data=$this->db->where('nis',$_POST['nis'])->get('siswa')->num_rows();

		echo json_encode($data);
		// var_dump($data);
		// die();


	}

	public function data()
	{
		$no_siswa = $this->input->post("no_siswa");
		$field = array('*');
		$data = $this->model_pendaftaran->get_row('siswa', $no_siswa);
		echo json_encode($data);
	}
	
	public function ubah()
	{
		$no_siswa = $this->input->post("aksi");
		$field = array('*');
		$data_pendaftaran = array(
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
		$q = $this->model_pendaftaran->ubah("siswa", $data_pendaftaran, "no_siswa = '$no_siswa' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function hapus()
	{
		$no_siswa = $this->input->post("no_siswa");
		$field = array('*');
		$data_pendaftaran = array(
			'delete' => 1
		);
		$q = $this->model_pendaftaran->hapus("siswa", $data_pendaftaran, "no_siswa = '$no_siswa' ");
		if($q){
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}

	public function getpotongan()
	{
		$q = $this->db->where('delete', 0)->get('potongan_biaya')->result();		
		if($q){
			echo "<select name='no_potongan' id='no_potongan' data-validate-field='no_potongan' class='form-control'>
            <option value =''>--Pilih Diskon--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_potongan'>$row->nama_potongan</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}

	public function getdiskon()
	{
		$data = $this->db->where('no_potongan', $_POST['diskon'])->get('potongan_biaya')->row_array()['potongan'];

		echo json_encode($data);
	}
	
	public function bayar()
	{
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

			$b = $this->db->where('no_transaksi', $_POST['kd'])->get('pendaftaran')->row_array();

			$data['pembayaran']	= $b['pembayaran'] + $bayar;

			$this->db->where('no_siswa', $_POST['no'])->update('pendaftaran', $data);
			$return = 0;

			$input['no_transaksi']		= $_POST['kd'];
			$input['tanggal_transaksi']	= date('Y-m-d');
			$input['pembayaran']		= $bayar;
			$input['sisa_pembayaran']	= $sisa;
			$input['status_pembayaran']	= $status;
			//echo "<pre>"; print_r($input); echo "</pre>";die();
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
				'no_akun' => "121",
				'posisi' => "kredit",
				'nominal' => $bayar
			);
			$query_jurnal2 = $this->model_pendaftaran->tambah("jurnal", $jurnal2);
		}

		echo json_encode($return);	
	}
}
