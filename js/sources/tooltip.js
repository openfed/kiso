/**
 * @file
 * JavaScript which manages the "Tooltip" behavior.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js
// @prepros-prepend polyfills/closest.js

(function (Drupal, drupalSettings, window, document, undefined) {

  'use strict';

  /**
   * @constructor Tooltip
   */
  var Tooltip = function (domNode) {
    this.domNode = domNode;
    this.delay = drupalSettings.kiso.tooltip.delay;
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
    if (this.domNode.getAttribute('data-pattern')) {
      this.domNode.setAttribute('data-content', this.domNode.getAttribute('title'));
      this.domNode.removeAttribute('title');
      this.trigger = this.domNode;
    }
    else if (this.domNode.closest(parentMatchSelector)) {
      this.trigger = this.domNode.closest(parentMatchSelector);
    }
    else {
      this.trigger = this.domNode;
    }

    // Initialize event listener on focusable trigger elements.
    if (this.trigger) {
      this.trigger.addEventListener('focus', this.show.bind(this));
      this.trigger.addEventListener('blur', this.hide.bind(this));
    }

    // Initialize event listener on tooltip trigger elements.
    this.domNode.addEventListener('mouseenter', this.show.bind(this));
    this.domNode.addEventListener('mouseleave', this.hide.bind(this));

    // Initialize the global 'Escape' bound.
    this.globalEscapeBound = this.globalEscape.bind(this);

    // Initialize the amount of time to delay showing the tooltip (in milliseconds).
    if (drupalSettings.kiso.tooltip.customDelay.length) {
      this.delay = drupalSettings.kiso.tooltip.customDelay;
    }
  };

  /*
   * @method Tooltip.prototype.show
   */
  Tooltip.prototype.show = function (event) {
    this.timeout = setTimeout(this.invokeTooltip.bind(this), this.delay);
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
      this.trigger.classList.add('js-tooltip-visible');
      document.addEventListener('keyup', this.globalEscapeBound);
    }
  };

  /*
   * @method Tooltip.prototype.dismissTooltip
   */
  Tooltip.prototype.dismissTooltip = function () {
    if (this.trigger) {
      this.trigger.classList.remove('js-tooltip-visible');
      document.removeEventListener('keyup', this.globalEscapeBound);
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

  // To understand behaviors, see https://www.drupal.org/node/2269515
  Drupal.behaviors.tooltip = {
    attach: function (context, drupalSettings) {

      // Initialize "Tooltip" elements.
      window.addEventListener('load', function (event) {
        var tooltips =  document.querySelectorAll('[role=img][aria-label], [data-pattern=tooltip][title]');
        for (var i = 0; i < tooltips.length; i++) {
          var tt = new Tooltip(tooltips[i]);
          tt.init();
        }
      }, false);
    }
  };

}) (Drupal, drupalSettings, this, this.document);
