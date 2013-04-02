<?php
class Doc_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function add($domain) {
		$this->db->from ( 'app' )->where ( 'app_id', $domain );
		$query = $this->db->get ();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row ();
		}
	}
}

/* End of file doc_model.php */
/* Location: ./application/models/doc_model.php */