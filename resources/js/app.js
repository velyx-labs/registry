import './utils/clipboard'
import accordion from './ui/accordion'
import alert from './ui/alert'
import input from './ui/input'
import tabs from './ui/tabs'
import dropdownMenu from './ui/dropdown-menu'
import commandPalette from './ui/command-palette'
import drawer from './ui/drawer'
import datePicker from './ui/date-picker'
import fileUpload from './ui/file-upload'
import dialog from './ui/dialog'
import rating from './ui/rating'
import toast from './ui/toast'
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
    Alpine.data('fileUpload', fileUpload);
    Alpine.data('dialog', dialog);
    Alpine.data('rating', rating);
    Alpine.data('toast', toast);
});
