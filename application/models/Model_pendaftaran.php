<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_pendaftaran extends CI_Model
{
    var $column_order = array(null, 'nis', 'transaksi.tanggal_transaksi', 'nama_siswa'); //set column field database for datatable orderable
	var $column_search = array('nis','nama_siswa', 'transaksi.tanggal_transaksi'); //set column field database for datatable searchable 
	var $order = array('siswa.no_siswa' => 'asc'); // default order 
	
	private function _get_datatables_query()
	{
		$this->db->from('transaksi');
		$this->db->join('pendaftaran', 'pendaftaran.no_transaksi = transaksi.no_transaksi');
		$this->db->join('siswa', 'pendaftaran.no_siswa = siswa.no_siswa', 'left');
		$this->db->where('transaksi.nama_transaksi', 'pendaftaran');
		$this->db->order_by('transaksi.tanggal_transaksi');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			$this->db->where('delete', '0');
			$this->db->where('status_siswa', 'Siswa');
			if($_POST['search']['value'])
			//if(isset($_POST['search']['value'])) // if datatable send POST for search
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

	public function cek_pendaftaran($no_siswa)
	{
		$query = $this->db->query("select * from pendaftaran
		left join transaksi on pendaftaran.no_transaksi=transaksi.no_transaksi
		where pendaftaran.no_siswa='$no_siswa'");
		if($query->num_rows()>0){
			return "Sudah Bayar";  
		}else{
			return "Belum Bayar";
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
		$this->db->from('transaksi');
		$this->db->join('pendaftaran', 'pendaftaran.no_transaksi = transaksi.no_transaksi');
		$this->db->join('siswa', 'pendaftaran.no_siswa = siswa.no_siswa', 'left');
		$this->db->where('transaksi.nama_transaksi', 'pendaftaran');
		$this->db->order_by('transaksi.tanggal_transaksi');
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
	
	public function get_row($table, $no_siswa)
    {
		$sql = $this->db->query("select * from $table
		left join pendaftaran on $table.no_siswa=pendaftaran.no_siswa
		left join transaksi on pendaftaran.no_transaksi=transaksi.no_transaksi
		where siswa.no_siswa='$no_siswa'");        
		if($sql){
			return $sql->row();   
		}
		else{
			return false;
		}
    }
	
	public function kode() 
    {
        $get_no_transaksi = $this->db->query("select max(right(no_siswa,6)) as max_id from siswa");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		$no = "Ssw_".$kd;
		return $no;
    }
	
	public function kode_tr() 
    {
        $get_no_transaksi = $this->db->query("select max(right(no_transaksi,6)) as max_id from pendaftaran");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		$no = "Npd_".$kd;
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
}