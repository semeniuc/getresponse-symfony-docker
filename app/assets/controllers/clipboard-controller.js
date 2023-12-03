import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ['hook']
    copy() {
        navigator.clipboard.writeText(this.hookTarget.value)
        console.log('Success copy!', this.hookTarget);
    }
}