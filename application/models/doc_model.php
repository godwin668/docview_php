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
	
	
	
	
	
	
	
	
}

/* End of file doc_model.php */
/* Location: ./application/models/doc_model.php */