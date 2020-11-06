<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_laporan_kas extends CI_Model
{
    var $column_order = array(null, 'transaksi.no_transaksi','tanggal_transaksi','total_pengeluaran','keterangan','nama_jurnal'); //set column field database for datatable orderable
	var $column_search = array('transaksi.no_transaksi','tanggal_transaksi','total_pengeluaran','keterangan','nama_jurnal'); //set column field database for datatable searchable 
	var $order = array('transaksi.no_transaksi' => 'asc'); // default order 
	
	public function custom_query($query) 
    {
        $sql = $this->db->query($query);
        return $sql;
    }

    public function get_where($table, $field, $condition)
    {
        $this->db->select($field);
        $this->db->where($condition);
        $sql = $this->db->get($table);
        if($sql){
            return $sql->result();   
        }
        else{
            return false;
        }
    }
	
	public function get_row($table, $field, $condition)
    {
		$sql = $this->db->select($field)->where($condition)->get($table);        
		if($sql){
			return $sql->row();   
		}
		else{
			return false;
		}
    }
	
	public function kode() 
    {
        $get_no_transaksi = $this->db->query("select max(right(no_transaksi,6)) as max_id from pembayaran_jurnal");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		$no = "BB_".$kd;
		return $no;
    }
	
	public function tambah($table, $data) 
    {
        $q = $this->db->insert($table, $data);
        return $q;
    }
    
    public function ubah($table, $data, $condition) {
        $this->db->where($condition);
        return $this->db->update($table, $data);
		
    }
    
    public function hapus($table, $condition){
        $this->db->where($condition);
        return $this->db->delete($table);
		
    }
}