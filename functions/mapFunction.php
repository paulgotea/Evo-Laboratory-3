<?php

	/**
	 * Map a function to a choosed column
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the mapped column inserted on it
	 */	
	function mapFunction($fileCSV, $options) {
		if( !optionExists('map-function', $options) )
			return $fileCSV;

		//check if both --map-function and --map-column options are inserted
		checkMapFunction($options);

		//check if file exists
		if (!file_exists('functions/mapCustomFunction.php')) {
			write('Error! Map file does not exist');
			exit;
		}

		//import the map function file
		require_once 'mapCustomFunction.php';


		//check if the function exists on the imported file
		if (!function_exists($options['map-function'])) {
			write('Error! Map function does not exist');
			exit;
		}

		//select the column
		$column = array_column($fileCSV, $options['map-column']);

		//map the function to the column
		$column = array_map($options['map-function'], $column);

		//modify the column into the initial array
		$fileCSV = putColumnBack($fileCSV, $column, $options['map-column']);

		return $fileCSV;
	}