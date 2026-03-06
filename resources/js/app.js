import './utils/clipboard'
import accordion from './ui/accordion'
import input from './ui/input'
import tabs from './ui/tabs'
import dropdown from './ui/dropdown'

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', dropdown);
    // initDarkMode();
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);
});
