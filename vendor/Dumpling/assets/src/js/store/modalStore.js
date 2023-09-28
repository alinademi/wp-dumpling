export default {
	isModalOpen: false,
	openModal(containerSelector) {
		console.log('openModal called');
		this.isModalOpen = true;
		const container = document.querySelector(containerSelector);
		if (container) {
			container.classList.add('dump-block__modal');
		}
	},
	closeModal() {
		console.log('closeModal called');
		this.isModalOpen = false;
		const modalElement = document.querySelector('.dump-block__modal');
		if (modalElement) {
			modalElement.classList.remove('dump-block__modal');
		}
	}
};
