/**
 * @file
 * JavaScript which manages the "Smooth Scrolling" behavior.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document) {

  // Filter handling for a /dir/ OR /indexordefault.page.
  function filterPath(string) {
    return string
      .replace(/^\//, '')
      .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
      .replace(/\/$/, '');
  }

  // To understand behaviors, see https://www.drupal.org/node/2269515#s-drupalbehaviors
  Drupal.behaviors.smoothScroll = {
    attach: function (context, settings) {

      var locationPath = filterPath(location.pathname);

      $('a[href*="#"]', context).once().each(function () {
        var thisPath = filterPath(this.pathname) || locationPath;
        var hash = this.hash;

        if ($('#' + hash.replace(/#/, '')).length) {
          if (locationPath == thisPath && (location.hostname == this.hostname || !this.hostname) && this.hash.replace(/#/, '')) {
            var $target = $(hash), target = this.hash;

            if (target) {
              $(this).click(function (event) {

                // Only prevent default if animation is actually gonna happen.
                event.preventDefault();

                $('html, body').animate({
                  scrollTop: $target.offset().top-20
                }, 1000, function () {
                  location.hash = target;
                  $target.focus();

                  // Checking if the target was focused.
                  if ($target.is(':focus')) {
                    return false;
                  }
                  // Adding tabindex for elements not focusable.
                  else {
                    $target.attr('tabindex', '-1');
                    // Setting focus...
                    $target.focus();
                  };
                });
              });
            }
          }
        }
      });
    }
  };

} (jQuery, Drupal, this, this.document));
