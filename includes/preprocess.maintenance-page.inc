<?php

/**
 * @file
 * Prepares variables for maintenance page templates.
 */

/**
 * Implements hook_preprocess_HOOK() for maintenance-page.html.twig.
 */
function kiso_preprocess_maintenance_page(&$variables) {
  // Creates variables from theme settings.
  $variables['container_fluid'] = theme_get_setting('container_fluid');
}
