const themeDataElement = document.getElementById('theme-data');
const themes = themeDataElement ? JSON.parse(themeDataElement.dataset.themes || '{}') : {};
const initialThemeKey = Object.keys(themes)[0] || 'default';

export default {
	theme: initialThemeKey,
	themes: Object.keys(themes),
	setTheme(theme) {
		this.theme = theme;
		const themeData = themes[theme];
		if (themeData) {
			for (const key in themeData) {
				document.documentElement.style.setProperty(key, themeData[key]);
			}
		} else {
			console.error('Selected theme not found:', theme);
		}
	},
};
