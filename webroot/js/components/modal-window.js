class ModalWindow extends HTMLElement {
    connectedCallback() {
        const dialog = this.querySelectr('dialog');
        if (!dialog) {
            throw new Error('Cannot find dialog element');
        }
        dialog.showModal();
        // Listen for clicks to any element with `modal-close=1` attributes.
        dialog
            .querySelector('[modal-close="1"]')
            .addEventListener('click', function (event) {
                event.preventDefault();
                dialog.close();
            }, false);
    }
}

customElements.define('modal-window', ModalWindow);

export default ModalWindow;
