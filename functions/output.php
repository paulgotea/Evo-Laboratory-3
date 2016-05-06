<?php

	/**
	 * Write a text with new line
	 * 
	 * @param string $string - message you want to print
	 */	
	function write($string) {
		echo $string.PHP_EOL;
	}

	/**
	 * Display the output on screen or CSV file
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 */	
	function output($fileCSV, $options) {
		//output CSV file
		switch($options['output']) {
			case 'screen':
				outputScreen($fileCSV);
				break;
			default:
				outputFile($fileCSV, $options['output']);
				break;
		}
	}

	/**
	 * Ouput a table with data file using custom Table.php Class
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 */	
	function outputScreen($fileCSV) {
		//import the custom class for Table Display
		include 'templates/Table.php';
		$table = new Console_Table();

		//get table header
		$headerTitle = array_keys($fileCSV[0]);
		foreach ($headerTitle as $key => $value) {
			$headerTitle[$key] = strtoupper($headerTitle[$key]);
		}

		//set table header
		$table->setHeaders($headerTitle);

		//insert rows on table
		foreach ($fileCSV as $key => $fetch) {
			$table->addRow($fetch);
		}

		echo $table->getTable();
	}

	/**
	 * Ouput a CSV file with data
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param string $fileName - name of CSV file where you want to save the data
	 */	
	function outputFile($fileCSV, $fileName) {
		$file = fopen($fileName,"w");

		foreach ($fileCSV as $value) {
				fputcsv($file, $value);	
		}
	}

