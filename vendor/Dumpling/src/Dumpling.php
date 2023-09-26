<?php

namespace Dumpling;

use Dumpling\Handlers\OutputHandler;

class Dumpling {
	private $outputHandler;

	public function __construct() {
		$this->outputHandler = new OutputHandler();
	}

	public function dump( $data, $var_name = 'Variable Output' ) {

		ob_start();
		var_dump( $data );
		$dump = ob_get_clean();

		$this->outputHandler->printHtml( $dump, $var_name );
	}

}