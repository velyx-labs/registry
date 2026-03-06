{{-- Alert Preview Controls --}}
<div class="preview-controls">
    <div class="preview-controls-panel">
        <div class="preview-controls-title">Alert Controls</div>
        <div class="preview-controls-buttons">
            <button @click="show('info')" class="preview-button" style="background: hsl(var(--primary)); color: white;">
                Info
            </button>
            <button @click="show('success')" class="preview-button" style="background: hsl(142 76% 36%); color: white;">
                Success
            </button>
            <button @click="show('warning')" class="preview-button" style="background: hsl(43 96% 56%); color: black;">
                Warning
            </button>
            <button @click="show('error')" class="preview-button" style="background: hsl(0 84% 60%); color: white;">
                Error
            </button>
            <button @click="visible = false" class="preview-button preview-button-secondary">
                Dismiss
            </button>
        </div>
    </div>
</div>
