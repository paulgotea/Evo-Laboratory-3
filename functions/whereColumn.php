<?php

	/**
	 * Get data WHERE a choosed condition is satisfied
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $options - all options choosed by the user
	 * @return array - returns the initial array with the choosed data on it
	 */	
	function whereColumn($fileCSV, $options) {
		//check if the option exists - if not, returns the initial file
		if( !optionExists('where', $options) )
			return $fileCSV;

		//get table header
		$headerTitle = array_keys($fileCSV[0]);

		//create an array using Where choosed statement 
		$whereKeys = array('column', 'condition', 'value');
		$whereStatement = explode(' ', $options['where']);
		$whereStatement = array_combine($whereKeys, $whereStatement);

		//get only data that satisfies the choosed condition
		$data = checkWhereStatement($fileCSV, $whereStatement);

		//fetch the new data array that satisfies the condition
		foreach ($fileCSV as $key => $value) {
			if( !array_key_exists($key, $data[0]) ) 
				continue;
			
			$newData[] = array_combine($headerTitle, $value);
		}

		return $newData;
	}

	function checkWhereStatement($fileCSV, $whereStatement) {
		$column = array_column($fileCSV, $whereStatement['column']);

		$param = $whereStatement['value'];

		$filter = array_filter($column, function($value) use ($whereStatement) {

			switch ($whereStatement['condition']) {
				case '=':
					if( $value == $whereStatement['value'] )
						return true;
					break;
				
				case '<>':
					if( $value != $whereStatement['value'] )
						return true;
					break;

				case '>':
					if( $value > $whereStatement['value'] )
						return true;
					break;

				case '<':
					if( $value < $whereStatement['value'] )
						return true;								
					break;

				default:
					return false;
					break;
			}

		});

		if( $filter ) {
			$data[] = $filter;
		}

		//if data is empty there is no result that satifies the choosed WHERE condition
		if( empty($data) ) { 
			write('Error! We could not filter the results based on given filter query!');
			exit;
		}

		return $data;
	}
