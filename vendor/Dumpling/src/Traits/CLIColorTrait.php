<?php

namespace Dumpling\Traits;

trait CLIColorTrait {
	protected function colorize( $text, $color = 'default' ) {
		$colors = [ 
			'default' => "\033[0m",
			'red'     => "\033[0;31m",
			'green'   => "\033[0;32m",
			'yellow'  => "\033[0;33m",
			'blue'    => "\033[0;34m",
			'magenta' => "\033[0;35m",
			'cyan'    => "\033[0;36m",
			'white'   => "\033[0;37m",
		];

		return $colors[ $color ] . $text . $colors['default'];
	}
}