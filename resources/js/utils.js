/**
 * Copy text to clipboard and show feedback
 * @param {string} selector - CSS selector for the element containing text to copy
 * @param {HTMLElement} button - Button element that triggered the copy
 * @param {Object} options - Optional configuration
 * @param {string} options.successIcon - SVG string for success icon
 * @param {string} options.successText - Text to show after successful copy
 * @param {number} options.duration - Duration in ms to show success state
 */
export function copyToClipboard(selector, button, options = {}) {
    const content = document.querySelector(selector);
    if (!content) return;

    const {
        successIcon = `<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>`,
        successText = 'Copied!',
        duration = 2000
    } = options;

    // Copy the text
    const textarea = document.createElement('textarea');
    textarea.value = content.textContent;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);

    // Show feedback
    const originalContent = button.innerHTML;
    button.innerHTML = successIcon ? `${successIcon}${successText}` : successText;
    
    setTimeout(() => {
        button.innerHTML = originalContent;
    }, duration);
}

// Also expose the function globally
window.copyToClipboard = copyToClipboard; 