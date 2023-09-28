import dumpContainerData from './components/dumpContainerData';
import buttonsData from './components/buttonsData';
import modalCloseButtonData from './components/modalCloseButtonData';
import themeSelectorData from './components/themeSelectorData';

const components = {
	dumpContainerData,
	buttonsData,
	modalCloseButtonData,
	themeSelectorData,
};

// this attaches all the components to the window object, so that alpine can pick them up
Object.keys(components).forEach((key) => {
	window[key] = components[key];
});
