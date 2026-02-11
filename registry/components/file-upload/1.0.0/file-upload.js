export default (options = {}) => ({
  isDragging: false,
  uploadProgress: 0,
  isUploading: false,
  previews: [],
  fileNames: [],
  isImage: options.isImage || false,

  handleFiles(files) {
    if (!files || files.length === 0) return;

    this.fileNames = Array.from(files).map((f) => f.name);
    this.previews = [];

    if (this.isImage) {
      Array.from(files).forEach((file) => {
        if (file.type.startsWith("image/")) {
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

  handleDragOver(event) {
    event.preventDefault();
    this.isDragging = true;
  },

  handleDragLeave(event) {
    event.preventDefault();
    this.isDragging = false;
  },

  handleDrop(event) {
    event.preventDefault();
    this.isDragging = false;
    this.handleFiles(event.dataTransfer.files);
  },
});
