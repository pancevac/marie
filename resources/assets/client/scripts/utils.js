// logging middleware
export const logger = (msg) => (a) => {
  console.log(msg);
  return a;
};

/**
 * Preloads the image with the given src.
 *
 * @param {string} src image source url
 * @return {Promise}
 */
export const preloadImage = (src) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.src = src;
    img.onload = resolve;
    img.onerror = reject;
  });
};

/**
 * Transforms string into a bool value.
 * e.g. toBool("true") -> true;
 * @param {string} s
 */
export const toBool = (s) => s === 'true';

/**
 * Parses the given string to JavaScript type.
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function
 *
 * @param {string} s string to parse.
 * @return {any}
 */
export const parseString = (s) => {
  return Function(`
    'use strict;'
    return (${s});
  `)();
};

/**
 * Generates a className based on the given object.
 *
 * @param {HTMLElement} el
 * @param {Object} obj
 * @return {string}
 */
export const classNames = (el, obj) => {
  const names = Object.keys(obj);

  return Array.from(el.classList)
    .filter((n) => !names.includes(n))
    .concat(names.filter((n) => obj[n]))
    .join(' ');
}

/**
 * Creates new array of length `n`, with undefined values.
 *
 * @param {number} n length
 * @return {undefined[]}
 */
export const createArray = (n) => Array.from(new Array(n));

/**
 * Clones `n` elements from the `el` elements head and tail,
 * and appends/prepends them.
 *
 * @param {HTMLElement} el host element.
 * @param {number} [n=1] how many chid elements to clone.
 */
export const cloneElements = (el, n=1) => {
  const children = el.children;
  const length = children.length;

  createArray(n)
    .map((_, i) => ({
      head: children[i].cloneNode(true),
      tail: children[length - (i + 1)].cloneNode(true),
    }))
    .forEach(({head, tail}) => {
      el.append(head);
      el.prepend(tail);
    });
};
