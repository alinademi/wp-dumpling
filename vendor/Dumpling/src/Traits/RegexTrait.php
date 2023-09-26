<?php
namespace Dumpling\Traits;

trait RegexTrait {
	public function processDump( $dump ) {
		$dump = htmlspecialchars( $dump, ENT_SUBSTITUTE );
		$dump = preg_replace( '/=&gt;\s+/', "<span class='operator'>=&gt;</span> ", $dump );
		$dump = preg_replace( '/\[(.*?)\]/', "<span class='bracket'>[</span><span class='key'>$1</span><span class='bracket'>]</span>", $dump );
		$dump = preg_replace( '/\((.*?)\)/', "<span class='parenthesis'>(</span>$1<span class='parenthesis'>)</span>", $dump );
		$dump = preg_replace( '/\{/', "<span class='brace'>{</span>", $dump );
		$dump = preg_replace( '/\}/', "<span class='brace'>}</span>", $dump );

		$dump = preg_replace_callback( '/"([\s\S]*?)"/', function ($matches) {
			return '"' . trim( $matches[1] ) . '"';
		}, $dump );

		// Remove all extra spaces but keep the newline characters
		$dump = preg_replace( '/[ \t]+/', ' ', $dump );

		// Now split by newline character for processing each line
		$lines            = explode( "\n", $dump );
		$formattedLines   = [];
		$indentationLevel = 0;

		foreach ( $lines as $line ) {
			if ( strpos( $line, "}" ) !== false ) {
				$indentationLevel = max( 0, $indentationLevel - 1 );
			}

			$formattedLines[] = str_repeat( ' ', $indentationLevel ) . $line;

			if ( strpos( $line, "{" ) !== false ) {
				$indentationLevel++;
			}
		}

		return implode( "\n", $formattedLines );
	}

}