<?php

namespace Dumpling\Handlers;

use Dumpling\Config;
use Dumpling\Handlers\AssetHandler;
use Dumpling\Services\Logger;
use Dumpling\Traits\RegexTrait;
use Dumpling\Traits\ThemeDataTrait;
use Dumpling\Interfaces\OutputInterface;


class WebOutputHandler implements OutputInterface {
	use ThemeDataTrait;
	use RegexTrait;

	private $templateFile;

	public function __construct() {
		$this->templateFile = Config::get( 'templateFilePath', __DIR__ . '/../../templates/dump_template.php' );
	}

	public function render( $dump, $var_name ) {

		if ( ! $this->isTemplateFileExists() ) {
			Logger::logError( "Template file not found." );
			return;
		}

		$template = $this->getTemplateContent();
		if ( $template === false ) {
			Logger::logError( "Output buffering failed." );
			return;
		}

		ob_start();
		echo AssetHandler::includeCSS();
		echo AssetHandler::includeJS();
		echo AssetHandler::includeThemeData( $this->getThemeData() );
		$this->renderHtml( $template, $dump, $var_name );
		echo ob_get_clean();
	}


	private function isTemplateFileExists(): bool {
		return file_exists( $this->templateFile );
	}

	private function getTemplateContent() {

		if ( ! file_exists( $this->templateFile ) ) {
			Logger::logError( "Template file does not exist." );
			return false;
		}

		if ( ! is_readable( $this->templateFile ) ) {
			Logger::logError( "Template file is not readable." );
			return false;
		}

		ob_start();
		$themesData = $this->getThemeData();
		$themesList = array_keys( $themesData );

		$included = include $this->templateFile;


		if ( $included === false ) {
			ob_end_clean();
			Logger::logError( "Failed to include template file." );
			return false;
		}

		$content = ob_get_clean();

		if ( empty( $content ) ) {
			Logger::logError( "Template is empty or not loaded correctly." );
			return false;
		}

		return $content;
	}


	private function renderHtml( $template, $dump, $var_name ) {
		$processedDump = $this->processDump( $dump );

		$replacements = [ 
			'{{var_name}}' => $var_name,
			'{{dump}}'     => $processedDump,
		];

		$html = str_replace( array_keys( $replacements ), array_values( $replacements ), $template );
		echo $html;
	}
}