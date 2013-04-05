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
	
	/**
	 * Upload document
	 */
	function do_upload() {
		$app_info = $this->rc->getAppInfo();
		
		$this->output->set_content_type('application/json');
		
		$config['upload_path'] = IDOCV_DATA_DIR . 'tmp/';
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|txt|pdf';
		$config['max_size']	= '20000';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors('', ''));
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
			$uuid = random_string('alnum', 6);
			if (0 == strcasecmp('doc', $ext) || 0 == strcasecmp('docx', $ext)) {
				$uuid .= 'w';
			} else if (0 == strcasecmp('xls', $ext) || 0 == strcasecmp('xlsx', $ext)) {
				$uuid .= 'x';
			} else if (0 == strcasecmp('ppt', $ext) || 0 == strcasecmp('pptx', $ext)) {
				$uuid .= 'p';
			} else if (0 == strcasecmp('txt', $ext)) {
				$uuid .= 't';
			} else if (0 == strcasecmp('pdf', $ext)) {
				$uuid .= 'f';
			}
			
			$data = array(
					'doc_id' => $rid,
					'app_id' => $app_info['app_id'],
					'user_id' => $user_id,
					'uuid' => $uuid,
					'name' => $upload_result['file_name'],
					'size' => $file_size,
					'ext' => $ext,
					'mode' => 0,
				);
			
			$this->load->model('Doc_model');
			$this->Doc_model->add($data);
			
			$this->output->set_output(json_encode(array('uuid' => $uuid)));
		}
	}
	
	/**
	 * List documents
	 */
	function do_list() {
		/**********************************************
		/* Input	ref: http://datatables.net/usage/server-side
		/**********************************************
		sEcho:3
		iColumns:6
		iDisplayStart:20
		iDisplayLength:10
		mDataProp_0:name
		mDataProp_1:ctime
		mDataProp_2:size
		mDataProp_3:uuid
		mDataProp_4:viewCount
		mDataProp_5:
		
		iSortCol_0:0
		sSortDir_0:asc
		iSortingCols:1
		
		/**********************************************
		/* OUTPUT
		/**********************************************
		{
		   "iTotalDisplayRecords":186,
		   "iTotalRecords":186,
		   "aaData":[
		      {
		         "rid":"doc_20130405_170939_20088Ukm_docx",
		         "uuid":"UUVBkw",
		         "appId":"doc",
		         "name":"idocv-zh.docx",
		         "size":20088,
		         "status":0,
		         "ctime":1365152979172,
		         "utime":1365153022531,
		         "ext":"docx",
		         "url":null,
		         "viewCount":1,
		         "downloadCount":0,
		         "mode":1
		      }
		   ],
		   "iDisplayStart":0,
		   "iDisplayLength":0
		}
		
		*/
		
		$params = $this->input->get();
		$this->load->model('Doc_model');
		$doc_list = $this->Doc_model->getList($params);
		$doc_count = $this->Doc_model->count($params);
		
		$data['iTotalDisplayRecords'] = $doc_count;
		$data['iTotalRecords'] = $doc_count;
		$data['aaData'] = $doc_list;
		
		echo json_encode($data);
	}
	
	/**
	 * Donwload document
	 * 
	 * @param unknown $uuid
	 */
	function download($uuid) {
		$this->load->model('Doc_model');
		$doc_info = $this->Doc_model->getByUuid($uuid);
		$doc_path = $this->rc->getAbsPath($doc_info['doc_id']);
		if (file_exists($doc_path)) {
			$this->load->helper('download');
			$data = file_get_contents($doc_path);
			$name = $doc_info['name'];
			force_download($name, $data);
		} else {
			show_error('File NOT found!', 404, 'Download error');
		}
	}
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */