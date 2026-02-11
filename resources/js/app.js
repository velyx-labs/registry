import accordion from './ui/accordion'


document.addEventListener('alpine:init', () => {
    Alpine.data('accordion', accordion);
});
