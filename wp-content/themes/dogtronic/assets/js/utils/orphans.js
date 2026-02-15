export default class Orphans {
  constructor(options = {}) {
    this.selectors = options.selectors || 'p, span, h1, h2, h3, h4, h5, h6, li';

    this.words = options.words || [
      'a',
      'i',
      'o',
      'u',
      'w',
      'z',
      'A',
      'I',
      'O',
      'U',
      'W',
      'Z',
      'na',
      'bądź',
      'lub',
      'albo',
      'tudzież',
      'ni',
      'ani',
      'mianowicie',
      'ponieważ',
      'to jest',
      'dlatego',
      'przeto',
      'tedy',
      'więc',
      'zatem',
      'toteż',
      'czy',
      'aczkolwiek',
      'ale',
      'jednak',
      'zaś',
      'natomiast',
      'oraz',
      'aby',
      'bowiem',
      'choć',
      'jeżeli',
      'że',
      'aż',
      'za',
      'ta',
      'to',
      'krok',
    ];

    this.init();
  }

  init() {
    document.addEventListener('DOMContentLoaded', () => {
      this.apply();
    });
  }

  apply() {
    const elements = document.querySelectorAll(this.selectors);

    const pattern = new RegExp(`(\\s)(${this.words.join('|')})(\\s)`, 'g');

    elements.forEach((el) => {
      el.innerHTML = el.innerHTML.replace(pattern, `$1$2&nbsp;`);
    });
  }
}
