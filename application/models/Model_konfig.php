<?php

class Model_konfig extends CI_Model  {
    
		
	function __construct()
    {
        parent::__construct();
    }

	function dataProfile($table, $field, $condition)
    {
		$sql = $this->db->select($field)->where($condition)->get($table);        
		if($sql){
			return $sql->row();   
		}
		else{
			return false;
		}
    }
	
	function dataKonfig($id)
	{
		$data=$this->db->get_where("main_konfig",array("id_konfig"=>$id))->row();
		return $data->value;
	}
	
	function cekFoto($no_user)
	{
		$data=$this->db->get_where("user",array("no_user"=>$no_user))->row();
		$foto = $data->foto;
		$jenis_kelamin = $data->jenis_kelamin;
		if($foto != NULL){
			return $data->foto;
		}else{
			if($jenis_kelamin =="Laki-laki"){
				return "avatarco.png";
			}else{
				return "avatarcw.png";
			}
		}
	}
	
	function menu($no_akses)
	{
        $sql = $this->db->query("SELECT submenu.no_menu as no_menu, 
		hak_akses.no_submenu as no_submenu, 
		menu.nama_menu as nama_menu, 
		menu.controller as controller, 
		COUNT(submenu.no_menu) AS jumlah_sub, 
		menu.tipe as tipe 
		FROM submenu LEFT JOIN menu ON submenu.no_menu = menu.no_menu 
		LEFT JOIN hak_akses ON submenu.no_submenu = hak_akses.no_submenu 
		WHERE jenis = 'Admin' AND no_akses = '".$no_akses."' 
		and menu.delete='0' GROUP BY submenu.no_menu");
        return $sql->result();
	}
	
	function subMenu($no_akses)
	{
        $sql = $this->db->query("SELECT * FROM submenu LEFT JOIN hak_akses ON submenu.no_submenu = hak_akses.no_submenu WHERE no_akses = '".$no_akses."' and submenu.delete='0' ORDER BY submenu.urutan asc");
        return $sql->result();
	}
	
	function noMenu($controller)
    {
		$sql = $this->db->select('*')->where(array("controller"=>$controller))->get('submenu')->row();        
		if($sql){
			return $sql->no_menu;   
		}
		else{
			return "none";
		}
    }
	
	function hakAkses($no_akses, $controller)
    {
		$this->db->select('*');
		$this->db->from('hak_akses');
		$this->db->where('no_akses', $no_akses);
		$this->db->where('controller', $controller);
		$this->db->where('hak_akses.delete', false);
		$this->db->join('submenu', 'hak_akses.no_submenu = submenu.no_submenu', 'left');
		$sql = $this->db->get(); 
		if($sql){
			return $sql->row();   
		}
		else{
			return false;
		}
    }
}