import './utils/clipboard'
import accordion from './ui/accordion'
import alert from './ui/alert'
import input from './ui/input'
import tabs from './ui/tabs'
import dropdown from './ui/dropdown'
import commandPalette from './ui/command-palette'
import datePicker from './ui/date-picker'
import './ui/markdown-viewer'

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', dropdown);
    Alpine.data('alert', alert);
    // initDarkMode();
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);
    Alpine.data('commandPalette', commandPalette);
    Alpine.data('datePicker', datePicker);
});
