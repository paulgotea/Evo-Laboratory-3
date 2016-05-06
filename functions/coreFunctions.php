<?php
	
    /**
     * Get all the options used in terminal using getopt
     * 
     * @return array $options - all the inserted options will be stored here
     */	
	function getOptions() {
		$longopts  = array(
		    "help::",
		    "from:",
		    "select:",
		    "multisort:",
		    "multisort-dir:",
		    "unique:",
		    "where:",
		    "aggregate-sum:",
		    "aggregate-product:",
		    "aggregate-list:",
		    "aggregate-list-glue:",
		    "upperCaseColumn:",	
		    "lowerCaseColumn:",
		    "titleCaseColumn:",
		    "powerColumn:",
		    "columnSort::",
		    "output:",
		    "map-function:",
		    "map-column:",
		);

		return $options = getopt("", $longopts);	
	}

	/**
	 * Get all the columns name
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @return array - all the columns names
	 */	
	function getColumnsName($fileCSV) {
		return array_keys($fileCSV[0]);
	}

	/**
	 * Select only choosed columns from the whole data file
	 * 
	 * @param array $fileCSV - all data imported from the CSV file
	 * @param array $columns - all columns choosed by the user
	 * @return array $fileCSV - returns the initial file, with only choosed columns selected
	 */	
	function selectColumns($fileCSV, $fileColumns, $columns) {

		//displays all columns if * inserted
		if( $columns == "*" )
			return $fileCSV;

		$columns = explode(', ', $columns);

		if( count(array_intersect($fileColumns, $columns)) == 0 )  {
			write('Error! One ore more columns choosed by you does not exit!');
			exit;
		}

		foreach ($fileCSV as $key => $fetch) {
			foreach ($fetch as $column => $value) {
				if( !in_array($column, $columns) )
					unset( $fileCSV[$key][$column] );
			}
			
		}

		return $fileCSV;
	}

	/**
	 * Put a column back into intial data array
	 * 
	 * @param array $array - data file where you want to put back the column
	 * @param array $column - all the rows inside the column
	 * @param string $columnName - column name
	 * @return array - returns the array with choosed column inserted into it
	 */	
	function putColumnBack($array, $column, $columnName) {

		foreach ($array as $key => $value) {
			$array[$key][$columnName] = $column[$key];
		}

		return $array;
	}