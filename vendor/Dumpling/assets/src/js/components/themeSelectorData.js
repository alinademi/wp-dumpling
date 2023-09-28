export default function themeSelectorData() {
	return {
		changeTheme(event) {
			this.$store.appState.setTheme(event.target.value); // Use the newly selected theme
		}
	};
}
