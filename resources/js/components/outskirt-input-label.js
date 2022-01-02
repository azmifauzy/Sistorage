class OutskirtInputLabel {
  constructor() {
    this.inputs = document.querySelectorAll('.outskirt-input');
    this.labels = document.querySelectorAll('.outskirt-label');
  }

  render() {
    if (this.inputs && this.labels) {
      this.#onFocus();
      this.#onBlur();
      this.#onRunTime();
    }
  }

  #onRunTime() {
    this.inputs.forEach((input, index) => {
      this.#addActiveWhenBlurAndRunTime(input, this.labels[index])
    })
  }

  #onFocus() {
    this.inputs.forEach((input, index) => {
      input.addEventListener('focus', () => this.#addActiveWhenFocus(input, this.labels[index]));
    });
  }

  #onBlur() {
    this.inputs.forEach((input, index) => {
      input.addEventListener('blur', () => this.#addActiveWhenBlurAndRunTime(input, this.labels[index]));
    });
  }

  #addActiveWhenFocus(input, label) {
    input.classList.add('active');
    label.classList.add('active');
  }

  #addActiveWhenBlurAndRunTime(input, label) {
    if (input.value === '') {
      input.classList.remove('active');
      label.classList.remove('active');
    } else {
      input.classList.add('active');
      label.classList.add('active');
    }
  }
}

const outskirtInputLabel = new OutskirtInputLabel();

export default outskirtInputLabel;