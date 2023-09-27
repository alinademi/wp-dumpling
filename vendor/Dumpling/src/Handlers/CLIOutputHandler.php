<?php

namespace Dumpling\Handlers;

use Dumpling\Interfaces\OutputInterface;
use Dumpling\Traits\CLIColorTrait;

class CLIOutputHandler implements OutputInterface {
	use CLIColorTrait;

	public function render( $data, $var_name ) {
		$header = $this->generateHeader();
		$dump   = $this->generateDump( $data );
		echo $header . $this->colorize( $var_name . ":\n", 'cyan' ) . $dump . "\n\n";
	}

	private function generateHeader() {
		$date       = date( 'Y-m-d' );
		$time       = date( 'H:i:s' );
		$lineLength = 40;
		$lineChar   = ' ';

		$dumpTitle = "Dumpling...";
		$dateLine  = "$date @ $time";

		$header = $this->generateReps( $lineChar, $lineLength, 'white', 'cyan' ) . "\n";
		$header .= $this->generateLines( $dumpTitle, $lineLength, 'white', 'cyan' );
		$header .= $this->generateLines( $dateLine, $lineLength, 'white', 'cyan' );
		$header .= $this->generateReps( $lineChar, $lineLength, 'white', 'cyan' ) . "\n";

		return $header . "\n";
	}

	private function generateDump( $data, $maxWidth = 80 ) {
		$dump = var_export( $data, true );

		$lines = explode( "\n", $dump );
		foreach ( $lines as &$line ) {
			$line = wordwrap( $line, $maxWidth, "\n", true );
		}
		$dump = implode( "\n", $lines );

		$dump = preg_replace_callback( '/\'(.*?)\'/s', function ($matches) {
			$string = $matches[1];
			$string = preg_replace( '/^\n+|\n+$/', '', $string );
			return '\'' . $string . '\'';
		}, $dump );

		$dump = preg_replace_callback( '/\d+/', function ($matches) {
			return $this->colorize( $matches[0], 'magenta' ); // numbers
		}, $dump );

		$dump = preg_replace_callback( '/([\'"])(.*?)\1/', function ($matches) {
			return $this->colorize( $matches[0], 'white' ); // strings
		}, $dump );


		$dump = preg_replace_callback( '/\=>/', function ($matches) {
			return $this->colorize( $matches[0], 'green' ); // arrows
		}, $dump );

		// parentheses
		$dump = preg_replace_callback( '/(\(|\))/', function ($matches) {
			return $this->colorize( $matches[0], 'red' );
		}, $dump );

		return $dump;
	}

	private function generateReps( $char, $repeat, $textColor = 'default', $bgColor = null ) {
		$filler = str_repeat( $char, $repeat );
		return $this->colorize( $filler, $textColor, $bgColor );
	}

	private function calculatePadding( $text, $totalLength ) {
		return $totalLength - mb_strlen( $text );
	}

	private function generateLines( $text, $totalLength, $textColor = 'default', $bgColor = null ) {
		$paddingLength = $this->calculatePadding( $text, $totalLength );
		$paddedText    = $text . str_repeat( ' ', $paddingLength );
		return $this->colorize( $paddedText . "\n", $textColor, $bgColor );
	}
}