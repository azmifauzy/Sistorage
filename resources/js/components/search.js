class Search {
  constructor() {
    this.form = document.querySelector('#formSearch');
    this.input = document.querySelector('#inputSearch');
  }
  
  render() {
    if (this.form) {
      this.#onFocus(); 
      this.#onBlur();
    }
  }

  #onFocus() {
    const { form, input } = this;
    
    input.addEventListener('focus', () => this.#addBorder(form));
  }

  #onBlur() {
    const { form, input } = this;

    input.addEventListener('blur', () => this.#removeBorder(form));
  }

  #addBorder(form) {
    form.classList.add('active');
  }

  #removeBorder(form) {
    form.classList.remove('active');
  }
}

const search = new Search();

export default search;