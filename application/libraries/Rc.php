<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Rc {

	var $SPLIT = '_';
	
	public function __construct() {
		$CI =& get_instance();
	}
	
	/**
	 * Get application info
	 * 
	 * @return unknown
	 */
	function getAppInfo() {
		$CI =& get_instance();
		$subdomain_arr = explode ( '.', $_SERVER ['HTTP_HOST'], 2 ); // creates the various parts
		$subdomain_name = $subdomain_arr [0]; // assigns the first part
		
		$CI->load->model ( 'App_model' );
		$app_info = $CI->App_model->get ( $subdomain_name );
		if ($subdomain_name !== 'api' && ! $app_info) {
			show_error('Application(' . $subdomain_name . ') NOT found.', 404, 'Application NOT found');
		}
		return $app_info;
	}
	
	function getMilliSecond() {
		$arr = explode(' ', microtime());
		return $arr[1] . substr($arr[0], 2, 3);
	}
	
	function genSid($uid) {
		$milli_second = $this->getMilliSecond();
		$sid_ori = $uid . '.' . $milli_second . '.' . md5($milli_second);
		return rtrim(base64_encode($sid_ori), '=');
	}
	
	function getUid($sid) {
		return explode('.', base64_decode($sid), 2)[0];
	}
	
    /**
     * Generate rid, e.g. (appId)_(yyyyMMdd)_(HHmmss)_(size)(random)_ext
     *
     * @param uid
     * @param fileName
     * @param size
     * @return
     */
	function genRid($appId, $ext, $size) {
    	$dateString = date('Ymd');
    	$timeString = date('His');
    	$randomString = random_string('alpha', 3);
    	return $appId . $this->SPLIT . $dateString . $this->SPLIT . $timeString . $this->SPLIT . $size . $randomString . $this->SPLIT . $ext;
	}
	
	function validateRid($rid) {
		if (strlen($rid) > 20) {
			return TRUE;
		} else {
			show_error('Invalid rid <' . $rid . '>.', 500, 'Rid ERROR!');
		}
	}
	
	/**
	 * Get raw file name
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getRawName($rid) {
		$this->validateRid($rid);
		$ori_name_string = explode($this->SPLIT, $rid, 3)[2];
		return substr($ori_name_string, 0, strrpos($ori_name_string, $this->SPLIT, -1));
	}
	
	/**
	 * Get file extension.
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getExt($rid) {
		$this->validateRid($rid);
		$last_pos = strrpos($rid, $this->SPLIT, -1);
		return substr($rid, $last_pos + 1, strlen($rid));
	}
	
	/**
	 * Get file name by rid.
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getFileName($rid) {
		$this->validateRid($rid);
		return $this->getRawName($rid) . '.' . $this->getExt($rid);
	}
	
	/**
	 * get file directory without root
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getFileDir($rid) {
		$this->validateRid($rid);
		echo "RID: " . $rid;
		$rid_splits = explode($this->SPLIT, $rid, 3);
		$ymd = $rid_splits[1];
		$y = substr($ymd, 0, 4);
		$md = substr($ymd, 4, 4);
		return  $rid_splits[0] . DIRECTORY_SEPARATOR . $y . DIRECTORY_SEPARATOR . $md . DIRECTORY_SEPARATOR;
	}
	
	/**
	 * Get absolute file directory
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getAbsFileDir($rid) {
		$this->validateRid($rid);
		$dir = IDOCV_DATA_DIR . $this->getFileDir($rid);
		if (!is_dir($dir)) {
			mkdir($dir, 0, true);
		}
		return $dir;
	}
	
	/**
	 * Get absolute file path by rid. e.g. D:\idocv\data\idv\2013\0403\230517_1234mGW.xls
	 *
	 * @param unknown $rid
	 * @return string
	 */
	function getAbsPath($rid) {
		$this->validateRid($rid);
		return $this->getAbsFileDir($rid) . $this->getFileName($rid);
	}
	
	/**
	 * Get relative parse directory
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getParseDir($rid) {
		$this->validateRid($rid);
		return $this->getFileDir($rid) . $this->getRawName($rid) . DIRECTORY_SEPARATOR;
	}
	
	/**
	 * Get absolute parse path of HTML
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getAbsParsePathOfHtml($rid) {
		$this->validateRid($rid);
		$dir = IDOCV_DATA_DIR . $this->getParseDir($rid);
		if (!is_dir($dir)) {
			mkdir($dir, 0, true);
		}
		return $dir . 'index.html';
	}
	
	/**
	 * Get URL parse directory
	 * 
	 * @param unknown $rid
	 * @return string
	 */
	function getUrlParseDir($rid) {
		$this->validateRid($rid);
		return str_replace('\\', '/', IDOCV_DATA_URL . $this->getParseDir($rid));
	}
}

/* End of file Rc.php */