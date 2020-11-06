<?php 
	/**
	 * 
	 */
	class users_model extends ci_model
	{
		
		// function __construct(argument)
		// {
		// 	# code...
		// }

		public function get_user()
		{
			$sql = $this->db->get('user');
			return $sql->result();
		}

		public function save($input)
		{
			# code...
			$query = $this->db->insert('user' ,$input);
			return $query;
		}

		public function hapus_data($where, $table)
		{
			# code...
			$this->db->where($where);
			$this->db->delete($table);
		}

		public function userByid($id)
		{
			# code...
			$query = $this->db->query("SELECT * FROM USER WHERE id = '$id'");
			if ($query->num_rows() > 0) {
				# code...
				foreach ($query->result() as $data) {
					# code...
					$hasil = array (
						'id'	=> $data->id,
						'username'	=> $data->username,
						'password'	=> md5($data->password),
						'jabatan'	=> $data->jabatan,
					);
				}
			}
			return $hasil;
		}

		public function update_data($id, $no_user, $username, $password, $jabatan)
		{
			# code...
			$query = $this->db->query("UPDATE USER SET no_user = '$no_user', username = '$username', password = '$password', jabatan = '$jabatan'
				WHERE id = '$id' ");
			return $query;
		}

		// start datatables
	    var $column_order = array(null, 'no_user', 'username', null, 'jabatan'); //set column field database for datatable orderable
	    var $column_search = array('no_user', 'username', 'jabatan'); //set column field database for datatable searchable
	    var $order = array('id' => 'asc'); // default order 
	 
	    private function _get_datatables_query() {
	        $this->db->select('*');
	        $this->db->from('user');
	        $i = 0;
	        foreach ($this->column_search as $item) { // loop column 
	            if(@$_POST['search']['value']) { // if datatable send POST for search
	                if($i===0) { // first loop
	                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                    $this->db->like($item, $_POST['search']['value']);
	                } else {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) { // here order processing
	            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        }  else if(isset($this->order)) {
	            $order = $this->order;
	            $this->db->order_by(key($order), $order[key($order)]);
	        }
	    }
	    function get_datatables() {
	        $this->_get_datatables_query();
	        if(@$_POST['length'] != -1)
	        $this->db->limit(@$_POST['length'], @$_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	    function count_filtered() {
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	    function count_all() {
	        $this->db->from('user');
	        return $this->db->count_all_results();
	    }
	    // end datatables


	}
?>