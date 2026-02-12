export default (options = {}) => ({
  showPassword: false,

  togglePassword() {
    this.showPassword = !this.showPassword;
  },
});
