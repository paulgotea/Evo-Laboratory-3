<?php
	
    /**
     * Check all options like help, required, multisort, powercolumn
     * 
     * @param array $options - all options inserted
     */		
	function checkOptions($options) {
		checkHelpSelected($options);
		checkRequiredOptions($options);

		if( array_key_exists('multisort', $options) ) {
			checkMultisort($options);
		}

		if( array_key_exists('powerColumn', $options) ) {
			checkPowerColumn($options);
		}		
		
	}

    /**
     * Check if --help option was choosed and displays only the help text and finish the process
     * 
     * @param array $options - all options inserted
     */	
	function checkHelpSelected($options) {
		if( array_key_exists('help', $options) ) {
			include 'templates/helpManager.txt';
			exit;
		}	
	}

    /**
     * Check if all required options are choosed by the user. If not, displays a message and exit the aplpication
     * 
     * @param array $options - all options inserted
     */	
	function checkRequiredOptions($options) {
		$requiredOptions = array(
			'select' => '',
			'from' => '',
			'output' => '',
		);

		//check if the required number of arguments match with the inserted required options
		if( count($requiredOptions) != count(array_intersect_key($requiredOptions, $options)) ) {
			write('Error! Some required arguments are missing!');
			exit;
		}
	}

	function checkMultisort($options) {
		if( !array_key_exists('multisort', $options) || !array_key_exists('multisort-dir', $options) ) {
			write('Error! You need to use --multisort-dir too if you use --multisort !');
			exit;
		}		
		if( count( explode(', ', $options['multisort']) ) != count( explode(', ', $options['multisort-dir']) ) ) {
			write('Error! The number of sorted direction arguments must be the same with the number of selected columns for sort');
			exit;
		}
	}

    /**
     * Check if --powerColumn has no more or less than 2 options (column, power) - displays a message if not and exit the application
     *
     * @param array $options - all options inserted
     */	
	function checkPowerColumn($options) {
		if( count( explode(', ', $options['powerColumn']) ) != 2 ) {
			write('Error! You need 2 arguments in order to power up a column!');
			exit;
		}
	}

    /**
     * Check if both --map option were choosed together, displays a message if not and exit the application
     *
     * @param array $options - all options inserted
     */	
	function checkMapFunction($options) {

		if( !array_key_exists('map-function', $options) || !array_key_exists('map-column', $options) ) {
			write('Error! You need to use --map-column too if you use --map-function !');
			exit;
		}
	}

    /**
     * Check if --help option was choosed and displays only the help text and finish the process
     * 
     * @param string $value - option inserted by the user
     * @param array $options - all options inserted
     * @return bool - true if exists / false if not
     */	
	function optionExists($value, $options) {
		if( array_key_exists($value, $options) )
			return true;
		else
			return false;
	}
