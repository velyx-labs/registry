{{-- Modal Preview Controls --}}
<div class="preview-controls">
    <div class="preview-controls-panel">
        <div class="preview-controls-title">Modal Controls</div>
        <div class="preview-controls-buttons">
            <button @click="open = true" class="preview-button preview-button-primary">
                Open
            </button>
            <button @click="open = false" class="preview-button preview-button-secondary">
                Close
            </button>
            <button @click="open = !open" class="preview-button preview-button-secondary">
                Toggle
            </button>
        </div>
    </div>
</div>
