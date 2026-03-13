export default (options = {}) => ({
    isDragging: false,
    uploadProgress: 0,
    isUploading: false,
    previews: [],
    fileNames: [],
    isImage: options.isImage || false,

    handleFiles(files) {
        if (!files || files.length === 0) {
            return;
        }

        this.fileNames = Array.from(files).map((file) => file.name);
        this.previews = [];

        if (this.isImage) {
            Array.from(files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const url = URL.createObjectURL(file);
                    this.previews.push(url);
                }
            });
        }
    },

    clearPreviews() {
        this.previews.forEach((url) => URL.revokeObjectURL(url));
        this.previews = [];
        this.fileNames = [];
    },
});
