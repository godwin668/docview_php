<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index() {
		
		echo IDOCV_DATA_DIR . '<br />';
		echo IDOCV_DATA_URL . '<br />';
		echo IDOCV_OFFICE_CMD_WORD2HTML . '<br />';
		echo IDOCV_OFFICE_CMD_EXCEL2HTML . '<br />';
		echo IDOCV_OFFICE_CMD_PPT2HTML . '<br />';
		
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */