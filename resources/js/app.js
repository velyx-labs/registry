import './utils/clipboard'
import accordion from './ui/accordion'
import input from './ui/input'
import tabs from './ui/tabs'

document.addEventListener('alpine:init', () => {
    // initDarkMode();
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);
});
