import htmx from 'https://unpkg.com/htmx.org@2.0.0/dist/htmx.esm.js';
import ModalWindow from './components/modal-window.js';

htmx.defineExtension('ajax-header', {
  onEvent: function (name, evt) {
    if (name === 'htmx:configRequest') {
      // Attach CSRF token from meta tag into headers.
      evt.detail.headers['X-Csrf-Token'] = document.getElementById('csrf-token').getAttribute('content');
    }
  },
});
