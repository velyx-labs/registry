import accordion from './ui/accordion'
import tabs from './ui/tabs'
import input from './ui/input'


document.addEventListener('alpine:init', () => {
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);
});
