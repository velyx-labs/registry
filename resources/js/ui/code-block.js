import Prism from 'prismjs'
import 'prismjs/components/prism-markup'
import 'prismjs/components/prism-markup-templating'
import 'prismjs/components/prism-bash'
import 'prismjs/components/prism-css'
import 'prismjs/components/prism-javascript'
import 'prismjs/components/prism-jsx'
import 'prismjs/components/prism-typescript'
import 'prismjs/components/prism-tsx'
import 'prismjs/components/prism-json'
import 'prismjs/components/prism-yaml'
import 'prismjs/components/prism-php'
import 'prismjs/components/prism-markdown'

const languageAliases = {
    html: 'markup',
    xml: 'markup',
    blade: 'php',
    shell: 'bash',
    sh: 'bash',
    yml: 'yaml',
    ts: 'typescript',
    js: 'javascript',
}

export default (options = {}) => ({
    code: options.code ?? '',
    language: options.language ?? 'plaintext',
    highlightedCode: '',
    copyable: options.copyable ?? true,
    copied: false,

    init() {
        this.highlightedCode = this.highlight(this.code);
    },

    highlight(rawCode) {
        const code = String(rawCode ?? '');
        const language = this.resolveLanguage(this.language);
        const grammar = Prism.languages[language] ?? Prism.languages.plaintext;

        return Prism.highlight(code, grammar, language);
    },

    resolveLanguage(language) {
        const normalized = String(language ?? 'plaintext').toLowerCase();

        if (languageAliases[normalized]) {
            return languageAliases[normalized];
        }

        return Prism.languages[normalized] ? normalized : 'plaintext';
    },

    async copyCode() {
        if (!this.copyable) {
            return;
        }

        const content = String(this.code ?? '');

        if (content.length === 0) {
            return;
        }

        try {
            await navigator.clipboard.writeText(content);
            this.copied = true;
            setTimeout(() => {
                this.copied = false;
            }, 1500);
        } catch {
            this.copied = false;
        }
    },
});
