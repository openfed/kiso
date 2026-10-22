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
  $regions = \Drupal::service('theme_handler')->getTheme($theme)->listAllRegions();
  foreach ($regions as $key => $value) {
    $variables['page_'. $key] = _kiso_render_region($variables['page'][$key]);
    $variables['has_' . $key] = _kiso_has_region($variables['page_'. $key]);
  }

  // Create variable for status code.
  if ($exception = \Drupal::request()->attributes->get('exception')) {
    $status_code = $exception->getStatusCode();
    $variables['status_code'] = $status_code;
  }
}
