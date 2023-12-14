import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['type', 'stage']

    static values = {
        index    : Number,
        prototype: String,
    }

    add(event) {
        event.preventDefault();
        
        // Generation data
        const generation =  document.createElement('section');
        generation.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
        
        // Get data
        const data = Array.from(generation.querySelectorAll('div > div'));

        // Create tr
        const tr = document.createElement('tr');
        tr.setAttribute('data-controller', 'fade');

        // Add td
        data.forEach(div => {
            const td = document.createElement('td');
            td.appendChild(div);
            tr.appendChild(td);
        });

        // Define tbody
        const tbody = event.target.closest('tbody');

        // Add td "Delete"
        const del = tbody.querySelector('tr > td').cloneNode(true);
        tr.insertBefore(del, tr.firstChild);

        // Add tr
        tbody.insertBefore(tr, tbody.lastElementChild);
        this.indexValue++;
    }

    delete(event) {
        event.preventDefault();

        const tr = event.target.closest('tr');
        if (tr) {
            tr.remove();
        }
    }
}