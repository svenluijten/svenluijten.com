import hljs from "highlight.js";
import dockerfile from "highlight.js/lib/languages/dockerfile";

hljs.registerLanguage('dockerfile', dockerfile);

hljs.highlightAll();
