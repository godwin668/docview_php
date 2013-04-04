<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index() {
		
		$uid = '123456';
		
		$sid = $this->rc->genSid($uid);
		
		$decoded_uid = $this->rc->getUid($sid);
		
		echo $sid . '<br />';
		echo $decoded_uid . '<br />';
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */