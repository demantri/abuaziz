 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan_dll extends CI_Controller {
	
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
        $this->load->model('model_pendapatan_dll');
	}

	public function index($add = 'enable')
	{
		if($this->session->userdata('jabatan') == 'Tata Usaha'){
			$form  = 'Data Pendapatan Lain - Lain';
			$title = 'Pendapatan Lain - Lain';
		
		}else{
			$form  = 'Data Pemasukan Yayasan';
			$title = 'Pemasukan Yayasan';
		}

		$data = [
			'judul_form' => $form,
			'judul'=> $title,
			'main_view'=>'view_pendapatan_dll',
			'add'	=> $add
		];
		$this->load->view('template/index', $data);
	}
	
	public function list_siswa()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0",
			'input_by' => $this->session->userdata('jabatan')
		);
		$q = $this->model_pendapatan_dll->get_where('master_pendapatan', $field, $condition);
		
		if($q){
			echo "<select name='no_pendapatan' id='no_pendapatan' data-validate-field='no_pendapatan' class='form-control'>
            <option value =''>--Pilih Pendapatan--</option>";
			foreach($q as $row){
				echo "<option  value='$row->no_pendapatan'>$row->nama_pendapatan</option>";
			}
			echo "</select>";
		}
		else{
			echo json_encode(array('status' => false));
		}
	}
	
	public function ajax_list($tipe = '')
	{
		$list = $this->model_pendapatan_dll->get_datatables($tipe);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pendapatan_dll) {
			$no++;
			$row = array();
			$row[] = "<span class='size'>".$no."</span>";
			$row[] = "<span class='size'>".$pendapatan_dll->no_pendapatan."</span>";
			$row[] = "<span class='size'>".date('d F Y', strtotime($pendapatan_dll->tanggal_transaksi))."</span>";
			$row[] = "<span class='size'>".$pendapatan_dll->nama_pendapatan."</span>";
			$row[] = "<span class='size pull-right'>Rp. ".number_format($pendapatan_dll->jumlah_pendapatan,2,',','.')."</span>";
			$row[] = "<span class='size'>".$pendapatan_dll->keterangan."</span>";
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->model_pendapatan_dll->count_all($tipe),
						"recordsFiltered" => $this->model_pendapatan_dll->count_filtered($tipe),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tambah(){
		
		$no_transaksi = $this->model_pendapatan_dll->kode();
		$data_transaksi = array(
			'no_transaksi' => $no_transaksi,
			'tanggal_transaksi' => $this->input->post("tanggal_transaksi"),
			'nama_transaksi' => "pendapatan lain-lain",
			'no_user' => $this->session->userdata('no_user'),
			'transaction_by'	 => $this->session->userdata('jabatan')
		);
		
		$transaksi = $this->model_pendapatan_dll->tambah('transaksi', $data_transaksi);
		
		$data_pendapatan = array(
			'no_transaksi' => $no_transaksi,
			'no_pendapatan' => $this->input->post("no_pendapatan"),
			'jumlah_pendapatan' => $this->input->post("jumlah_pendapatan"),
			'keterangan' => $this->input->post("keterangan"),
			'trans_by'	 => $this->session->userdata('jabatan')
		);
		
		$pendapatan_dll = $this->model_pendapatan_dll->tambah('pendapatan_lain_lain', $data_pendapatan);
		if($pendapatan_dll){

			if($this->session->userdata('jabatan') == 'Tata Usaha'){
				$coa = '423';
			}else{
				$coa = $this->db->where('no_pendapatan', $this->input->post('no_pendapatan'))
				                ->get('master_pendapatan')->row_array()['no_akun'];
			}

			$jurnal1 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => "111",
				'posisi' => "debit",
				'nominal' => $this->input->post("jumlah_pendapatan")
			);
			$query_jurnal1 = $this->model_pendapatan_dll->tambah("jurnal", $jurnal1);
			
			$jurnal2 = array(
				'no_transaksi' => $no_transaksi,
				'no_akun' => $coa,
				'posisi' => "kredit",
				'nominal' => $this->input->post("jumlah_pendapatan")
			);


			$query_jurnal2 = $this->model_pendapatan_dll->tambah("jurnal", $jurnal2);
			echo json_encode(array('status' => "benar"));
		}else{
			echo json_encode(array('status' => "salah"));
		}
	}
}
