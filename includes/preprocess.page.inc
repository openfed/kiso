<?php

/**
 * @file
 * Prepares variables for the page template.
 */

/**
 * Implements hook_preprocess_HOOK() for page.html.twig.
 */
function kiso_preprocess_page(&$variables) {
  // Create variable for status code.
  if ($exception = \Drupal::request()->get('exception')) {
    $status_code = $exception->getStatusCode();
    $variables['status_code'] = $status_code;
  }
}
