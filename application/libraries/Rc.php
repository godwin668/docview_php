<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Rc {

	static $SPLIT = '_';
	
	public function __construct() {
		$CI =& get_instance();
	}
	
	/**
	 * Generate random string
	 * 
	 * @param unknown $length
	 * @return string
	 */
	static function randomString($length) {
		$output = '';
		for ($a = 0; $a < $length; $a++) {
			$output .= chr(mt_rand(97, 122));
		}
		return $output;
	}
	
    /**
     * Generate rid, e.g. (appId)_(yyyyMMdd)_(HHmmss)_(size)(random)_ext
     *
     * @param uid
     * @param fileName
     * @param size
     * @return
     */
	function genRid($appId, $fileName, $size) {
    	$dateString = date('Ymd');
    	$timeString = date('His');
    	$ext = pathinfo($fileName)['extension'];
    	$randomString = Rc::randomString(3);
    	return $appId . Rc::$SPLIT . $dateString . Rc::$SPLIT . $timeString . Rc::$SPLIT . $size . $randomString . Rc::$SPLIT . $ext;
	}
}

/* End of file Rc.php */