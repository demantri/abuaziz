<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_potongan_biaya extends CI_Model
{
    var $column_order = array(null, 'no_potongan', 'nama_potongan', 'potongan'); //set column field database for date(format)tatable orderable
	var $column_search = array('no_potongan', 'nama_potongan', 'potongan'); //set column field database for datatable searchable 
	var $order = array('no_potongan' => 'asc'); // default order 
	
	private function _get_datatables_query()
	{
		$this->db->from('potongan_biaya');
		$this->db->join('rincian_biaya', 'potongan_biaya.no_rincian = rincian_biaya.no_rincian', 'left');
		$this->db->where('rincian_biaya.delete', '0');
		$this->db->where('potongan_biaya.delete', '0');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
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
		$this->db->from('potongan_biaya');
		$this->db->join('rincian_biaya', 'potongan_biaya.no_rincian = rincian_biaya.no_rincian', 'left');
		$this->db->where('rincian_biaya.delete', '0');
		$this->db->where('potongan_biaya.delete', '0');
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
        $get_no_transaksi = $this->db->query("select max(right(no_potongan,6)) as max_id from potongan_biaya");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		$no = "Ptb_".$kd;
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
        return $this->db->get('potongan_biaya')->result();
    }

    public function GetDataRincian(){
        return $this->db->get('rincian_biaya')->result_array();
    }

   public function GetDataDetailTransaksi($id){
        //mengambil data deatail transaksi/ daftar belanja
        $this->db->select('no_potongan, potongan_biaya, a.kode_barang, nama_barang, harga_barang, a.jumlah, subtotal');
        $this->db->from('detail_penjualan a');
        $this->db->join('barang b', 'b.kode_barang = a.kode_barang');
        $this->db->where('id_beli', $id);
        $query = $this->db->get();    
        return $query->result_array();
    }
    public function get_keyword($keyword){
    	$this->db->select('*');
    	$this->db->from('rincian_biaya');
    	//$this->db->like('')
    	return $this->db->get()->result();
    }
}