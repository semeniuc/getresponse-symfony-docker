import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['type', 'stage']

    add(event) {
        event.preventDefault();

        const tbody = event.target.closest('tbody');
        const rows = tbody.querySelectorAll('tr');
        const lastRow = rows[rows.length - 2];
        const newRow = lastRow.cloneNode(true);
        newRow.classList.add('fade-in');

        tbody.insertBefore(newRow, tbody.lastElementChild);
    }

    delete(event) {
        event.preventDefault();
        const row = event.target.closest('tr');
        row.classList.add('fade-out');

        setTimeout(() => {
            row.remove();
        }, 500);
    }
}