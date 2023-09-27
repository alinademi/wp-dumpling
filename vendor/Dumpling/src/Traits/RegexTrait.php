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

		$patterns = [ 
			'/=&gt;\s+/'                       => "<span class='dp-opr'>=&gt;</span>",
			'/\[(.*?)\]/'                      => "<span class='dp-bkt'>[</span><span class='dp-key'>$1</span><span class='dp-bkt'>]</span>",
			'/\((.*?)\)/'                      => "<span class='dp-prn'>(</span>$1<span class='dp-prn'>)</span>",
			'/\{/'                             => "<span class='dp-brc'>{</span>",
			'/\}/'                             => "<span class='dp-brc'>}</span>",
			'/\bstring\b/i'                    => "<span class='dp-str'>string</span>",
			'/\bint(eger)?\b/i'                => "<span class='dp-int'>int</span>",
			'/\bfloat\b|\bdouble\b|\breal\b/i' => "<span class='dp-flt'>float</span>",
			'/\barray\b/i'                     => "<span class='dp-arr'>array</span>",
			'/\bbool(ean)?\b/i'                => "<span class='dp-bool'>bool</span>",
			'/\bNULL\b/i'                      => "<span class='dp-null'>NULL</span>",
			'/\bobject\b/i'                    => "<span class='dp-obj'>object</span>",
		];

		foreach ( $patterns as $pattern => $replacement ) {
			$dump = preg_replace( $pattern, $replacement, $dump );
		}

		$dump = preg_replace_callback( '/"([\s\S]*?)"/', function ($matches) {
			return '"' . str_replace( "\n", '', $matches[1] ) . '"';
		}, $dump );

		$lines                    = explode( "\n", $dump );
		$formattedLines           = [];
		$indentationLevel         = 0;
		$widthPerIndentationLevel = 4;

		foreach ( $lines as $line ) {
			$isCloseBrace = strpos( $line, "}" ) !== false;
			$isOpenBrace  = strpos( $line, "{" ) !== false;

			$indentationWidth = $indentationLevel * $widthPerIndentationLevel; // Calculate width
			$indentationGuide = "<span class='indent-guide' style='width:{$indentationWidth}px'></span>";
			$formattedLine    = $indentationGuide . str_repeat( ' ', $indentationLevel ) . $line;

			$line = trim( $line );

			if ( $isCloseBrace )
				$indentationLevel = max( 0, $indentationLevel - 1 );

			$formattedLine    = str_repeat( ' ', $indentationLevel ) . $line;
			$formattedLines[] = $formattedLine;

			if ( $isOpenBrace )
				$indentationLevel++;
		}

		return implode( "\n", $formattedLines );
	}
}