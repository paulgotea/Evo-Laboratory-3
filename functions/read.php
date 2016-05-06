<?php


	/**
	 * Read the CSV file
	 * 
	 * @param string $fileName - file name that you want to read
	 * @return array - returns the data read from CSV file as array
	 */	

	function readDataFile($fileName) {

		//if the choosed file does not exist, displays an error message
		if( !file_exists($fileName) ) {
			write('The choosed file does not exist! Try again!');
			exit;
		}

		//the file exists so we open it and get its content
		$handle = fopen($fileName, 'r');
		//get the first row of file (with headers)
	    $keys = fgetcsv($handle);

	    //read the file until the end
	    while ( !feof($handle) ) {
			$data[] = fgetcsv($handle);
	    }

	    //remove blanks from array
	    $data = array_filter($data);

	    foreach ($data as $fetch) {
	    	$newData[] = array_combine($keys, $fetch);
	    }

		 return $newData;
	}