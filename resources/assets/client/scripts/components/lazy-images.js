import {preloadImage} from '../utils';

/**
 * LazyImages controller.
 */
class LazyImages {
  /**
   * @type {string}
   */
  static get HANDLED_CLASS() {
    return 'loaded';
  }

  /**
   * Feature detect.
   * @type {boolean}
   */
  static get SUPPORTS_INTERSECTION_OBSERVER() {
    return ('IntersectionObserver' in window
      && 'IntersectionObserverEntry' in window);
  }

  /**
   * Initializes LazyImage controller.
   */
  static init() {
    this._instance = new LazyImages();
  }

  /**
   * Creates new LazyImages instence.
   */
  constructor() {
    const wraps = Array.from(document.querySelectorAll('.js-lazy-image'));

    if (!LazyImages.SUPPORTS_INTERSECTION_OBSERVER) {
      this._loadImagesImmediately(wraps);
      return;
    }

    this._onIntersection = this._onIntersection.bind(this);
    this._io = new IntersectionObserver(this._onIntersection);
    wraps.forEach((wrap) => {
      // image has been handled and loaded.
      if (wrap.classList.contains(LazyImages.HANDLED_CLASS)) {
        return;
      }

      this._io.observe(wrap);
    });
  }

  /**
   * Intersection handler
   * 
   * @param {IntersectionObserverEntry[]}
   */
  _onIntersection(entries) {
    entries.forEach((entry) => {
      // image not in view, just ignore.
      if (!entry.isIntersecting) {
        return;
      }

      // ignore loaded images...
      if (entry.target.classList.contains(LazyImages.HANDLED_CLASS)) {
        return;
      }

      entry.target.classList.add(LazyImages.HANDLED_CLASS);
      this._preloadImage(entry.target);
    });
  }

  /**
   * Loads images immediately.
   *
   * @param {HTMLElement[]} wraps image wraps.
   */
  _loadImagesImmediately(wraps) {
    wraps.forEach((wrap) => this._preloadImage(wrap));
  }

  /**
   * Preloads the given image.
   *
   * @param {HTMLElement} wrap image wrap.
   */
  _preloadImage(wrap) {
    const {src, alt} = wrap.dataset;
    // ignore if `src` is not set.
    if (!src) {
      return;
    }

    preloadImage(src)
      .then((evt) => this._applyImage(wrap, evt.target, alt))
      .catch((err) => console.error(err.message));
  }

  /**
   * Inserts the image in to the dom.
   *
   * @param {HTMLElement} wrap image wrap
   * @param {HTMLImageElement} img image element
   * @param {string} alt alt description
   */
  _applyImage(wrap, img, alt='lazy image') {
    img.alt = alt;
    img.classList.add('fade-in');
    wrap.appendChild(img);
  }
}

export default LazyImages;
