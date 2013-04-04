<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {
	
	var $sub_domain;
	
	public function __construct() {
		parent::__construct ();
		$this->load->model('App_model');
		$this->load->model('Doc_model');
		$this->load->model('View_model');
	}
	
	public function index($uuid) {
		$app_info = $this->rc->getAppInfo();
		echo json_encode($app_info);
		return;
		
		
		$rid = $this->rc->genRid('idv', 'xls', '1234');
		$word_html = $this->View_model->convertWord2Html($rid);
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr [0];
		
		$app_info = $this->App_model->get ( $subdomain_name );
		
		$data['name'] = $app_info->name;
		$data['phone'] = $app_info->phone;
		$this->load->view('view/word_view', $data);
	}
	
	public function json($uuid) {
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 );
		$subdomain_name = $subdomain_arr[0];
		
		$app_info = $this->App_model->get($subdomain_name);
		
		$data['name'] = $app_info->name;
		$data['phone'] = $app_info->phone;
		$this->load->view('view/word_view', $data);
	}
}

/* End of file view.php */
/* Location: ./application/controllers/view.php */