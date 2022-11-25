<?php

/**
 * @file
 * Prepares variables for the page template.
 */

/**
 * Implements hook_preprocess_HOOK() for page.html.twig.
 */
function kiso_preprocess_page(&$variables) {
  // Add boolean variables detecting if regions are empty.
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  $regions = system_region_list($theme);
  foreach ($regions as $key => $value) {
    $variables['has_' . $key] = _kiso_has_region(\Drupal::service('renderer')->render($variables['page'][$key]));
  }

  // Create variable for status code.
  if ($exception = \Drupal::request()->get('exception')) {
    $status_code = $exception->getStatusCode();
    $variables['status_code'] = $status_code;
  }
}
