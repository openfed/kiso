/**
 * @file
 * JavaScript which manages the "Back to Top" component.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, drupalSettings) {
  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.backtotop = {
    attach: function (context, settings) {
      // Initialize variables for the "Back to Top" link
      var offset = 300;
      var label = Drupal.t('Back to top');
      var mobile_hide = 0;
      var $body = $('body');
      var body_class = 'back-to-top-visible';
      var link_id = 'back-to-top';
      // Retrieve theme settings if they exist
      if (drupalSettings.kiso.backtotop.offset) {
        var offset = drupalSettings.kiso.backtotop.offset;
      }
      if (drupalSettings.kiso.backtotop.label) {
        var label = Drupal.t(drupalSettings.kiso.backtotop.label);
      }
      if (drupalSettings.kiso.backtotop.mobile_hide) {
        var mobile_hide = Drupal.t(drupalSettings.kiso.backtotop.mobile_hide);
      }

      // Execute code once the DOM is ready.
      $(document).ready(function () {

        if (!$('#' + link_id).length) {
          $body.prepend('<span id="top"></span>');
          $body.append('<a href="#top" class="' + link_id + '" title="' + label + '">' + label + '</a>');
        }

        if (mobile_hide === 0) {
          $body.addClass(body_class);
        } else {
          // Listen to scroll and resize
          $(window).scroll(function (){
            if ($(window).width() >= 1280) {
              ($(this).scrollTop() > offset) ? $body.addClass(body_class) : $body.removeClass(body_class);
            } else {
              $body.removeClass(body_class);
            }
          });
          $(window).resize(function (){
            if ($(window).width() <= 1279) {
              $body.removeClass(body_class);
            }
          });
        }
      });
    }
  };

})(jQuery, Drupal, drupalSettings);