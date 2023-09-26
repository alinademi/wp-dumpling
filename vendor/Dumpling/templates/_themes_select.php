<!-- Dropdown for Theme Selection -->
<select id="themeSelector" class="dump-block__themes-select">
  <?php foreach ( $themesList as $theme ) : ?>
  <option value="<?php echo $theme ?>">
    <?php echo ucfirst( $theme ) ?>
  </option>
  <?php endforeach; ?>
</select>