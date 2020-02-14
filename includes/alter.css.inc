<?php

/**
 * @file
 * Stylesheets alter hooks.
 */

/**
 * Alter CSS files before they are output on the page.
 *
 * @param $css
 *   An array of all CSS items (files and inline CSS) being requested on the page.
 *
 * @see hook_css_alter()
 */
function kiso_css_alter(&$css) {
  // Remove the "External Links" stylesheet.
  if (theme_get_setting('extlinkwindow_enabled')) {
    unset($css[drupal_get_path('module', 'extlink') . '/extlink.css']);
  }
}
