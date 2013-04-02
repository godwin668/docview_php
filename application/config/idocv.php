<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array();

// Path & URL
define('IDOCV_DATA_URL', 'http://data.idocv.com/');
define('IDOCV_DATA_DIR', 'D:' . DIRECTORY_SEPARATOR . 'idocv' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);


// Office Converters
define('IDOCV_OFFICE_CMD_WORD2HTML', 'D:' . DIRECTORY_SEPARATOR . 'idocv' . DIRECTORY_SEPARATOR . 'converter' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'word2html.exe');
define('IDOCV_OFFICE_CMD_EXCEL2HTML', 'D:' . DIRECTORY_SEPARATOR . 'idocv' . DIRECTORY_SEPARATOR . 'converter' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'excel2html.exe');
define('IDOCV_OFFICE_CMD_PPT2HTML', 'D:' . DIRECTORY_SEPARATOR . 'idocv' . DIRECTORY_SEPARATOR . 'converter' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'ppt2jpg.exe');
