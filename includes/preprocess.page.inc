<?php

/**
 * @file
 * Prepares variables for the page template.
 */

/**
 * Implements hook_preprocess_HOOK() for page.html.twig.
 */
function kiso_preprocess_page(&$variables) {
  // Properly detect if regions are empty.
  // See: https://www.drupal.org/node/953034
  // See: https://drupal.stackexchange.com/questions/175389/how-do-i-properly-detect-if-region-is-empty
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  $regions = system_region_list($theme);
  foreach ($regions as $key => $value) {
    $rendered_region = render($variables['page'][$key]);
    $cleaned_region_output = $rendered_region ? _kiso_strip_comments($rendered_region) : '';
    $variables['has_' . $key] = !empty(_kiso_strip_tags($cleaned_region_output));
  }

  // Create variable for status code.
  if ($exception = \Drupal::request()->get('exception')) {
    $status_code = $exception->getStatusCode();
    $variables['status_code'] = $status_code;
  }
}
