<?php

	//include a File using the Absolute Path
	function includeFile($param) {
		$path = PROJECT_PATH.'/'.$param.'.php';
		include $path;
	}

	//include a File Once using the Absolute Path
	function includeFileOnce($param) {
		$path = PROJECT_PATH.'/'.$param.'.php';
		include_once $path;
	}	

?>