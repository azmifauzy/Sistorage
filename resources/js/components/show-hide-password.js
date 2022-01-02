class ShowHidePassword {
  constructor() {
    this.button = document.querySelector('#showHidePassword');
    this.input = document.querySelector('#password');
  }

  render() {
    if (this.button) {
      this.#onClick();
    }
  }

  #onClick() {
    const { button, input } = this;
    
    button.addEventListener('click', () => {
      if (button.classList.contains('active')) {
        this.#hide(button, input);
      } else {
        this.#show(button, input);
      }
    });
  }

  #show(button, input) {
    button.classList.add('active');
    button.firstElementChild.className = 'bi bi-eye-slash';
    input.setAttribute('type', 'text');
  }

  #hide(button, input) {
    button.classList.remove('active');
    button.firstElementChild.className = 'bi bi-eye';
    input.setAttribute('type', 'password');
  }
}

const showHidePassword = new ShowHidePassword();

export default showHidePassword;