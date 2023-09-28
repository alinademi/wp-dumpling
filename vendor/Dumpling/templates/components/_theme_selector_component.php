<div x-data>
  <select id="themeSelector" class="dump-block__themes-select" x-model="$store.appState.theme"
    @change="$store.appState.setTheme($event.target.value)">
    <template x-for="theme in $store.appState.themes" :key="theme">
      <option :value="theme" x-text="theme.charAt(0).toUpperCase() + theme.slice(1)"></option>
    </template>
  </select>
</div>