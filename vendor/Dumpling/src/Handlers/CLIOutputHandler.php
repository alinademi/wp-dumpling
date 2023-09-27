<?php

namespace Dumpling\Handlers;

use Dumpling\Interfaces\OutputInterface;
use Dumpling\Traits\CLIColorTrait; // If you decide to create a trait for CLI Color handling.

class CLIOutputHandler implements OutputInterface {
	use CLIColorTrait;

	public function render( $data, $var_name ) {
		// Logic to output data in CLI.
		// You may want to format data differently for CLI and possibly colorize the output.
		echo $this->colorize( $var_name . ":\n" );
		echo $this->colorize( var_export( $data, true ) );
	}
}