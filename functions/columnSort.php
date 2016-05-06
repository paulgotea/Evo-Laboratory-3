<?php

	function columnSort($fileCSV, $options) {

		if( !optionExists('columnSort', $options) )
			return $fileCSV;

		foreach ($fileCSV as $key => $value) {
			$data[] = $value;
		}

		foreach ($data as $key => $value) {
			ksort($data[$key]);
		}

		return $data;

	}