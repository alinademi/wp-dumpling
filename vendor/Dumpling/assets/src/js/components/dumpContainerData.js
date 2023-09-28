import { nanoid } from 'nanoid';

export default function dumpContainerData() {
	return {
		init() {
			this.$el.id = `dp-instance-${nanoid()}`;
		}
	};
}
