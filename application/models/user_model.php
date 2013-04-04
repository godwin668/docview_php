<?php
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function add($param) {
		$data = array(
				'user_id' => uniqid($param['app_id']),
				'app_id' => $param['app_id'],
				'app_uid' => $param['app_uid'],
				'username' => $param['username'],
				'password' => $param['password'],
				'email' => $param['email'],
			);
		$this->db->insert('user', $data);
	}
	
	function updateSid($user_id, $sid) {
		$data = array(
				'sid' => $sid,
			);
		$this->db->where('user_id', $user_id)
				 ->update('user', $data);
	}
	
	function get($user_id) {
		$this->db->from('user')
				 ->where('user_id', $user_id);
		$query = $this->db->get();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
	
	/**
	 * Get user info by username OR email
	 * 
	 * @param unknown $user
	 * @return NULL
	 */
	function getByUser($user) {
		$this->db->from('user')
			 ->where('username', $user)
			 ->or_where('email', $user);
		$query = $this->db->get();
	
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
	
	/**
	 * Get user info by username
	 * 
	 * @param unknown $username
	 * @return NULL
	 */
	function getByUsername($username) {
		$this->db->from('user')
				 ->where('username', $username);
		$query = $this->db->get();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
	
	/**
	 * Get user info by email
	 * 
	 * @param unknown $email
	 * @return NULL
	 */
	function getByEmail($email) {
		$this->db->from('user')
				 ->where('email', $email);
		$query = $this->db->get();
		
		if ($query->num_rows () < 1) {
			return NULL;
		} else {
			return $query->row_array();
		}
	}
	
	
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */