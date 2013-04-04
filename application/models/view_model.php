<?php

class View_model extends CI_Model {
	
	function convertWord2Html($rid) {
		$ori_path = $this->rc->getAbsPath($rid);
		if (! file_exists($ori_path)) {
			show_error('Original file NOT found!', 404, 'File NOT found');
		}
	}
	
}

/* End of file view_model.php */
/* Location: ./application/models/view_model.php */