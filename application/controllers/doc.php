<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc extends CI_Controller {
	
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
	
	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|txt|pdf';
		$config['max_size']	= '5000';
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
	
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
	
			$this->load->view('upload_success', $data);
		}
	}
	
	function index() {
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr [0];
		
		$this->benchmark->mark ( 'app_query_start' );
		$app_info = $this->App_model->get ( $subdomain_name );
		$this->benchmark->mark ( 'app_query_end' );
		
		$data ['name'] = $app_info->name;
		$data ['phone'] = $app_info->phone;
		$this->load->view ( 'app_view', $data );
	}
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */