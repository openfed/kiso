/**
 * @file
 * JavaScript which manages the "Smooth Scrolling" behavior.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document) {

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.smoothScroll = {
    attach: function (context, settings) {

      // Execute code once the DOM is ready.
      $(document).ready(function () {

        // Select all links with hashes and remove links that don't actually link to anything.
        $('a[href*="#"]:not([href="#"]):not([href="#0"]):not([role="tab"]):not([role="button"])').click(function (event) {

          // Figure out element to scroll to.
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

          // Does a scroll target exist?
          if (target.length) {

            // Only prevent default if animation is actually gonna happen.
            event.preventDefault();

            $('html, body').animate({
              scrollTop: target.offset().top-20
            }, 1000);
          }
        });
      });
    }
  };

} (jQuery, Drupal, this, this.document));
