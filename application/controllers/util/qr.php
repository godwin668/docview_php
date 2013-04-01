<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qr extends CI_Controller {
	
	public function index() {
		
		$this->output->enable_profiler(FALSE);
		
		$this->load->library('ciqrcode');

		$params['data'] = 'http://www.idocv.com';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'images/idocv.png';
		$this->ciqrcode->generate($params);
		
		echo '<center><img src="'.base_url().'images/idocv.png" /><hr /><a href="http://www.idocv.com">www.idocv.com</a></center>';
		
	}
}

/* End of file qr.php */
/* Location: ./application/controllers/qr.php */