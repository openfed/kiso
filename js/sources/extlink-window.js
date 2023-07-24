/**
 * @file
 * JavaScript which manages the "External Links" (New Window) behavior.
 */

// Polyfills
// @prepros-prepend polyfills/classList.js

(function (Drupal, drupalSettings) {

  'use strict';

  /**
   * @constructor ExtlinkWindow
   */
  var ExtlinkWindow = function (domNode, context) {
    this.link = domNode;
    this.context = context;
    this.logMessages = [];
    this.linkClass = false;
    this.iconElement = false;
    this.ariaLabel = false;
    this.opensNewWindow = false;
    this.intIncluded = false;
    this.isExternal = false;
    this.isInternal = false;
    this.isEmail = false;
    this.isSvgImage = false;
    this.svgImageShapeData = false;
    this.svgImageViewBox = false;
    this.fontAwesomeClass = false;
  };

  /*
   * @method ExtlinkWindow.prototype.init
   */
  ExtlinkWindow.prototype.init = function () {
    // Check whether the link opens a new window.
    if (this.link.hasAttribute('target') && this.link.getAttribute('target') === '_blank') {
      this.opensNewWindow = true;
      this.logMessages.push('opensNewWindow');
    }

    // Check whether it is an "External Links" module generated link.
    if (this.link.hasAttribute('data-extlink')) {
      this.isExternal = true;
      this.logMessages.push('isExternal');

      // Check whether it is an email link...
      if (this.link.getAttribute('href').indexOf('mailto:') != -1) {
        this.isEmail = true;
        this.logMessages.push('isEmail');
      }
    }

    // Check whether it is an "Internal" link that opens a new window.
    if (this.opensNewWindow && !this.isExternal) {
      this.isInternal = true;
      this.logMessages.push('isInternal');
    }

    // Check whether "External Links" module uses SVG images.
    if (!drupalSettings.data.extlink.extUseFontAwesome) {
      this.isSvgImage = true;
      this.iconElement = this.link.querySelector('svg');
      this.logMessages.push('isSvgImage');
    }
    // If not, the "External Links" module uses Font Awesome icons.
    else {
      this.iconElement = this.link.querySelector('span[class^="fa"]');
      this.logMessages.push('isFontAwesomeIcon');
    }

    // Check whether "Internal" links (same domain) need to be included.
    if (drupalSettings.kiso.extlinkWindow.intlinkEnabled) {
      this.intIncluded = true;
    }

    // Set attribute values and update the icon for all impacted links.
    this.setAttributeValues();
    this.updateIconElement();
  };

  /*
   * @method ExtlinkWindow.prototype.setAttributeValues
   */
  ExtlinkWindow.prototype.setAttributeValues = function () {
    if (this.isExternal) {
      if (this.opensNewWindow) {
        this.linkClass = 'ext';
        this.ariaLabel = drupalSettings.kiso.extlinkWindow.extlinkLabel;
        this.svgImageShapeData = drupalSettings.kiso.extlinkWindow.intlinkShapeData;
        this.svgImageViewBox = drupalSettings.kiso.extlinkWindow.viewBoxSquare;
        this.fontAwesomeClass = drupalSettings.kiso.extlinkWindow.fontAwesomeClass;
      }
      else {
        this.linkClass = (this.isEmail) ? 'mailto' : 'ext';
        this.ariaLabel = (this.isSvgImage) ? this.iconElement.getAttribute('aria-label') : this.iconElement.querySelector('span').getAttribute('aria-label');
        this.svgImageShapeData = (this.isEmail) ? drupalSettings.kiso.extlinkWindow.mailtoShapeData : drupalSettings.kiso.extlinkWindow.extlinkShapeData;
        this.svgImageViewBox = (this.isEmail) ? drupalSettings.kiso.extlinkWindow.viewBoxSquare : drupalSettings.kiso.extlinkWindow.viewBoxRect;
        this.fontAwesomeClass = (this.isEmail) ? drupalSettings.data.extlink.extFaMailtoClasses : drupalSettings.data.extlink.extFaLinkClasses;
      }
    }
    else if (this.isInternal) {
      this.linkClass = 'int';
      this.ariaLabel = drupalSettings.kiso.extlinkWindow.intlinkLabel;
      this.svgImageShapeData = drupalSettings.kiso.extlinkWindow.intlinkShapeData;
      this.svgImageViewBox = drupalSettings.kiso.extlinkWindow.viewBoxSquare;
      this.fontAwesomeClass = drupalSettings.kiso.extlinkWindow.fontAwesomeClass;
    }
  };

  /*
   * @method ExtlinkWindow.prototype.updateIconElement
   */
  ExtlinkWindow.prototype.updateIconElement = function () {
    if (this.ariaLabel && (this.isExternal || (this.isInternal && this.intIncluded))) {
      var newIconElement = (this.isSvgImage) ? this.createSvgIcon() : this.createFontAwesomeIcon();
      if (this.isExternal) {
        this.link.removeChild(this.iconElement);
      }
      this.link.appendChild(newIconElement);
      this.link.setAttribute('data-extlink-window', '');
      this.logMessages.push(this.link);

      // Print console logs.
      // console.log(this.logMessages);
    }
  };

  /*
   * @method ExtlinkWindow.prototype.createSvgIcon
   */
  ExtlinkWindow.prototype.createSvgIcon = function () {
    var svgIcon = this.context.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svgIcon.classList.add(this.linkClass, this.linkClass + '--smaller');
    svgIcon.setAttribute('role', 'img');
    svgIcon.setAttribute('aria-label', this.ariaLabel);
    svgIcon.setAttribute('viewBox', this.svgImageViewBox);
    var shape = this.context.createElementNS('http://www.w3.org/2000/svg', 'path');
    shape.setAttribute('d', this.svgImageShapeData);
    svgIcon.appendChild(shape);
    return svgIcon;
  };

  /*
   * @method ExtlinkWindow.prototype.createFontAwesomeIcon
   */
  ExtlinkWindow.prototype.createFontAwesomeIcon = function () {
    var fontAwesomeIcon = this.context.createElement('i');
    fontAwesomeIcon.classList.add('fa-' + this.linkClass, ...this.fontAwesomeClass.split(' '));
    fontAwesomeIcon.setAttribute('role', 'img');
    fontAwesomeIcon.setAttribute('aria-label', this.ariaLabel);
    return fontAwesomeIcon;
  };

  /*
   * Initialize "External Links" (New Window) hyperlinks.
   */
  Drupal.behaviors.extlinkWindow = {
    // To understand behaviors, see https://www.drupal.org/node/2269515
    attach: function (context, drupalSettings) {
      var links =  context.querySelectorAll(
        'a[href]:not([href^="#"]):not([href^="tel:"]):not([role="tab"]):not([role="button"]):not([data-extlink-window])'
      );

      for (var i = 0; i < links.length; i++) {
        var ew = new ExtlinkWindow(links[i], context);
        ew.init();
      }
    }
  };

}) (Drupal, drupalSettings);
