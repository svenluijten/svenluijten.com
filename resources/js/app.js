import hljs from "highlight.js";
import dockerfile from "highlight.js/lib/languages/dockerfile";
import './components/image-lightbox.js';
import './components/image-carousel.js';

hljs.registerLanguage('dockerfile', dockerfile);

(function () {
    hljs.highlightAll();
})();
