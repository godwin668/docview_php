<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index() {
		
		$this->load->library('ciqrcode');

		$params['data'] = 'http://www.idocv.com';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'images/idocv.png';
		$this->ciqrcode->generate($params);
		
		echo '<img src="'.base_url().'images/idocv.png" />';
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */