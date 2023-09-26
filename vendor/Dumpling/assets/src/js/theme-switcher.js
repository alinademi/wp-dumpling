document.addEventListener('DOMContentLoaded', function() {
    const themeDataElement = document.querySelector('#theme-data');
    const themes = JSON.parse(themeDataElement.dataset.themes || '{}');

    const themeSelector = document.querySelector('#themeSelector');
    themeSelector.addEventListener('change', function() {
        const selectedTheme = themeSelector.value;
        const themeData = themes[selectedTheme];

        if (!themeData) {
            console.error('Selected theme not found:', selectedTheme);
            return;
        }

        for (let key in themeData) {
            document.documentElement.style.setProperty(key, themeData[key]);
        }
    });
});
