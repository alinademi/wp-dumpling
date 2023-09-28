<div x-data="buttonsData()" x-init="init">
  <template x-for="button in buttons" :key="button.modifier">
    <button @click="setModalPosition(button);"
      :class="`dump-block__control-button dump-block__control-button--${button.modifier}`"
      :data-position="button.position">
      <svg class="dump-block__button-svg">
        <rect class="outer-square"></rect>
        <rect :class="`inner-square inner-square--${button.modifier}`"></rect>
      </svg>
    </button>
  </template>
</div>
