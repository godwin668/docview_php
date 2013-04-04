<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {
	
	function __construct() {
		parent::__construct ();
		
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 ); // creates the various parts
		$subdomain_name = $subdomain_arr [0]; // assigns the first part
		
		$this->load->model ( 'App_model' );
		$app_info = $this->App_model->get ( $subdomain_name );
		
		if ($app_info === NULL) {
			redirect ( 'error' );
		}
	}
	
	function index() {
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr [0];
		
		$this->benchmark->mark ( 'app_query_start' );
		$app_info = $this->App_model->get ( $subdomain_name );
		$this->benchmark->mark ( 'app_query_end' );
		
		$data['name'] = $app_info['name'];
		$data['phone'] = $app_info['phone'];
		$this->load->view('app_view', $data);
	}
	
	function do_add() {
		$data = $this->input->post();
		$data = array(
				'app_id' => $param['app_id'],
				'name' => $param['name'],
				'token' => $param['token'],
				'phone' => $param['phone'],
				'status' => $param['status'],
		);
		$this->db->insert('app', $data);
	}
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */