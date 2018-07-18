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
