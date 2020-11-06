<?php 
	/**
	 * 
	 */
	class Users extends ci_controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$this->output->set_header('Pragma: no-cache');

			if (!$this->session->userdata('no_user')) {
				redirect('auth');
			}
			$this->load->model('users_model');
		}

		public function index()
		{
			# code...
			$data['user'] = $this->users_model->get_user();
			// print_r($data['user']);exit;
			// $this->load->view('template/index');
			$field = array('*');
			$data = [
				'judul_form'=>'Data Users',
				'judul'=>'Users',
				'main_view'=>'user/index',
				// 'user' => $this->users_model->get_user()
			];
			$this->load->view('template/index', $data);
		}

		// public function list_data()
		// {
		// 	$draw = intval($this->input->get('draw'));
		// 	$start = intval($this->input->get('start'));
		// 	$length = intval($this->input->get('length'));

		// 	$query = $this->users_model->get_user();
		// 	// print_r($query);exit;
		// 	$result = [];
		// 	// foreach ($query as $data) {
		// 	// 	# code...
		// 	// 	$data[] = array 
		// 	// 	(
		// 	// 		$id = $data['id'],
		// 	// 		$no_user = $data['no_user'],
		// 	// 		$username = $data['username'],
		// 	// 		$password = $data['password'],
		// 	// 		$jabatan = $data['jabatan']
		// 	// 	);
		// 	// }
		// 	// $result = array (
		// 	// 	"draw" => $draw,
		// 	// 	"recordsTotal" => $query->num_rows(),
		// 	// 	"recordsFiltered" => $query->num_rows(),
		// 	// 	"data" => $data,
		// 	// );
		// 	// if (count($query) > 0) {
		// 	// 	# code...
		// 	// 	foreach ($query as $data) {
		// 	// 		# code...
		// 	// 		$data[] = $data;
		// 	// 	}
		// 	// 	// return $data;
		// 	// }
		// 	// $result = array (
		// 	// 	'draw' => $draw,
		// 	// 	'data' => $data
		// 	// );
			
		// 	$no = 1;
		// 	foreach ($query as $data) {
		// 		# code...
		// 		// $result[] = $this->_data_row($data);
		// 		$result[] = array (
		// 			$no++,
		// 			$username = $data->username,
		// 			$password = md5($data->password),
		// 			$action = 
					// '<div class="text-center">
					// 	<a data-toggle="modal" data-target="#modal-edit-user" class="btn btn-warning btn-xs edit" data="'. $data->id .'"><i class="fa fa-pencil"></i></a>
					// 	<a href="javascript:;" class="btn btn-danger btn-xs hapus" data="'. $data->id .'"><i class="fa fa-trash"></i></a>
					// </div>'
		// 		);
		// 	}
		// 	// return array (
		// 	// 			$no++,
		// 	// 			$no_user,
		// 	// 			$username,
		// 	// 			$password,
		// 	// 			$jabatan
		// 	// 		);
		// 	echo json_encode(array("data" => $result));
		// }

		// private function _data_row($data)
		// {
		// 	$no = 1;
		// 	$no_user = $data->no_user;
		// 	$username = $data->username;
		// 	$password = md5($data->password);
		// 	$jabatan = $data->jabatan;
		// 	// print_r($no_user);
		// 	return array (
		// 		$no++,
		// 		$no_user,
		// 		$username,
		// 		$password,
		// 		$jabatan
		// 	);
		// }

		public function list_data()
		{
			# code...
			$list = $this->users_model->get_datatables();
			// print_r($list);exit;
			$data = array();
			$no = @$_POST['start'];
			
			foreach ($list as $r) {
				# code...
				$no++;
				$hasil = [];
				$hasil[] = $no.".";
				$hasil[] = $r->no_user;
				$hasil[] = $r->no_user;
				$aksi = 
				'<div class="text-center">
					<a data-toggle="modal" data-target="#modal-edit-user" class="btn btn-warning btn-xs edit" data="'. $r->id .'"><i class="fa fa-pencil"></i></a>
					<a href="javascript:;" class="btn btn-danger btn-xs hapus" data="'. $r->id .'"><i class="fa fa-trash"></i></a>
				</div>';
				$hasil[] = $aksi;
				$data[] = $hasil;
			}
			$output = array 
			(
				"draw"	=>     @$_POST["draw"],  
                "recordsTotal"	=>      $this->users_model->count_all(),  
                "recordsFiltered"	=>     $this->users_model->count_filtered(),  
                "data"	=>     $data  
			);
			echo json_encode($output);
		}

		public function save()
		{
			// coba diarray kalo gabisa di 1-1
			$input = array (
				'no_user' 	=> 	$this->input->post('username'),
				'username' 	=> 	$this->input->post('username'),
				'password' 	=> 	$this->input->post('password'),
				'jabatan' 	=>	$this->input->post('jabatan')
			);
			// $no_user = $this->input->post('username');
			// $username = $this->input->post('username');
			// $password = $this->input->post('password');
			// $jabatan = $this->input->post('jabatan');
			$data = $this->users_model->save($input);
			echo json_encode($data);
		}

		public function get_user()
		{
			# code...
			$id = $this->input->get('id');
			$data = $this->users_model->userByid($id);
			echo json_encode($data);
		}

		public function update_data()
		{
			$id = $this->input->post('id');
			$no_user = $this->input->post('username');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$jabatan = $this->input->post('jabatan');

			$data = $this->users_model->update_data($id,$no_user, $username, $password, $jabatan);
			echo json_encode($data);
		}
	}
?>