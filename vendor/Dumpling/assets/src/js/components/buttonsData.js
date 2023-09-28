// buttonsData.js
export default function buttonsData() {
	return {
		buttons: [
			{ modifier: 'center', position: 'dump-block__modal--center' },
			{ modifier: 'top-left', position: 'dump-block__modal--top-left' },
			{ modifier: 'top-right', position: 'dump-block__modal--top-right' },
			{ modifier: 'bottom-left', position: 'dump-block__modal--bottom-left' },
			{ modifier: 'bottom-right', position: 'dump-block__modal--bottom-right' }
		],
		containerId: null,

		init() {
			const container = this.$el.closest('.dump-block');
			this.containerId = container ? container.id : null;
		},

		setModalPosition(button) {
			const windowWidth = window.innerWidth;
			if (windowWidth <= 768) return;

			const container = this.$el.closest('.dump-block');
			if (container) {
				container.className = 'dump-block ' + button.position;
				this.$store.appState.openModal('.dump-block');
			} else {
				console.error("Container not found.");
			}
		}

	};
}
