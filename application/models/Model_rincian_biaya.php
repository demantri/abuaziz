<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_rincian_biaya extends CI_Model
{
    var $column_order = array(null, 'nama_rincian', 'transaksi_utama', 'harga_rincian'); //set column field database for datatable orderable
	var $column_search = array('nama_rincian', 'transaksi_utama', 'harga_rincian'); //set column field database for datatable searchable 
	var $order = array('no_rincian' => 'asc'); // default order 
	
	private function _get_datatables_query()
	{
		
		$this->db->from('rincian_biaya');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			$this->db->where('delete', '0');
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('rincian_biaya');
		$this->db->where('delete', '0');
		return $this->db->count_all_results();
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
        $get_no_transaksi = $this->db->query("select max(right(no_rincian,6)) as max_id from rincian_biaya");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		$no = "Rcb_".$kd;
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
    
    public function hapus($table, $data, $condition){
        $this->db->where($condition);
        return $this->db->update($table, $data);
		
    }

    public function GetDataTransaksi(){
        return $this->db->get('rincian_biaya')->result();
    }

    public function getsum(){

        $sql = "SELECT SUM(harga_rincian) as harga_rincian FROM rincian_biaya";
        $result = $this->db->query($sql);
        return $result->row()->harga_rincian;
    }
    // public function getsum(){
    //     $sql = "SELECT SUM(harga_rincian) as harga_rincian FROM rincian_biaya";
    //     $result = $this->db->query($sql);
    //     return $result->row()->harga_rincian;
    // }

}