<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('admin');
        }
        $this->load->model("model_dashboard");
    }
	public function index()
	{
		$field = array('*');
		$data = [
			'judul_form'=>'Data Dashboard',
			'judul'=>'Dashboard',
			'main_view'=>'blank'
		];
		$this->load->view('template/index', $data);
	}
}