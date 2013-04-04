<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc extends CI_Controller {
	
	function __construct() {
		parent::__construct ();
		
		$this->load->model('Doc_model');
		
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 ); // creates the various parts
		$subdomain_name = $subdomain_arr [0]; // assigns the first part
		
		$this->load->model ( 'App_model' );
		$app_info = $this->App_model->get ( $subdomain_name );
		
		if ($app_info === NULL) {
			redirect ( 'error' );
		}
	}
	
	/**
	 * Document list
	 */
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
	
	function json_upload() {
		$app_info = $this->rc->getAppInfo();
		$this->load->model('User_model');
		
		$this->output->set_content_type('application/json');
		
		$config['upload_path'] = IDOCV_DATA_DIR . 'tmp/';
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|txt|pdf';
		$config['max_size']	= '20000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$this->output->set_output(json_encode($error));
		} else {
			// 1. upload
			$upload_result = $this->upload->data();
			
			// 2. generate rid
			$file_size = floor($upload_result['file_size'] * 1024);
			$ext = substr($upload_result['file_ext'], 1);
			$rid = $this->rc->genRid($app_info['app_id'], $ext, $file_size);
			
			// 3. save file
			$src_full_path = $upload_result['full_path'];
			$dest_full_path = $this->rc->getAbsPath($rid);
			rename($src_full_path, $dest_full_path);
			
			// 4. save to database
			$data['file_size'] = $file_size;
			$user_id = '12345678';
			
			$data = array(
					'doc_id' => $rid,
					'app_id' => $app_info['app_id'],
					'user_id' => $user_id,
					'uuid' => random_string('alnum', 6),
					'name' => $upload_result['file_name'],
					'size' => $file_size,
					'ext' => substr($upload_result['file_ext'], 1),
					'mode' => 0,
				);
			
			$this->load->model('Doc_model');
			$app_info = $this->Doc_model->add($data);
			
			$this->output->set_output(json_encode($rid));
		}
	}
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */