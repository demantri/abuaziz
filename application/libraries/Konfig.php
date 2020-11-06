<?php 
class Konfig
{
	public function dataKonfig($id)
	{
		$ci = &get_instance();
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->dataKonfig($id);
	}
	
	public function dataProfile($no_user)
	{
		$ci = &get_instance();
		$field = array('*');
		$condition = array(
						'no_user' => $no_user
					);
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->dataProfile('user', $field, $condition);
	}
	
	public function cekFoto($no_user)
	{
		$ci = &get_instance();
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->cekFoto($no_user);
	}
	
	public function menu($no_akses)
	{
		$ci = &get_instance();
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->menu($no_akses);
	}
	
	public function subMenu($no_akses)
	{
		$ci = &get_instance();
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->subMenu($no_akses);
	}
	
	public function noMenu($controller)
	{
		$ci = &get_instance();
		$ci->load->model("Model_konfig");
		return $ci->Model_konfig->noMenu($controller);
	}
}
