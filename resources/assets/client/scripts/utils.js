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
