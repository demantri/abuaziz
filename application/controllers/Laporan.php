<?php
/**
 * 
 */
class laporan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
		$this->load->model('m_laporan');
	}
	public function index(){
		$data = array(
			'pendapatan'=> $this->m_laporan->pendapatan(),
			'judul_form'=>'Laporan',
			'judul'=>'Pendapatan SPP',
			'main_view'=>'laporan'
		);
		$this->load->view('template/index', $data);

	}
}