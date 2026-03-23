import Prism from "prismjs";
import "prismjs/components/prism-markup";
import "prismjs/components/prism-markup-templating";
import "prismjs/components/prism-bash";
import "prismjs/components/prism-css";
import "prismjs/components/prism-javascript";
import "prismjs/components/prism-jsx";
import "prismjs/components/prism-typescript";
import "prismjs/components/prism-tsx";
import "prismjs/components/prism-json";
import "prismjs/components/prism-yaml";
import "prismjs/components/prism-php";
import "prismjs/components/prism-markdown";

function iconCopy() {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path></svg>';
}

function iconCheck() {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
}

function addCopyButtons(root = document) {
    const blocks = root.querySelectorAll(".markdown-viewer .prose pre");

    blocks.forEach((block) => {
        if (!(block instanceof HTMLElement)) {
            return;
        }

        if (block.dataset.copyEnhanced === "true") {
            return;
        }

        const code = block.querySelector("code");
        if (!code) {
            return;
        }

        block.dataset.copyEnhanced = "true";
        block.classList.add("markdown-viewer__code-block");

        const button = document.createElement("button");
        button.type = "button";
        button.className = "markdown-viewer__copy-btn";
        button.setAttribute("aria-label", "Copy code");
        button.innerHTML = iconCopy();

        button.addEventListener("click", async () => {
            try {
                await navigator.clipboard.writeText(code.textContent ?? "");
                button.classList.add("is-copied");
                button.innerHTML = iconCheck();

                window.setTimeout(() => {
                    button.classList.remove("is-copied");
                    button.innerHTML = iconCopy();
                }, 1500);
            } catch {
                button.classList.remove("is-copied");
            }
        });

        block.appendChild(button);
    });
}

function initMarkdownViewer() {
    Prism.highlightAll();
    addCopyButtons(document);
}

document.addEventListener("DOMContentLoaded", initMarkdownViewer);
document.addEventListener("livewire:navigated", initMarkdownViewer);

export default initMarkdownViewer;
