<?php

namespace Dumpling\Traits;

trait CLIColorTrait {

	protected $useXterm;

	public function __construct() {
		$this->useXterm = getenv( 'USE_XTERM' ) ?: false;
	}

	protected function colorize( $text, $color = 'default', $background = null ) {
		$colors = [ 
			'default'    => "\033[0m",
			'red'        => "\033[91m",
			'green'      => "\033[92m",
			'yellow'     => "\033[93m",
			'blue'       => "\033[94m",
			'magenta'    => "\033[95m",
			'cyan'       => "\033[96m",
			'white'      => "\033[97m",
			'black'      => "\033[0;30m",
			'light_gray' => "\033[0;37m",
		];

		$backgrounds = [ 
			'cyan' => "\033[46m",
		];

		$colorCode      = $colors[ $color ] ?? $colors['default'];
		$backgroundCode = $backgrounds[ $background ] ?? '';

		return $backgroundCode . $colorCode . $text . $colors['default'];
	}
}