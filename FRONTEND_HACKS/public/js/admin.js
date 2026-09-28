/* MarketLink Admin – modals, form filling and confirmations (no dependencies) */
(function () {
    function openModal(id) {
        var m = document.getElementById(id);
        if (m) { m.classList.add('open'); }
        return m;
    }
    function closeModal(m) { if (m) { m.classList.remove('open'); } }

    document.addEventListener('click', function (e) {
        var opener = e.target.closest('[data-modal-open]');
        if (opener) {
            var modal = openModal(opener.getAttribute('data-modal-open'));
            var form = modal ? modal.querySelector('form') : null;
            if (form) {
                var action = opener.getAttribute('data-action');
                if (action) { form.setAttribute('action', action); }
                var title = opener.getAttribute('data-title');
                var titleEl = modal.querySelector('[data-modal-title]');
                if (title && titleEl) { titleEl.textContent = title; }
                var fill = opener.getAttribute('data-fill');
                if (fill) {
                    try {
                        var data = JSON.parse(fill);
                        Object.keys(data).forEach(function (key) {
                            var field = form.elements[key];
                            if (field) { field.value = data[key] === null ? '' : data[key]; }
                        });
                    } catch (err) { console.error('Invalid data-fill JSON', err); }
                } else if (opener.hasAttribute('data-reset')) {
                    form.reset();
                }
            }
            return;
        }
        if (e.target.closest('[data-modal-close]') || e.target.classList.contains('modal-overlay')) {
            closeModal(e.target.closest('.modal-overlay'));
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(closeModal);
        }
    });

    document.addEventListener('submit', function (e) {
        var msg = e.target.getAttribute('data-confirm');
        if (msg && !window.confirm(msg)) { e.preventDefault(); }
    });

    // Re-open a modal after a failed validation so the admin sees the form errors in context.
    document.addEventListener('DOMContentLoaded', function () {
        var reopen = document.body.getAttribute('data-reopen-modal');
        if (reopen) { openModal(reopen); }
    });
})();
