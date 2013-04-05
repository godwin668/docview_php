<?php
class Doc_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Add document
	 * 
	 * @param unknown $param
	 */
	function add($param) {
		$data = array(
				'doc_id' => $param['doc_id'],
				'app_id' => $param['app_id'],
				'user_id' => $param['user_id'],
				'uuid' => $param['uuid'],
				'name' => $param['name'],
				'size' => $param['size'],
				'ext' => $param['ext'],
				'mode' => $param['mode'],
		);
		$this->db->insert('doc', $data);
	}
	
	function getByUuid($uuid) {
		$this->db->from('doc')
			 ->where('uuid', $uuid);
		$query = $this->db->get();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
	
	function getList($data) {
		$current_page = $data['sEcho'];
		$column_count = $data['iColumns'];
		$record_start = $data['iDisplayStart'];
		$record_length = $data['iDisplayLength'];
		
		$sort_column_index = $data['iSortCol_0'];			// 0-based
		$sort_column_name = $data['mDataProp_' . $sort_column_index];
		$sort_direction = $data['sSortDir_0'];				// asc OR desc
		
		$search_string = $data['sSearch'];
		
		$this->db->from('doc')
				 ->like('name', $search_string)
				 ->or_like('uuid', $search_string)
				 ->limit($record_length, $record_start)
				 ->order_by($sort_column_name, $sort_direction);
		$query = $this->db->get();
		
		return $query->result_array();
		
		/*
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
		*/
	}
	
	function count($data) {
		$search_string = $data['sSearch'];
		$this->db->from('doc')
				 ->like('name', $search_string)
				 ->or_like('uuid', $search_string);
		return $this->db->count_all_results();
	}
	
}

/* End of file doc_model.php */
/* Location: ./application/models/doc_model.php */