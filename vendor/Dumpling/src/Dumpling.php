<?php

namespace Dumpling;

use Dumpling\Handlers\WebOutputHandler;
use Dumpling\Handlers\CLIOutputHandler;
use Dumpling\Interfaces\OutputInterface;

class Dumpling {
	private $outputHandler;

	public function __construct() {
		if ( php_sapi_name() === 'cli' ) {
			$this->outputHandler = new CLIOutputHandler();
		} else {
			$this->outputHandler = new WebOutputHandler();
		}
	}

	public function dump( $data, $var_name = 'Variable Output' ) {
		$this->outputHandler->render( $data, $var_name );
	}
}