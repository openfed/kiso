/**
 * Element.closest()
 *
 * Starting with the Element itself, the closest() method traverses parents
 * (heading toward the document root) of the Element until it finds a node
 * that matches the provided selectorString. Will return itself or the matching
 * ancestor. If no such element exists, it returns null.
 *
 * See: https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
 */

if (!Element.prototype.matches)
  Element.prototype.matches = Element.prototype.msMatchesSelector || 
                              Element.prototype.webkitMatchesSelector;

if (!Element.prototype.closest)
  Element.prototype.closest = function(s) {
    var el = this;
    if (!document.documentElement.contains(el)) return null;
    do {
      if (el.matches(s)) return el;
      el = el.parentElement || el.parentNode;
    } while (el !== null && el.nodeType == 1); 
    return null;
  };
