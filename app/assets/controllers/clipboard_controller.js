import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['hook']
    copy(event) {
        event.preventDefault()
        navigator.clipboard.writeText(this.hookTarget.value)
    }
}