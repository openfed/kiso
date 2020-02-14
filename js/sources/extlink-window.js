/**
 * @file
 * JavaScript which manages the "External Links" (New Window) behavior.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js

(function (Drupal, drupalSettings, window, document, undefined) {

  'use strict';

  /**
   * @constructor ExtlinkWindow
   */
  var ExtlinkWindow = function (domNode) {
    this.domNode = domNode;
    this.warningMessage = false;
    this.opensNewWindow = false;
    this.isExternal = false;
    this.intIncluded = false;
  };

  /*
   * @method ExtlinkWindow.prototype.init
   */
  ExtlinkWindow.prototype.init = function () {
    var isCustomLabel, label, defaultLabel;

    // Check whether domNode is a link that opens a new window.
    if (this.domNode.getAttribute('target') && this.domNode.getAttribute('target') === '_blank') {
      this.opensNewWindow = true;
    }

    // Check whether domNode is a "External Links" module generated link.
    if (this.domNode.classList.contains('ext') || this.domNode.classList.contains('mailto')) {
      this.isExternal = true;
    }

    // Check whether internal links (same domain) need to be included.
    if (drupalSettings.kiso.extlinkWindow.intlink.enabled) {
      this.intIncluded = true;
    }

    // Set warning messages according to the type of the links.
    if (this.opensNewWindow) {
      label = (this.isExternal) ? drupalSettings.kiso.extlinkWindow.extlink.label : drupalSettings.kiso.extlinkWindow.intlink.label;
      defaultLabel = (this.isExternal) ? drupalSettings.kiso.extlinkWindow.extlink.defaultLabel : drupalSettings.kiso.extlinkWindow.intlink.defaultLabel;
      isCustomLabel = (this.isExternal) ? drupalSettings.kiso.extlinkWindow.extlink.customLabel : drupalSettings.kiso.extlinkWindow.intlink.customLabel;
      this.setWarningMessage(isCustomLabel, label, defaultLabel);
    }

    // Update the trailing <span> for all impacted links.
    this.updateSpanElement();
  };

  /*
   * @method ExtlinkWindow.prototype.setWarningMessage
   */
  ExtlinkWindow.prototype.setWarningMessage = function (isCustomLabel, label, defaultLabel) {
    this.warningMessage = (isCustomLabel && (typeof label === 'string' && label.length)) ? Drupal.t(label) : Drupal.t(defaultLabel);
  }

  /*
   * @method ExtlinkWindow.prototype.updateSpanElement
   */
  ExtlinkWindow.prototype.updateSpanElement = function () {
    if (this.isExternal) {
      var labelClass = this.domNode.className + '__label';
      var spanElement = this.domNode.querySelector('span.' + this.domNode.className);
      spanElement.setAttribute('role', 'img');
      spanElement.className = labelClass;

      // Apply changes to all external links that open a new window.
      if (this.opensNewWindow && this.warningMessage) {
        spanElement.classList.add(labelClass + '--new-window');
        spanElement.setAttribute('aria-label', this.warningMessage);
      }
    }
    else {
      this.createSpan();
    }
  }

  /*
   * @method ExtlinkWindow.prototype.createSpan
   */
  ExtlinkWindow.prototype.createSpan = function () {
    if (this.intIncluded && this.warningMessage) {
      var labelClass = 'int__label';
      var newSpan = document.createElement('span');
      newSpan.setAttribute('role', 'img');
      newSpan.classList.add(labelClass, labelClass + '--new-window');
      newSpan.setAttribute('aria-label', this.warningMessage);
      this.domNode.classList.add('int');
      this.domNode.appendChild(newSpan);
    }
  }

  // To understand behaviors, see https://www.drupal.org/node/2269515
  Drupal.behaviors.extlinkWindow = {
    attach: function (context, drupalSettings) {

      // Initialize "External Links" (New Window) hyperlinks.
      window.addEventListener('load', function (event) {
        var links =  document.querySelectorAll('a[href]:not([href^="#"]):not([href^="tel:"]):not([role="tab"]):not([role="button"])');

        for (var i = 0; i < links.length; i++) {
          var ew = new ExtlinkWindow(links[i]);
          ew.init();
        }
      }, false);
    }
  };

}) (Drupal, drupalSettings, this, this.document);
