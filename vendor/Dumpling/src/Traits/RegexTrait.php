<?php
namespace Dumpling\Traits;

trait RegexTrait {
	public function processDump( $dump ) {
		if ( ! is_string( $dump ) ) {
			ob_start();
			var_dump( $dump );
			$dump = ob_get_clean();
		}

		$dump = htmlspecialchars( $dump, ENT_SUBSTITUTE );

		// Define patterns for different components and colorizing with spans.
		$patterns = [ 
			'/=&gt;\s+/'  => "<span class='operator'>=&gt;</span>",
			'/\[(.*?)\]/' => "<span class='bracket'>[</span><span class='key'>$1</span><span class='bracket'>]</span>",
			'/\((.*?)\)/' => "<span class='parenthesis'>(</span>$1<span class='parenthesis'>)</span>",
			'/\{/'        => "<span class='brace'>{</span>",
			'/\}/'        => "<span class='brace'>}</span>",
		];

		// Apply patterns to dump string.
		foreach ( $patterns as $pattern => $replacement ) {
			$dump = preg_replace( $pattern, $replacement, $dump );
		}

		// Remove newlines within strings
		$dump = preg_replace_callback( '/"([\s\S]*?)"/', function ($matches) {
			return '"' . str_replace( "\n", '', $matches[1] ) . '"';
		}, $dump );

		// Split by newline character for processing each line
		$lines            = explode( "\n", $dump );
		$formattedLines   = [];
		$indentationLevel = 0;

		foreach ( $lines as $line ) {
			$isCloseBrace = strpos( $line, "}" ) !== false;
			$isOpenBrace  = strpos( $line, "{" ) !== false;

			$line = trim( $line ); // Trim the line to remove extra spaces added by var_dump

			// If the line contains a closing brace, decrease the indentation level before processing the line
			if ( $isCloseBrace ) {
				$indentationLevel = max( 0, $indentationLevel - 1 );
			}

			$formattedLine    = str_repeat( ' ', $indentationLevel ) . $line; // One space character for each level of indentation
			$formattedLines[] = $formattedLine;

			// If the line contains an opening brace, increase the indentation level after processing the line
			if ( $isOpenBrace ) {
				$indentationLevel++;
			}
		}

		return implode( "\n", $formattedLines );
	}
}