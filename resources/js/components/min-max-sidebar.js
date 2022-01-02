class MinMaxSidebar {
  constructor() {
    this.button = document.querySelector('#minMaxSidebar');
    this.sidebar = document.querySelector('#sidebar');
    this.main = document.querySelector('#main');
    this.navbar = document.querySelector('#navbar');
    this.brand = document.querySelector('#brandLongName');
  }

  render() {
    if (this.button) {
      this.#getDataFromLocalStorage();
      this.#onClick();
    }
  }

  #onClick() {
    this.button.addEventListener('click', () => {
      if (this.button.classList.contains('active')) {
        this.#max();
      } else {
        this.#min();
      }
    });
  }

  #min() {
    const { sidebar, button, main, brand, navbar } = this;

    this.#changedStyleAllTriggeredElement({
      buttonStyle: 'active',
      sidebarStyle: 'minimize',
      mainStyle: 'maximize',
      navbarStyle: 'maximize',
      buttonAttributeValue: 'toggle maximize sidebar',
      brandStyle: 'none',
    });

    this.#storeDataToLocalStorage({ button, sidebar, main, brand, navbar });
  }

  #max() {
    const { sidebar, button, main, brand, navbar } = this;

    sidebar.classList.remove('minimize');
    main.classList.remove('maximize');
    navbar.classList.remove('maximize');
    button.classList.remove('active');
    button.setAttribute('aria-label', 'toggle minimize sidebar');
    brand.style.display = '';

    this.#deleteDataFromLocalStorage();
  }

  #storeDataToLocalStorage({ button, sidebar, main, brand, navbar }) {
    const storeToLocalStorage = {
      button: {
        className: button.className,
        attribute: button.getAttribute('aria-label'),
      },
      sidebar: sidebar.className,
      main: main.className,
      brand: brand.style.display,
      navbar: navbar.className,
    };

    localStorage.setItem('min-max-sidebar', JSON.stringify(storeToLocalStorage));
  }

  #deleteDataFromLocalStorage() {
    localStorage.removeItem('min-max-sidebar');
  }

  #getDataFromLocalStorage() {
    const dataParsed = JSON.parse(localStorage.getItem('min-max-sidebar'));

    if (dataParsed) {
      this.#changedStyleAllTriggeredElement({
        buttonStyle: dataParsed.button.className,
        sidebarStyle: dataParsed.sidebar,
        mainStyle: dataParsed.main,
        navbarStyle: dataParsed.navbar,
        buttonAttributeValue: dataParsed.button.attribute,
        brandStyle: dataParsed.brand
      });
    }
  }

  #changedStyleAllTriggeredElement({ 
    buttonStyle, sidebarStyle, mainStyle, navbarStyle, buttonAttributeValue, brandStyle 
  }) {
    const { sidebar, button, main, brand } = this;

    button.classList.add(buttonStyle);
    sidebar.classList.add(sidebarStyle);
    main.classList.add(mainStyle);
    navbar.classList.add(navbarStyle);
    button.setAttribute('aria-label', buttonAttributeValue);
    brand.style.display = brandStyle;
  }
}

const minMaxSidebar = new MinMaxSidebar();

export default minMaxSidebar;