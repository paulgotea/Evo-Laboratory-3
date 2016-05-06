<?php

	//constant for the absolute path of the project
	define('PROJECT_PATH', __DIR__);


	//includes
	include 'utils/includeFiles.php';
	includeFile('functions/read');
	includeFile('functions/output');
	includeFile('functions/coreFunctions');
	includeFile('utils/main');

	//read the inserted options from terminal
	$options = getOptions();

	//start the application flow using choosed options
	startApplication($options);
