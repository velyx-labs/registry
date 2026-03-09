import './utils/clipboard'
import accordion from './ui/accordion'
import alert from './ui/alert'
import input from './ui/input'
import tabs from './ui/tabs'
import dropdownMenu from './ui/dropdown-menu'
import commandPalette from './ui/command-palette'
import drawer from './ui/drawer'
import datePicker from './ui/date-picker'
import './ui/markdown-viewer'

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdownMenu', dropdownMenu);
    Alpine.data('alert', alert);
    // initDarkMode();
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);
    Alpine.data('commandPalette', commandPalette);
    Alpine.data('drawer', drawer);
    Alpine.data('datePicker', datePicker);
});
