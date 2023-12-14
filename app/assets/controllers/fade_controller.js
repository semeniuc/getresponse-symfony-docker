import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    connect() {
        this.element.classList.add('fade-in');
    }

    disconnect() {
        this.element.classList.add('fade-out');

        setTimeout(
            () => {
                this.element.classList.toggle('fade-out', true);
            },
            1000
        );
    }
}