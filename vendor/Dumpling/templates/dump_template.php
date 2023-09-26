<?php use Dumpling\Config;

// $baseUrl = Config::get( 'assetBaseUrl' );

// // Sanitize URL
// $cssUrl = filter_var( $baseUrl . 'css/styles.min.css', FILTER_SANITIZE_URL );
// $jsUrl  = filter_var( $baseUrl . 'js/index.min.js', FILTER_SANITIZE_URL );
?>


<details id="dumper-container" class="dump-block" tabindex="0">
  <summary class="dump-block__summary">

    {{var_name}}

  </summary>
  <div class="dump-block__inner-wrapper dump-block__content">
    <div class="dump-block__ctrl-outer">
      <p>Positions: </p>
      <div class="dump-block__ctrl-wrapper">

        <?php include __DIR__ . '/_position_buttons.php'; ?>
        <?php include __DIR__ . '/_themes_select.php'; ?>

      </div>
      <button class="dump-block__control-button dump-block__control-button--close">
        <svg viewBox="0 0 16 16">
          <path d="M1 1 L15 15 M15 1 L1 15" stroke="white" stroke-width="3" />
        </svg>
      </button>
    </div>
    <pre class="dump-block__syntax">
			<code class="dump-block__code">

			{{dump}}

			</code>
		</pre>
  </div>
</details>