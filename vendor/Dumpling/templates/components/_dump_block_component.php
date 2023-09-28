<div x-data="dumpContainerData()" x-init="init">
  <details id="dumper-container" class="dump-block" tabindex="0">
    <summary class="dump-block__summary">{{var_name}}</summary>
    <div class="dump-block__inner-wrapper dump-block__content">
      <div class="dump-block__ctrl-outer">
        <p>Positions: </p>
        <div class="dump-block__ctrl-wrapper">
          <!-- Start Position Buttons -->
          <?php include __DIR__ . '/_buttons_component.php'; ?>
          <!-- End Position Buttons -->
          <!-- Start Theme Selector -->
          <?php include __DIR__ . '/_theme_selector_component.php'; ?>
          <!-- End Theme Selector -->
        </div>
        <!-- Start Close Modal -->
        <?php include __DIR__ . '/_modal_close_button_component.php'; ?>
        <!-- End Close Modal -->
      </div>
      <!-- Start Dump Output -->
      <?php include __DIR__ . '/_dump_output_component.php'; ?>
      <!-- End Dump Output -->
    </div>
  </details>
</div>