<?php

	/**
	 * Transform the whole column text Uppercase
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the Uppercase column
	 */	
	function upperCaseColumn($fileCSV, $options) {

		//check if the option exists - if not, returns the initial file
		if( !optionExists('upperCaseColumn', $options) )
			return $fileCSV;

		//get the choosed column
		$column = array_column($fileCSV, $options['upperCaseColumn']);

		array_walk($column, function(&$value) {
			$value = strtoupper($value);
		});

		//put the column back into the initial array
		$fileCSV = putColumnBack($fileCSV, $column, $options['upperCaseColumn']);

		return $fileCSV;
	}

	/**
	 * Transform the whole column text Lowercase
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the Lowercase column
	 */	
	function lowerCaseColumn($fileCSV, $options) {
		//check if the option exists - if not, returns the initial file
		if( !optionExists('lowerCaseColumn', $options) )
			return $fileCSV;

		//get the choosed column
		$column = array_column($fileCSV, $options['lowerCaseColumn']);

		array_walk($column, function(&$value) {
			$value = strtolower($value);
		});

		//put the column back into the initial array
		$fileCSV = putColumnBack($fileCSV, $column, $options['lowerCaseColumn']);

		return $fileCSV;
	}


	/**
	 * Transform the whole column text Title Case
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the Title Case column
	 */	
	function titleCaseColumn($fileCSV, $options) {
		//check if the option exists - if not, returns the initial file
		if( !optionExists('titleCaseColumn', $options) )
			return $fileCSV;

		//get the choosed column
		$column = array_column($fileCSV, $options['titleCaseColumn']);

		array_walk($column, function(&$value) {
			$value = ucfirst($value);
		});

		//put the column back into the initial array
		$fileCSV = putColumnBack($fileCSV, $column, $options['titleCaseColumn']);

		return $fileCSV;
	}

	/**
	 * Powerup the whole column numerical values
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the powerup column
	 */	
	function powerColumn($fileCSV, $options) {
		//check if the option exists - if not, returns the initial file
		if( !optionExists('powerColumn', $options) )
			return $fileCSV;

		$powerOptions = explode(", ", $options['powerColumn']);

		//get the choosed column
		$column = array_column($fileCSV, $powerOptions[0]);

		//get the power
		$power = $powerOptions[1];

		array_walk($column, function(&$value) use ($power) {
			$value = pow($value, $power);
		});

		//put the column back into the initial array
		$fileCSV = putColumnBack($fileCSV, $column, $powerOptions[0]);
		
		return $fileCSV;
	}	