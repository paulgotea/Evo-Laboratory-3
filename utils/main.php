<?php

	//include all functions used
	includeFile('functions/checks');
	includeFile('functions/sortColumns');
	includeFile('functions/uniqueColumn');
	includeFile('functions/whereColumn');
	includeFile('functions/aggregateColumn');
	includeFile('functions/transformColumnCase');
	includeFile('functions/columnSort');
	includeFile('functions/mapFunction');

	function startApplication($options) {

		//check for required arguments, etc
		checkOptions($options);
		
		//read the file
		$fileCSV = readDataFile($options['from']);

		//get the columns
		$fileColumns = getColumnsName($fileCSV);

		//select only choosed columns
		$fileCSV = selectColumns($fileCSV, $fileColumns, $options['select']);

		//filter with array multisort
		$fileCSV = sortByColumns($fileCSV, $options);

		//where option
		$fileCSV = whereColumn($fileCSV, $options);

		//get unique data on a choosed column
		$fileCSV = uniqueColumn($fileCSV, $options);

		//aggregate sum
		aggregateSum($fileCSV, $options);

		//aggregate product
		aggregateProduct($fileCSV, $options);
		
		//aggregate list with glue
		aggregateList($fileCSV, $options);

		//uppercase column
		$fileCSV = upperCaseColumn($fileCSV, $options);

		//lower column
		$fileCSV = lowerCaseColumn($fileCSV, $options);

		//titlecase column
		$fileCSV = titleCaseColumn($fileCSV, $options);		

		//titlecase column
		$fileCSV = titleCaseColumn($fileCSV, $options);

		//titlecase column
		$fileCSV = powerColumn($fileCSV, $options);			
	
		//sort column
		$fileCSV = columnSort($fileCSV, $options);

		//map function on column
		$fileCSV = mapFunction($fileCSV, $options);						

		//output the result
		output($fileCSV, $options);

	}


