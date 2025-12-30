// Only activate if browser doesn't support scroll-timeline
if (!CSS.supports('animation-timeline', 'scroll()')) {
    class VinylCabinet extends HTMLElement {
        constructor() {
            super();
            this.records = [];
            this.observer = null;
        }

        connectedCallback() {
            this.initializeObserver();
        }

        disconnectedCallback() {
            if (this.observer) {
                this.observer.disconnect();
            }
        }

        initializeObserver() {
            const cabinet = document.getElementById('vinyl-cabinet');
            if (!cabinet) return;

            this.records = Array.from(cabinet.querySelectorAll('.vinyl-record'));

            this.observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.intersectionRatio < 0.5) {
                            entry.target.classList.add('is-stacked');
                        } else {
                            entry.target.classList.remove('is-stacked');
                        }
                    });
                },
                {
                    threshold: [0, 0.25, 0.5, 0.75, 1],
                    rootMargin: '-10% 0px -10% 0px'
                }
            );

            this.records.forEach(record => {
                this.observer.observe(record);
            });
        }
    }

    customElements.define('vinyl-cabinet', VinylCabinet);
}

export default typeof VinylCabinet !== 'undefined' ? VinylCabinet : null;
