 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_spp extends CI_Model
{
    var $column_order = array(null, 'nis', 'nama_siswa', 'transaksi.tanggal_transaksi', 'biaya_spp', 'keterangan'); //set column field database for datatable orderable
	var $column_search = array('nis', 'nama_siswa', 'transaksi.tanggal_transaksi', 'biaya_spp', 'keterangan'); //set column field database for datatable searchable 
	var $order = array('spp.no_transaksi' => 'asc'); // default order 
	
	private function _get_datatables_query()
	{
		$this->db->select('nis, nama_siswa, siswa.no_siswa, biaya_spp');
		$this->db->from('siswa');
		$this->db->join('spp', 'siswa.no_siswa = spp.no_siswa', 'left');
		$this->db->join('transaksi', 'spp.no_transaksi = transaksi.no_transaksi', 'left');
		$this->db->where('siswa.delete', '0');
		$this->db->where('siswa.status_siswa', 'Siswa');
		// $this->db->where ('month(transaksi.tanggal_transaksi)',date('m'));
		$this->db->group_by('siswa.no_siswa'); 
		$this->db->order_by('siswa.no_siswa ASC');
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
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->select('nis, nama_siswa, siswa.no_siswa, biaya_spp');
		$this->db->from('siswa');
		$this->db->join('spp', 'siswa.no_siswa = spp.no_siswa', 'left');
		$this->db->join('transaksi', 'spp.no_transaksi = transaksi.no_transaksi', 'left');
		$this->db->where('siswa.delete', '0');
		$this->db->where('siswa.status_siswa', 'Siswa');
		// $this->db->where ('month(transaksi.tanggal_transaksi)',date('m'));
		$this->db->group_by('siswa.no_siswa'); 
		$this->db->order_by('siswa.no_siswa ASC');
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
	
	public function cek_spp($no_siswa, $bulan)
	{
		$query = $this->db->query("select * from spp
		left join transaksi on spp.no_transaksi=transaksi.no_transaksi
		where spp.no_siswa='$no_siswa' and MONTH( transaksi.tanggal_transaksi ) = '$bulan'");
		if($query->num_rows()>0){
			return "Sudah Bayar";  
		}else{
			return "Belum Bayar";
		}
	}
	
	public function kode() 
    {
        $get_no_transaksi = $this->db->query("select max(right(no_transaksi,6)) as max_id from spp");
		$kd = "";
		if($get_no_transaksi->num_fields()>0){
			foreach($get_no_transaksi->result() as $k){
				$tmp = ((int)$k->max_id)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";        
		}
		$no = "SPP_".$kd;
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