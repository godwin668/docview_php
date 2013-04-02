<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index() {
		
		$this->load->library('rc');
		$data['rid'] = $this->rc->genRid('idv', 'a.xls', '1234');
		echo "Rid: " . $data['rid'];
		
		echo "test...";
		
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */