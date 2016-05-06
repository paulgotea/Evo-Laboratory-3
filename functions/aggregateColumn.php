<?php

    /**
     * Aggregate the columns make the sum
     * 
     * @param array $fileCSV - all data from CSV
     * @param array $options - all options inserted
     */
	function aggregateSum($fileCSV, $options) {

		//check if the choosed option exists. if not, display the initial data file
		if( !optionExists('aggregate-sum', $options) )
			return $fileCSV;

		//get the column choosed
		$column = array_column($fileCSV, $options['aggregate-sum']);

		$sum = 0;

		$sum = array_reduce($column, function($sum, $column) {
			$sum += $column;
			return $sum;	
		});

		//print the output
		write('Aggregated sum is: '.$sum);
		exit;
	}

    /**
     * Aggregate the columns make the product
     * 
     * @param array $fileCSV - all data from CSV
     * @param array $options - all options inserted
     */
	function aggregateProduct($fileCSV, $options) {

		//check if the choosed option exists. if not, display the initial data file
		if( !optionExists('aggregate-product', $options) )
			return $fileCSV;

		//get the column choosed
		$column = array_column($fileCSV, $options['aggregate-product']);

		$productCalc = 1;

		$product = array_reduce($column, function($productCalc, $column) {
			$productCalc *= $column;
			return $productCalc;	
		});

		//print the output
		write('Aggregated product is: '.$product);
		exit;
	}


    /**
     * Aggregate the columns make the list using glue
     * 
     * @param array $fileCSV - all data from CSV
     * @param array $options - all options inserted
     */
	function aggregateList($fileCSV, $options) {

		//check if the choosed option exists. if not, display the initial data file
		if( !optionExists('aggregate-list', $options) || !optionExists('aggregate-list-glue', $options) )
			return $fileCSV;

		//get the column choosed
		$column = array_column($fileCSV, $options['aggregate-list']);
		//get the glue choosed
		$glue = $options['aggregate-list-glue'];

		$string = '';

		$list = array_reduce($column, function($string, $column) use ($glue) {
			$string .= $column . $glue;
			return $string;	
		});

		//remove last glue
		$list = rtrim($list, $glue);

		//print the output
		write('Aggregated list is: '.$list);
		exit;
	}

