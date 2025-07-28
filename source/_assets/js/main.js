import highlight from 'highlight.js'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

import scss from 'highlight.js/lib/languages/scss';
import php from 'highlight.js/lib/languages/php';
import markdown from 'highlight.js/lib/languages/markdown';
import json from 'highlight.js/lib/languages/json';
import javascript from 'highlight.js/lib/languages/javascript';
import xml from 'highlight.js/lib/languages/xml';
import css from 'highlight.js/lib/languages/css';
import bash from 'highlight.js/lib/languages/bash';
import yaml from 'highlight.js/lib/languages/yaml';
import sql from 'highlight.js/lib/languages/sql';
import dsconfig from 'highlight.js/lib/languages/dsconfig';
import python from 'highlight.js/lib/languages/python';
import nginx from 'highlight.js/lib/languages/nginx';
import shell from 'highlight.js/lib/languages/shell';


// Syntax highlighting
highlight.registerLanguage('python', python);
highlight.registerLanguage('nginx', nginx);
highlight.registerLanguage('bash', bash);
highlight.registerLanguage('shell', shell);
highlight.registerLanguage('css', css);
highlight.registerLanguage('html', xml);
highlight.registerLanguage('javascript', javascript);
highlight.registerLanguage('json', json);
highlight.registerLanguage('markdown', markdown);
highlight.registerLanguage('php', php);
highlight.registerLanguage('scss', scss);
highlight.registerLanguage('yaml', yaml);
highlight.registerLanguage('sql', sql);
highlight.registerLanguage('dsconfig', dsconfig);

document.querySelectorAll('pre code').forEach((block) => {
    highlight.highlightBlock(block);
});

