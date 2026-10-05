class PostReply extends HTMLElement {
    constructor() {
        super();
        this.form = null;
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    connectedCallback() {
        this.form = this.querySelector('form');
        if (!this.form) return;

        this.form.addEventListener('submit', this.handleSubmit);
    }

    disconnectedCallback() {
        this.form?.removeEventListener('submit', this.handleSubmit);
    }

    handleSubmit(event) {
        event.preventDefault();

        const input = this.form.querySelector('input[name="message"]');
        const message = input.value.trim();

        // `required` catches an empty field; this catches whitespace only.
        if (!message) {
            input.focus();
            return;
        }

        const { replyUser, replyDomain, replySubject } = this.form.dataset;

        // encodeURIComponent rather than URLSearchParams: the latter encodes spaces
        // as `+`, which some mail clients drop into the draft literally.
        const subject = encodeURIComponent(replySubject);
        const body = encodeURIComponent(message);

        window.location.href = `mailto:${replyUser}@${replyDomain}?subject=${subject}&body=${body}`;
    }
}

customElements.define('post-reply', PostReply);
