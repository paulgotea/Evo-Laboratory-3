<?php

	/**
	 * Get only unique values on the choosed column
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the unique data on choosed column
	 */	
	function uniqueColumn($fileCSV, $options) {
		//check if the option exists - if not, returns the initial file
		if( !optionExists('unique', $options) )
			return $fileCSV;

		//get header title
		$headerTitle = array_keys($fileCSV[0]);

		//get choosed unique column
		$uniqueColumn = array_column($fileCSV, $options['unique']);
		$uniqueColumn = array_unique($uniqueColumn);

		//fetch new array using unique data on column
		foreach ($fileCSV as $key => $value) {
			if( !array_key_exists($key, $uniqueColumn) ) 
				continue;
			
			$newData[] = array_combine($headerTitle, $value);
		}

		return $newData;
	}	