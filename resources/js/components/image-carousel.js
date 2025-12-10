class ImageCarousel extends HTMLElement {
    constructor() {
        super();
        this.postContent = null;
        this.carousels = [];
        this.dragThreshold = 10;
    }

    connectedCallback() {
        this.postContent = document.getElementById('post-content');
        if (!this.postContent) return;

        this.initializeCarousels();
    }

    disconnectedCallback() {
        // Cleanup event listeners on all carousels
        this.carousels.forEach(({ carousel, handlers }) => {
            carousel.removeEventListener('mousedown', handlers.mousedown);
            carousel.removeEventListener('mouseleave', handlers.mouseleave);
            carousel.removeEventListener('mouseup', handlers.mouseup);
            carousel.removeEventListener('mousemove', handlers.mousemove);

            carousel.querySelectorAll('img').forEach(img => {
                img.removeEventListener('dragstart', handlers.dragstart);
            });
        });

        this.carousels = [];
    }

    initializeCarousels() {
        const imageGroups = this.findImageGroups();

        imageGroups.forEach(group => {
            this.createCarousel(group);
        });
    }

    findImageGroups() {
        const paragraphs = Array.from(this.postContent.querySelectorAll('p'));
        const imageGroups = [];
        let currentGroup = [];

        paragraphs.forEach((p) => {
            const children = Array.from(p.children);
            const hasOnlyImage = children.length === 1 && children[0].tagName === 'IMG';

            if (hasOnlyImage) {
                currentGroup.push(p);
            } else {
                if (currentGroup.length > 1) {
                    imageGroups.push([...currentGroup]);
                }
                currentGroup = [];
            }
        });

        if (currentGroup.length > 1) {
            imageGroups.push(currentGroup);
        }

        return imageGroups;
    }

    createCarousel(group) {
        const wrapper = document.createElement('div');
        wrapper.className = 'image-carousel-wrapper';

        const carousel = document.createElement('div');
        carousel.className = 'image-carousel';

        wrapper.appendChild(carousel);

        const parentNode = group[0].parentNode;
        const referenceNode = group[0];

        group.forEach(p => {
            const img = p.querySelector('img');
            if (img) {
                carousel.appendChild(img);
            }
        });

        if (parentNode) {
            parentNode.insertBefore(wrapper, referenceNode);

            group.forEach(p => p.remove());
        }

        this.setupDragScroll(carousel);

        this.dispatchEvent(new CustomEvent('carousel:created', {
            detail: { carousel, imageCount: group.length },
            bubbles: true
        }));
    }

    setupDragScroll(carousel) {
        let isDragging = false;
        let startX;
        let scrollLeft;

        const handlers = {
            mousedown: (e) => {
                isDragging = true;
                startX = e.pageX - carousel.offsetLeft;
                scrollLeft = carousel.scrollLeft;
                carousel.dataset.startX = e.pageX;
            },
            mouseleave: () => {
                isDragging = false;
            },
            mouseup: () => {
                isDragging = false;
                setTimeout(() => {
                    delete carousel.dataset.startX;
                }, 10);
            },
            mousemove: (e) => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - carousel.offsetLeft;
                const walk = (x - startX) * 2;
                carousel.scrollLeft = scrollLeft - walk;
            },
            dragstart: (e) => e.preventDefault()
        };

        carousel.addEventListener('mousedown', handlers.mousedown);
        carousel.addEventListener('mouseleave', handlers.mouseleave);
        carousel.addEventListener('mouseup', handlers.mouseup);
        carousel.addEventListener('mousemove', handlers.mousemove);

        carousel.querySelectorAll('img').forEach(img => {
            img.addEventListener('dragstart', handlers.dragstart);
        });

        this.carousels.push({ carousel, handlers });
    }
}

customElements.define('image-carousel', ImageCarousel);

export default ImageCarousel;
