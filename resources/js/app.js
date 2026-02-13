import accordion from './ui/accordion'
import tabs from './ui/tabs'
import input from './ui/input'

// Utils functions
function copyToClipboard(text) {
    try {
        navigator.clipboard.writeText(text)
            .then(() => {
                // Show feedback with toast
                const toast = document.createElement('div')
                toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300'
                toast.textContent = 'Copied to clipboard!'
                document.body.appendChild(toast)

                setTimeout(() => {
                    toast.style.opacity = '0'
                    setTimeout(() => toast.remove(), 300)
                }, 2000)
            })
            .catch((err) => {
                console.error('Failed to copy:', err)
            })
    } catch (e) {
        console.error('Failed to copy:', e)
    }
}

function toggleDarkMode() {
    document.documentElement.classList.toggle('dark')
    localStorage.setItem('darkMode', document.documentElement.classList.contains('dark') ? 'true' : 'false')
}

function initDarkMode() {
    const savedDarkMode = localStorage.getItem('darkMode')
    const isDark = savedDarkMode === 'true'

    if (isDark) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
}

document.addEventListener('alpine:init', () => {
    initDarkMode();
    Alpine.data('input', input);
    Alpine.data('tabs', tabs);
    Alpine.data('accordion', accordion);

    // Make utils available to Alpine
    Alpine.data('toggleDarkMode', toggleDarkMode)
    Alpine.data('copyToClipboard', copyToClipboard)
});
