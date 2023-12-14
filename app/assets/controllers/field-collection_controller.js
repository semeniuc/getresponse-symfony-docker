import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['entity', 'bitrix', 'getresponse']

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
        tr.classList.toggle('fade-in', true);

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
        tr.classList.toggle('fade-out', true);
        if (tr) {
            tr.addEventListener('animationend', () => {
                tr.remove();
            }, { once: true });
        }
    }
}