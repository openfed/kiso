<?php

/**
 * @file
 * Prepares variables for all templates.
 */

/**
 * Implements hook_preprocess().
 */
function kiso_preprocess(&$variables, $hook) {
  try {
    $variables['is_front'] = \Drupal::service('path.matcher')->isFrontPage();
    $variables['language'] = \Drupal::languageManager()->getCurrentLanguage()->getId();
  }
  catch (Exception $e) {
    $variables['is_front'] = FALSE;
    $variables['language'] = FALSE;
  }
  // Ensure the cache varies correctly (new in Drupal 8.3).
  $variables['#cache']['contexts'][] = 'url.path.is_front';

  // Creates variables from theme settings.
  $variables['container_fluid'] = theme_get_setting('container_fluid');

  // Enable the "Back to top" button.
  $variables['backtotop_enable'] = theme_get_setting('backtotop_enable');
  $variables['backtotop_label'] = theme_get_setting('backtotop_label');
  $backtotop_enable = theme_get_setting('backtotop_enable');
  $backtotop_offset = theme_get_setting('backtotop_offset');
  $backtotop_mobile_hide = theme_get_setting('backtotop_mobile_hide');
  if (isset($backtotop_enable) and $backtotop_enable == '1') {
    $variables['#attached']['library'][] = 'kiso/back-to-top';
  }
  if (isset($backtotop_offset)) {
    $variables['#attached']['drupalSettings']['kiso']['backtotop']['offset'] = $backtotop_offset;
  }
  if (isset($backtotop_mobile_hide)) {
    $variables['#attached']['drupalSettings']['kiso']['backtotop']['mobile_hide'] = $backtotop_mobile_hide;
  }
}
