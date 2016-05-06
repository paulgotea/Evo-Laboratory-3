<?php

	/**
	 * Sort choosed columns from the array
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with only the choosed columns
	 */	
	function sortByColumns($fileCSV, $options) {

		//if choosed option does not exists, display the initial file
		if( !optionExists('multisort', $options) )
			return $fileCSV;
	
		//check if both --multisort and --multisort dir are choosed	
		checkMultisort($options);

		//get an array with choosed columns
		$sortedColumns = explode(', ', $options['multisort']);

		//get an array with ASC or DESC
		$sortDirection = explode(', ', $options['multisort-dir']);

		$params = array();

		//generate the array for Multisort (column-sortDirection...)
		foreach ($sortedColumns as $key => $value) {
			$column = array_column($fileCSV, $value);
			$params[] = $column;

			//check the sort direction for every column
			if( $sortDirection[$key] == 'asc' ) {
				$params[] = SORT_ASC;
			}
			else if( $sortDirection[$key] == 'desc' ) {
				$params[] = SORT_DESC;
			}
			else{
				$params[] = SORT_ASC;
			}
		}

		//sort using multisort
		$params[] = &$fileCSV;
		call_user_func_array('array_multisort', $params);

		return $fileCSV;
	}