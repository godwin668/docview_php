<?php
function profiler_hook() {
	
	/*
	if ($_SERVER['REMOTE_ADDR'] == '118.244.213.139') {
		$CI =& get_instance();
		$CI->output->enable_profiler(TRUE);
	}
	*/
	
	$CI =& get_instance();
	$CI->output->enable_profiler(TRUE);
	
}