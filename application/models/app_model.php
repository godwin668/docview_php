<?php
class App_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function add($param) {
		$data = array(
				'app_id' => $param['app_id'],
				'name' => $param['name'],
				'token' => $param['token'],
				'phone' => $param['phone'],
				'status' => $param['status'],
			);
		$this->db->insert('app', $data);
	}
	
	function get($domain) {
		$this->db->from('app')
				 ->where('app_id', $domain );
		$query = $this->db->get();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */