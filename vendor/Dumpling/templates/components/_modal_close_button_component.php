<div x-data>
  <button class="dump-block__control-button dump-block__control-button--close" @click="$store.appState.closeModal()"
    x-show="$store.appState.isModalOpen">
    <svg viewBox="0 0 16 16">
      <path d="M1 1 L15 15 M15 1 L1 15" stroke="white" stroke-width="3"></path>
    </svg>
  </button>
</div>
