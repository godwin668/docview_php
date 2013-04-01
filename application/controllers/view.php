<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
	
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 ); // creates the various parts
		$subdomain_name = $subdomain_arr [0]; // assigns the first part
	
		$this->load->model ( 'App_model' );
		$app_info = $this->App_model->get ( $subdomain_name );
	
		if ($app_info === NULL) {
			redirect ( 'error' );
		}
		
		echo "Sub-domain: " . $subdomain_name;
	}
	
	public function index($uuid) {
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr [0];
		
		$app_info = $this->App_model->get ( $subdomain_name );
		
		$data['name'] = $app_info->name;
		$data['phone'] = $app_info->phone;
		$this->load->view('view/word_view', $data);
	}
	
	public function json($uuid) {
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr [0];
		
		$app_info = $this->App_model->get ( $subdomain_name );
		
		$data['name'] = $app_info->name;
		$data['phone'] = $app_info->phone;
		$this->load->view('view/word_view', $data);
	}
}

/* End of file view.php */
/* Location: ./application/controllers/view.php */