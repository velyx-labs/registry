{{-- Drawer Preview Controls --}}
<div class="preview-controls">
    <div class="preview-controls-panel">
        <div class="preview-controls-title">Drawer Controls</div>
        <div class="preview-controls-buttons">
            <button @click="open = true; position = 'right'" class="preview-button preview-button-primary">
                Right
            </button>
            <button @click="open = true; position = 'left'" class="preview-button preview-button-secondary">
                Left
            </button>
            <button @click="open = true; position = 'top'" class="preview-button preview-button-secondary">
                Top
            </button>
            <button @click="open = true; position = 'bottom'" class="preview-button preview-button-secondary">
                Bottom
            </button>
            <button @click="open = false" class="preview-button preview-button-secondary">
                Close
            </button>
        </div>
    </div>
</div>
