<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
	
	public function index()
	{
		$this->load->view("login");
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model("model_auth");

		$field = array('*');		//sama dengan select username, password
		$condition = array(
						'username' => $username, 
						'password' => $password,
						'delete' => '0'
					);	
		//sama dengan where username = $user and password = $pass
		$result = $this->model_auth->get_row('user', $field, $condition);
		//parameter fungsi get_where($table, $field, $condition)
		// print_r($result);exit;
		$cek_blokir = array(
						'username' => $username, 
						'password' => $password,
						'delete' => '1'
					);
		$q_blokir = $this->model_auth->get_row('user', $field, $cek_blokir);

		if($q_blokir)
		{
			echo json_encode(array('status' => "blokir"));
		}else{
			if($result)
			{
				$userdata = array(
					'no_user' => $result->no_user,
					'username' => $result->username,
					'jabatan' => $result->jabatan,
					'password' => $result->password
				);
				$this->session->set_userdata($userdata);
				echo json_encode(array('status' => "benar"));
			}else{
				echo json_encode(array('status' => "salah"));
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
