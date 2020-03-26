/**
 * @file
 * JavaScript which manages the "Tooltip" behavior.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js
// @prepros-prepend polyfills/closest.js
// @prepros-prepend polyfills/remove.js

(function (Drupal, drupalSettings) {

  'use strict';

  /**
   * @constructor Tooltip
   */
  var Tooltip = function (domNode, context) {
    this.tooltip = domNode;
    this.context = context;
    this.trigger = false;
    this.globalEscapeBound;
    this.timeout;
    this.keyCode = Object.freeze({
      'ESC': 27
    });
  };

  /*
   * @method Tooltip.prototype.init
   */
  Tooltip.prototype.init = function () {

    var parentMatchSelector =
        'a[href]:not([tabindex="-1"]),'
      + 'textarea:not([disabled]):not([tabindex="-1"]),'
      + 'button:not([disabled]):not([tabindex="-1"]),'
      + '[tabindex]:not([tabindex="-1"]),'
      + '[contentEditable=true]:not([tabindex="-1"])';
    
    // Initialize focusable trigger elements.
    if (this.tooltip.hasAttribute('data-pattern')) {
      this.tooltip.setAttribute('data-content', this.tooltip.getAttribute('title'));
      this.tooltip.removeAttribute('title');
      this.trigger = this.tooltip;
    }
    else if (this.tooltip.closest(parentMatchSelector)) {
      this.trigger = this.tooltip.closest(parentMatchSelector);
    }
    else {
      this.trigger = this.tooltip;
    }

    // Initialize event listener on focusable trigger elements.
    if (this.trigger) {
      this.trigger.addEventListener('focus', this.show.bind(this));
      this.trigger.addEventListener('blur', this.hide.bind(this));
    }

    // Initialize event listener on tooltip trigger elements.
    this.tooltip.addEventListener('mouseenter', this.show.bind(this));
    this.tooltip.addEventListener('mouseleave', this.hide.bind(this));

    // Initialize the global 'Escape' bound.
    this.globalEscapeBound = this.globalEscape.bind(this);
  };

  /*
   * @method Tooltip.prototype.show
   */
  Tooltip.prototype.show = function (event) {
    this.timeout = setTimeout(this.invokeTooltip.bind(this), drupalSettings.kiso.tooltip.delay);
  };

  /*
   * @method Tooltip.prototype.hide
   */
  Tooltip.prototype.hide = function (event) {
    clearTimeout(this.timeout);
    this.dismissTooltip();
  };

  /*
   * @method Tooltip.prototype.invokeTooltip
   */
  Tooltip.prototype.invokeTooltip = function () {
    if (this.trigger) {
      if (this.tooltip.tagName === 'svg' && !this.tooltip.isSameNode(this.trigger)) this.addDummyWrapper();
      this.trigger.classList.add('js-tooltip-visible');
      this.context.addEventListener('keyup', this.globalEscapeBound);
    }
  };

  /*
   * @method Tooltip.prototype.dismissTooltip
   */
  Tooltip.prototype.dismissTooltip = function () {
    if (this.trigger) {
      if (this.tooltip.tagName === 'svg' && !this.tooltip.isSameNode(this.trigger)) this.removeDummyWrapper();
      this.trigger.classList.remove('js-tooltip-visible');
      this.context.removeEventListener('keyup', this.globalEscapeBound);
    }
  };

  /*
   * @method Tooltip.prototype.globalEscape
   */
  Tooltip.prototype.globalEscape = function (event) {
    console.log('[keyup] - event.keyCode:', event.keyCode);

    switch (event.keyCode) {
      case this.keyCode.ESC:
        clearTimeout(this.timeout);
        this.dismissTooltip();
        event.stopPropagation();
        event.preventDefault();
        break;

      default:
        break;
    }
  };

  /*
   * @method Tooltip.prototype.addDummyWrapper
   */
  Tooltip.prototype.addDummyWrapper = function () {
    if (this.tooltip.parentNode.className !== 'js-dummy-wrapper') {
      var dummyWrapper = this.context.createElement('span');
      dummyWrapper.classList.add('js-dummy-wrapper');
      dummyWrapper.setAttribute('role', 'img');
      dummyWrapper.setAttribute('aria-label', this.tooltip.getAttribute('aria-label'));
      this.tooltip.setAttribute('aria-hidden', 'true');
      this.tooltip.parentNode.insertBefore(dummyWrapper, this.tooltip);
      dummyWrapper.appendChild(this.tooltip);
    }
  };

  /*
   * @method Tooltip.prototype.removeDummyWrapper
   */
  Tooltip.prototype.removeDummyWrapper = function () {
    if (this.tooltip.parentNode.className === 'js-dummy-wrapper') {
      var dummyWrapper = this.tooltip.parentNode;
      this.tooltip.removeAttribute('aria-hidden');
      dummyWrapper.parentNode.insertBefore(this.tooltip, dummyWrapper);
      dummyWrapper.remove();
    }
  };

  /*
   * Initialize "Tooltip" elements.
   */
  Drupal.behaviors.tooltip = {
    // To understand behaviors, see https://www.drupal.org/node/2269515
    attach: function (context, drupalSettings) {
      var tooltips =  context.querySelectorAll('[role=img][aria-label], [data-pattern=tooltip][title]');

      for (var i = 0; i < tooltips.length; i++) {
        var tt = new Tooltip(tooltips[i], context);
        tt.init();
      }
    }
  };

}) (Drupal, drupalSettings);
