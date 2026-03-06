{{-- Dialog Preview Controls --}}
<div class="preview-controls">
    <div class="preview-controls-panel">
        <div class="preview-controls-title">Dialog Controls</div>
        <div class="preview-controls-buttons">
            <button @click="open = true" class="preview-button preview-button-primary">
                Open Dialog
            </button>
            <button @click="open = false" class="preview-button preview-button-secondary">
                Cancel
            </button>
            <button @click="confirm(); open = false" class="preview-button" style="background: hsl(0 84% 60%); color: white;">
                Confirm
            </button>
        </div>
    </div>
</div>
