import Alpine from 'alpinejs';
import modalStore from './modalStore.js';
import themeStore from './themeStore.js';

Alpine.store('appState', {
	...modalStore,
	...themeStore,
});

export default Alpine;
