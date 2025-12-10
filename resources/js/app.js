import hljs from "highlight.js";
import dockerfile from "highlight.js/lib/languages/dockerfile";

hljs.registerLanguage('dockerfile', dockerfile);

hljs.highlightAll();

// Image carousel for consecutive images in post content
document.addEventListener('DOMContentLoaded', function() {
    const postContent = document.getElementById('post-content');
    if (!postContent) return;

    // Find all paragraphs that contain only an image
    const paragraphs = Array.from(postContent.querySelectorAll('p'));
    const imageGroups = [];
    let currentGroup = [];

    paragraphs.forEach((p, index) => {
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

    // Don't forget the last group
    if (currentGroup.length > 1) {
        imageGroups.push(currentGroup);
    }

    // Convert each group into a carousel
    imageGroups.forEach(group => {
        const wrapper = document.createElement('div');
        wrapper.className = 'image-carousel-wrapper';

        const carousel = document.createElement('div');
        carousel.className = 'image-carousel';

        wrapper.appendChild(carousel);

        // Store parent reference before removing any elements
        const parentNode = group[0].parentNode;
        const referenceNode = group[0];

        // Move all images from their paragraphs into the carousel
        group.forEach(p => {
            const img = p.querySelector('img');
            if (img) {
                carousel.appendChild(img);
            }
        });

        // Insert the wrapper where the first paragraph was
        if (parentNode) {
            parentNode.insertBefore(wrapper, referenceNode);

            // Now remove the paragraphs
            group.forEach(p => p.remove());
        }

        // Add drag-to-scroll functionality
        let isDragging = false;
        let startX;
        let scrollLeft;

        carousel.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });

        carousel.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        carousel.addEventListener('mouseup', () => {
            isDragging = false;
        });

        carousel.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - carousel.offsetLeft;
            const walk = (x - startX) * 2; // Multiply for faster scrolling
            carousel.scrollLeft = scrollLeft - walk;
        });

        // Prevent image dragging
        carousel.querySelectorAll('img').forEach(img => {
            img.addEventListener('dragstart', (e) => e.preventDefault());
        });
    });
});
