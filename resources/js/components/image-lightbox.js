const LIGHTBOX_STYLES = `
.image-lightbox {
    max-width: 100vw;
    max-height: 100vh;
    width: 100%;
    height: 100%;
    border: none;
    padding: 0;
    background: transparent;
    color: inherit;
}

.image-lightbox::backdrop {
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(4px);
    animation: fadeIn 200ms ease-out;
}

.image-lightbox[open] {
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 200ms ease-out;
}

.image-lightbox-content {
    position: relative;
    max-width: 95vw;
    max-height: 95vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-lightbox-img {
    max-width: 95vw;
    max-height: 95vh;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 0.5rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    animation: scaleIn 200ms ease-out;
}

.image-lightbox-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 0.5rem;
    padding: 0.5rem;
    color: white;
    cursor: pointer;
    transition: all 150ms ease-in-out;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-lightbox-close:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: scale(1.1);
}

.image-lightbox-close:focus {
    outline: 2px solid var(--color-secondary);
    outline-offset: 2px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

#post-content img {
    cursor: pointer;
    transition: transform 50ms ease-in-out;
}

.image-carousel img {
    cursor: pointer;
}
`;

const LIGHTBOX_TEMPLATE = `
<dialog id="image-lightbox" class="image-lightbox">
    <div class="image-lightbox-content">
        <button type="button" class="image-lightbox-close" aria-label="Close lightbox">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <img src="" alt="" class="image-lightbox-img">
    </div>
</dialog>
`;

class ImageLightbox extends HTMLElement {
    constructor() {
        super();
        this.dialog = null;
        this.dialogImg = null;
        this.closeBtn = null;
        this.postContent = null;
        this.dragThreshold = 10;
        this.boundImageClick = null;
        this.boundClose = null;
    }

    connectedCallback() {
        this.injectStyles();
        this.createDialog();
        this.setupEventListeners();
    }

    disconnectedCallback() {
        // Cleanup event listeners
        if (this.postContent && this.boundImageClick) {
            this.postContent.removeEventListener('click', this.boundImageClick);
        }

        // Remove dialog from DOM
        if (this.dialog) {
            this.dialog.remove();
        }
    }

    injectStyles() {
        if (document.getElementById('image-lightbox-styles')) return;

        const style = document.createElement('style');
        style.id = 'image-lightbox-styles';
        style.textContent = LIGHTBOX_STYLES;
        document.head.appendChild(style);
    }

    createDialog() {
        const existing = document.getElementById('image-lightbox');
        if (existing) {
            console.warn('ImageLightbox: Dialog already exists, removing old instance.');
            existing.remove();
        }

        const temp = document.createElement('div');
        temp.innerHTML = LIGHTBOX_TEMPLATE.trim();
        this.dialog = temp.querySelector('#image-lightbox');

        this.dialogImg = this.dialog.querySelector('.image-lightbox-img');
        this.closeBtn = this.dialog.querySelector('.image-lightbox-close');

        document.body.appendChild(this.dialog);
    }

    setupEventListeners() {
        this.postContent = document.getElementById('post-content');
        if (!this.postContent) return;

        this.boundImageClick = this.handleImageClick.bind(this);
        this.postContent.addEventListener('click', this.boundImageClick);

        this.boundClose = this.close.bind(this);
        this.closeBtn.addEventListener('click', this.boundClose);

        this.dialog.addEventListener('close', this.handleDialogClose.bind(this));

        this.dialog.addEventListener('click', this.handleBackdropClick.bind(this));
    }

    handleImageClick(e) {
        const target = e.target;

        if (target.tagName !== 'IMG') return;

        e.preventDefault();

        const carousel = target.closest('.image-carousel');

        if (carousel) {
            const startX = carousel.dataset.startX;
            const currentX = e.pageX;

            if (!startX || Math.abs(currentX - parseInt(startX)) < this.dragThreshold) {
                this.open(target);
            }
        } else {
            this.open(target);
        }
    }

    open(img) {
        this.dialogImg.src = img.src;
        this.dialogImg.alt = img.alt || '';
        this.dialog.showModal();
        document.body.style.overflow = 'hidden';

        this.dispatchEvent(new CustomEvent('lightbox:open', {
            detail: { src: img.src, alt: img.alt },
            bubbles: true
        }));
    }

    close() {
        this.dialog.close();
        document.body.style.overflow = '';

        this.dispatchEvent(new CustomEvent('lightbox:close', { bubbles: true }));
    }

    handleDialogClose() {
        document.body.style.overflow = '';
    }

    handleBackdropClick(e) {
        const rect = this.dialogImg.getBoundingClientRect();
        const isInDialog = (
            rect.top <= e.clientY &&
            e.clientY <= rect.top + rect.height &&
            rect.left <= e.clientX &&
            e.clientX <= rect.left + rect.width
        );

        if (!isInDialog) {
            this.close();
        }
    }

    get isOpen() {
        return this.dialog?.open ?? false;
    }
}

customElements.define('image-lightbox', ImageLightbox);

export default ImageLightbox;
